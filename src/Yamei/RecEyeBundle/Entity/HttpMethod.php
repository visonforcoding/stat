<?php

namespace Yamei\RecEyeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * @ORM\Entity
 * @ORM\Table(name="ym_http_method")
 * @ORM\HasLifecycleCallbacks()
 */
class HttpMethod{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="HttpRequest",mappedBy="method")
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
     * Set name
     *
     * @param string $name
     * @return HttpMethod
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set httpRequest
     *
     * @param \Yamei\RecEyeBundle\Entity\HttpRequest $httpRequest
     * @return HttpMethod
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