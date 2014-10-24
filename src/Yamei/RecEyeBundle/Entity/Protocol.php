<?php

namespace Yamei\RecEyeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * @ORM\Entity
 * @ORM\Table(name="ym_protocol")
 * @ORM\HasLifecycleCallbacks()
 */
class Protocol{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=15, unique=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */    
    protected $version;

    /**
     * @ORM\OneToMany(targetEntity="Request",mappedBy="protocol")
     */
    protected $request;
    
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
     * @return Protocol
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
     * Set version
     *
     * @param string $version
     * @return Protocol
     */
    public function setVersion($version)
    {
        $this->version = $version;
    
        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set request
     *
     * @param \Yamei\RecEyeBundle\Entity\Request $request
     * @return Protocol
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
}