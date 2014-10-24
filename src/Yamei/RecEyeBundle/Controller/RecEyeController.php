<?php

namespace Yamei\RecEyeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Yamei\RecEyeBundle\Entity\Request;
use Yamei\RecEyeBundle\Entity\HttpMethod;
use Yamei\RecEyeBundle\Entity\HttpRequest;
use Yamei\RecEyeBundle\Entity\HttpUrlParams;
use Yamei\RecEyeBundle\Entity\HttpUrlPath;
use Yamei\RecEyeBundle\Entity\Protocol;
use Yamei\RecEyeBundle\Entity\Hostname;

class RecEyeController extends Controller{

    public function indexAction(){
        return $this->render('YameiRecEyeBundle::dashboard.html.twig');
    }   

    public function indexManagerAction(){
        return $this->render('YameiRecEyeBundle::dashboard_manager.html.twig');
    }


    /**
     * Extract files from archives
     */
    public function extractFilesAction(){
    	$filesDir = $this->container->getParameter('income_files_dir');
    	$filesDir = array_diff(scandir($this->container->getParameter('income_files_dir')), array('..', '.'));
    	$files = array_map(function($i){if (substr($i,-3)=='.gz') return $i;},$filesDir);

    	foreach ($files as $file) {
    		if (empty($file)) continue;
	    
	    	$filesDir = $this->container->getParameter('income_files_dir');

	    	if (PHP_OS == 'WINNT'){
	    		$unzip = $this->container->getParameter('winnt_gunzip').' -d';
	    	}else{
	    		$unzip = 'unzip';
	    	}
	    	system($unzip.' '.$filesDir.$file);
	    	$decompressed_file = substr($file, 0,-3);    		
    	}
        die();
    }

    /**
     * Parse files, which already extracted
     * @return [type] [description]
     */
    public function parseFilesAction(){
    	$filesDir = $this->container->getParameter('income_files_dir');
    	$files = array_diff(scandir($filesDir), array('..', '.'));
    	$files = array_map(function($i){if (substr($i,-3)!='.gz') return $i;},$files);

    	foreach ($files as $file) {
    		if (empty($file)) continue;	 
            $rand = rand(10000, 99999);
            $this->get('logger')->info("[$rand] Parse log started");
            if ($this->parseLog($file)){
                $this->get('logger')->info("[$rand] Parse log finished");
                if (unlink($filesDir.$file))
                    $this->get('logger')->info("[$rand] File removed");
                else
                    $this->get('logger')->error("[$rand] Cannor remove file");
            }
    	}
        die();
    }

    public function parseLog($filename){
        set_time_limit(0);
        $this->get('logger')->warn("parse beginning".date("Y-m-d H:i:s"));
    	$filesDir = $this->container->getParameter('income_files_dir');
        if (file_exists($filesDir.$filename)){
            preg_match("#(\S+)-(\S+)-(\d{4}-\d{2}-\d{2})-(\d{2}-\d{2}-\d{2})#", $filename,$matches);
            $em = $this->getDoctrine()->getManager();   
            
            if (!$customer = $em->getRepository('YameiUserBundle:User')->findOneByUsername($matches[1])){
                $this->get('logger')->error("Customer {$matches[1]} was not found, file will be ignored from parsing");
                return false;
            }


            if ($matches[2]!='web') return;

            $data = parse_ini_file($filesDir.$filename, true);
            

            # Get methods
            // $httpMethod = $em->getRepository('YameiRecEyeBundle:HttpMethod')->findAll();
            $httpMethod = $this->getHttpMethods();
            $httpProtocol = $this->getHttpProtocols();
            
            foreach ($data as $key=>$element) {
                $newMethod = false;
                $newProtocol = false;
                preg_match('#([\d\/-:]+)\s+([\d:]+)\s+([\d\.]+):([\d]+)\s+([\d\.]+):([\d]+)\s+#', $key,$baseInfo);
                preg_match('#(\w+)\s+(\S+)\s+(.*)\s*#', $element['request'],$requestInfo);
                if(!isset($requestInfo[2])){
                  $this->get('logger')->error("there is a error at:".$key);
                  continue;
                }
                $parsedUrl = parse_url($requestInfo[2]);
                $request = new Request();
                $request->setUser($customer);
                $request->setFromIp4($baseInfo[3]);
                $request->setFromPort($baseInfo[4]);
                $request->setToIp4($baseInfo[5]);
                $request->setToPort($baseInfo[6]);
                if (! $httpHostname = $em->getRepository('YameiRecEyeBundle:Hostname')->findOneByName($parsedUrl['host'])){
                    $httpHostname = new Hostname();
                    $httpHostname->setName($parsedUrl['host']);
                    $em->persist($httpHostname);
                }
                if ($parsedUrl && $httpHostname)
                $request->setHostname($httpHostname);
                if (isset($httpProtocol[$requestInfo[3]])){
                    $request->setProtocol($httpProtocol[$requestInfo[3]]);
                }else{
                    $protocol = new Protocol();
                    $protocol->setName($requestInfo[3]);
                    $em->persist($protocol);
                    
                    $request->setProtocol($protocol);
                    $newProtocol = true;
                }
                $em->persist($request);
                
                if ($parsedUrl){
                    $httpRequest = new HttpRequest();

                    if (isset($httpMethod[$requestInfo[1]])){
                        $httpRequest->setMethod($httpMethod[$requestInfo[1]]);
                    }else{
                        $method = new HttpMethod();
                        $method->setName($requestInfo[1]);
                        $em->persist($method);
                        
                        $httpRequest->setMethod($method);                        
                        $newMethod = true;
                    }
                
                    if (isset($parsedUrl['path']) && $parsedUrl['path']!='/'){
                        $httpUrlPath = new HttpUrlPath();
                        $httpUrlPath->setUrlPath($parsedUrl['path']);      
                        $em->persist($httpUrlPath);
                        
                        $httpRequest->setUrlPath($httpUrlPath);
                    }

                    if (isset($parsedUrl['query'])){
                        $httpUrlParams = new HttpUrlParams();
                        $httpUrlParams->setUrlParams($parsedUrl['query']);
                        $em->persist($httpUrlParams);
                        
                        $httpRequest->setUrlParams($httpUrlParams);
                    }

                    $httpRequest->setRequest($request);
                    $em->persist($httpRequest);
                }

                try{
                    $em->flush();
                    if ($newMethod)
                        $httpMethod = $this->getHttpMethods();
                    if ($newProtocol)
                        $httpProtocol = $this->getHttpProtocols();
                }catch(Exception $e){
                    $this->get('logger')->warn('Error while commit transaction');
                }
            }
        }
        $this->get('logger')->warn("parse end!".date("Y-m-d H:i:s"));
        return true;
    }

    public function getHttpMethods(){
        $em = $this->getDoctrine()->getManager();  
        $httpMethods = $em->createQuery('
                Select hm
                FROM YameiRecEyeBundle:HttpMethod hm')
                 ->getResult();
        $output = array();
        foreach ($httpMethods as $value) {
            $output[$value->getName()] = $value;
        }
        return $output;
    }

    public function getHttpProtocols(){
        $em = $this->getDoctrine()->getManager();  
        $httpProtocols = $em->createQuery('
                Select hp
                FROM YameiRecEyeBundle:Protocol hp')
                 ->getResult();
        $output = array();
        foreach ($httpProtocols as $value) {
            $output[$value->getName()] = $value;
        }
        return $output;
    }
}
