<?php

namespace Yamei\RecEyeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request as syr;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Yamei\RecEyeBundle\Entity\Request ;
use Yamei\RecEyeBundle\Entity\HttpMethod;
use Yamei\RecEyeBundle\Entity\HttpRequest;
use Yamei\RecEyeBundle\Entity\HttpUrlParams;
use Yamei\RecEyeBundle\Entity\HttpUrlPath;
use Yamei\RecEyeBundle\Entity\Protocol;
use Yamei\RecEyeBundle\Entity\Hostname;

class GetListController extends Controller{
    
    public function showRequestAction(){
      return $this->render('YameiRecEyeBundle::showRequest.html.twig');
    }
    /**
     * get list of request from db for jqgrid 
     */
    public function getRequestListAction(syr $request){
        $countSqlQuery = "select COUNT(*) as count from ym_request ymr";
        $dataSqlQuery = "select ymr.* ,ymu.username,ymp.name as protocol 
                         ,ymh.name as hostname,ymhr2.name as method
                         ,ymhr2.url_params as params,ymhr2.url_path as path
                        from `ym_request` ymr 
                        left join `ym_user` ymu on ymr.user_id = ymu.id
                        left join `ym_protocol` ymp on ymr.protocol_id = ymp.id
                        left join `ym_hostname` ymh on ymr.hostname_id = ymh.id
                        left join (
                        select ymhr.request_id,ymhm.name,ymhup.url_params,ymhupa.url_path
                        from `ym_http_request` ymhr
                        left join `ym_http_method` ymhm on ymhr.method_id = ymhm.id
                        left join `ym_http_url_params` ymhup on ymhr.url_params_id = ymhup.id
                        left join `ym_http_url_path` ymhupa on ymhr.url_path_id = ymhupa.id
                        ) ymhr2 on ymr.id = ymhr2.request_id ";
        
        $output = $this->get('yamei_jqgrid')
                ->buildResponse($request,$countSqlQuery,$dataSqlQuery,true,false);
       
        return new JsonResponse($output);
      
    }
    
}
