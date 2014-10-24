<?php

namespace Yamei\RecEyeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * @ORM\Entity
 * @ORM\Table(name="ym_http_url_path")
 * @ORM\HasLifecycleCallbacks()
 */
class HttpUrlPath{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    protected $url_path;

    /**
     * @ORM\OneToOne(targetEntity="HttpRequest",mappedBy="urlPath")
     */
    protected $httpRequest;    

    public function __construct(){
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url_path
     *
     * @param string $urlPath
     * @return HttpUrlPath
     */
    public function setUrlPath($urlPath)
    {
        $this->url_path = $urlPath;
    
        return $this;
    }

    /**
     * Get url_path
     *
     * @return string 
     */
    public function getUrlPath()
    {
        return $this->url_path;
    }

    /**
     * Set httpRequest
     *
     * @param \Yamei\RecEyeBundle\Entity\HttpRequest $httpRequest
     * @return HttpUrlPath
     */
    public function setHttpRequest(\Yamei\RecEyeBundle\Entity\HttpRequest $httpRequest = null)
    {
        $this->httpRequest = $httpRequest;
    
        return $this;
    }

    /**
     * Get httpRequest
     *
     * @return \Yamei\RecEyeBundle\Entity\HttpRequest 
     */
    public function getHttpRequest()
    {
        return $this->httpRequest;
    }
}