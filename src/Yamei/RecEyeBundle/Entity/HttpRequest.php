<?php

namespace Yamei\RecEyeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * @ORM\Entity
 * @ORM\Table(name="ym_http_request")
 * @ORM\HasLifecycleCallbacks()
 */
class HttpRequest{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $request_id;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $method_id;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $url_path_id;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $url_params_id;

    /**
     * @ORM\OneToOne(targetEntity="Request",inversedBy="id",cascade={"remove"})
     * @ORM\JoinColumn(name="request_id",referencedColumnName="id")
     */
    protected $request;    

    /**
     * @ORM\OneToOne(targetEntity="HttpUrlPath",inversedBy="httpRequest",cascade={"remove"})
     * @ORM\JoinColumn(name="url_path_id",referencedColumnName="id")
     */
    protected $urlPath;

    /**
     * @ORM\OneToOne(targetEntity="HttpUrlParams",inversedBy="httpRequest",cascade={"remove"})
     * @ORM\JoinColumn(name="url_params_id",referencedColumnName="id")
     */
    protected $urlParams;
    /**
     * @ORM\ManyToOne(targetEntity="HttpMethod",inversedBy="httpRequest")
     * @ORM\JoinColumn(name="method_id",referencedColumnName="id")
     */
    protected $method;    

    public function __construct(){
    }


    /**
     * Set request_id
     *
     * @param integer $requestId
     * @return HttpRequest
     */
    public function setRequestId($requestId)
    {
        $this->request_id = $requestId;
    
        return $this;
    }

    /**
     * Get request_id
     *
     * @return integer 
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

    /**
     * Set method_id
     *
     * @param integer $methodId
     * @return HttpRequest
     */
    public function setMethodId($methodId)
    {
        $this->method_id = $methodId;
    
        return $this;
    }

    /**
     * Get method_id
     *
     * @return integer 
     */
    public function getMethodId()
    {
        return $this->method_id;
    }

    /**
     * Set url_path_id
     *
     * @param integer $urlPathId
     * @return HttpRequest
     */
    public function setUrlPathId($urlPathId)
    {
        $this->url_path_id = $urlPathId;
    
        return $this;
    }

    /**
     * Get url_path_id
     *
     * @return integer 
     */
    public function getUrlPathId()
    {
        return $this->url_path_id;
    }

    /**
     * Set url_params_id
     *
     * @param integer $urlParamsId
     * @return HttpRequest
     */
    public function setUrlParamsId($urlParamsId)
    {
        $this->url_params_id = $urlParamsId;
    
        return $this;
    }

    /**
     * Get url_params_id
     *
     * @return integer 
     */
    public function getUrlParamsId()
    {
        return $this->url_params_id;
    }

    /**
     * Set request
     *
     * @param \Yamei\RecEyeBundle\Entity\Request $request
     * @return HttpRequest
     */
    public function setRequest(\Yamei\RecEyeBundle\Entity\Request $request = null)
    {
        $this->request = $request;
    
        return $this;
    }

    /**
     * Get request
     *
     * @return \Yamei\RecEyeBundle\Entity\Request 
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set method
     *
     * @param \Yamei\RecEyeBundle\Entity\HttpMethod $method
     * @return HttpRequest
     */
    public function setMethod(\Yamei\RecEyeBundle\Entity\HttpMethod $method = null)
    {
        $this->method = $method;
    
        return $this;
    }

    /**
     * Get method
     *
     * @return \Yamei\RecEyeBundle\Entity\HttpMethod 
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set urlPath
     *
     * @param \Yamei\RecEyeBundle\Entity\HttpUrlPath $urlPath
     * @return HttpRequest
     */
    public function setUrlPath(\Yamei\RecEyeBundle\Entity\HttpUrlPath $urlPath = null)
    {
        $this->urlPath = $urlPath;
    
        return $this;
    }

    /**
     * Get urlPath
     *
     * @return \Yamei\RecEyeBundle\Entity\HttpUrlPath 
     */
    public function getUrlPath()
    {
        return $this->urlPath;
    }

    /**
     * Set urlParams
     *
     * @param \Yamei\RecEyeBundle\Entity\HttpUrlParams $urlParams
     * @return HttpRequest
     */
    public function setUrlParams(\Yamei\RecEyeBundle\Entity\HttpUrlParams $urlParams = null)
    {
        $this->urlParams = $urlParams;
    
        return $this;
    }

    /**
     * Get urlParams
     *
     * @return \Yamei\RecEyeBundle\Entity\HttpUrlParams 
     */
    public function getUrlParams()
    {
        return $this->urlParams;
    }
}