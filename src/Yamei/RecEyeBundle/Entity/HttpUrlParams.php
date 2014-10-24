<?php

namespace Yamei\RecEyeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * @ORM\Entity
 * @ORM\Table(name="ym_http_url_params")
 * @ORM\HasLifecycleCallbacks()
 */
class HttpUrlParams{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $url_params;

    /**
     * @ORM\OneToOne(targetEntity="HttpRequest",mappedBy="urlParams")
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
     * Set url_params
     *
     * @param string $urlParams
     * @return HttpUrlParams
     */
    public function setUrlParams($urlParams)
    {
        $this->url_params = $urlParams;
    
        return $this;
    }

    /**
     * Get url_params
     *
     * @return string 
     */
    public function getUrlParams()
    {
        return $this->url_params;
    }

    /**
     * Set httpRequest
     *
     * @param \Yamei\RecEyeBundle\Entity\HttpRequest $httpRequest
     * @return HttpUrlParams
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