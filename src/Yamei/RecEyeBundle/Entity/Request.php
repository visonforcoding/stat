<?php

namespace Yamei\RecEyeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * @ORM\Entity
 * @ORM\Table(name="ym_request")
 * @ORM\HasLifecycleCallbacks()
 */
class Request{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="HttpRequest",mappedBy="request")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="Yamei\UserBundle\Entity\User",inversedBy="id")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    protected $user;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $req_time;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $from_ip4;

    /**
     * @ORM\Column(type="smallint")
     */    
    protected $from_port;
    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $to_ip4;

    /**
     * @ORM\Column(type="smallint")
     */    
    protected $to_port;


    /**
     * @ORM\Column(type="smallint")
     */    
    protected $protocol_id;

    /**
     * @ORM\ManyToOne(targetEntity="Protocol",inversedBy="request")
     * @ORM\JoinColumn(name="protocol_id",referencedColumnName="id")
     */
    protected $protocol;


    /**
     * @ORM\Column(type="integer")
     */    
    protected $hostname_id;

    /**
     * @ORM\ManyToOne(targetEntity="Hostname",inversedBy="request",cascade={"persist"})
     * @ORM\JoinColumn(name="hostname_id",referencedColumnName="id")
     */
    protected $hostname;
    
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
     * Set user_id
     *
     * @param integer $userId
     * @return Request
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
    
        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set req_time
     * @ORM\PrePersist
     *
     * @return Request
     */
    public function setReqTime(){
        $this->req_time = new \DateTime('now');
    
        return $this;
    }

    /**
     * Get req_time
     *
     */
    public function getReqTime(){
        if ($this->req_time){
            $date = $this->req_time;
            return $date->format('Y-m-d H:i:s');
        }else{
            return $this->req_time;
        } 
    }

    /**
     * Set from_ip4
     *
     * @param string $fromIp4
     * @return Request
     */
    public function setFromIp4($fromIp4)
    {
        $this->from_ip4 = $fromIp4;
    
        return $this;
    }

    /**
     * Get from_ip4
     *
     * @return string 
     */
    public function getFromIp4()
    {
        return $this->from_ip4;
    }

    /**
     * Set from_port
     *
     * @param integer $fromPort
     * @return Request
     */
    public function setFromPort($fromPort)
    {
        $this->from_port = $fromPort;
    
        return $this;
    }

    /**
     * Get from_port
     *
     * @return integer 
     */
    public function getFromPort()
    {
        return $this->from_port;
    }

    /**
     * Set to_ip4
     *
     * @param string $toIp4
     * @return Request
     */
    public function setToIp4($toIp4)
    {
        $this->to_ip4 = $toIp4;
    
        return $this;
    }

    /**
     * Get to_ip4
     *
     * @return string 
     */
    public function getToIp4()
    {
        return $this->to_ip4;
    }

    /**
     * Set to_port
     *
     * @param integer $toPort
     * @return Request
     */
    public function setToPort($toPort)
    {
        $this->to_port = $toPort;
    
        return $this;
    }

    /**
     * Get to_port
     *
     * @return integer 
     */
    public function getToPort()
    {
        return $this->to_port;
    }

    /**
     * Set protocol_id
     *
     * @param integer $protocolId
     * @return Request
     */
    public function setProtocolId($protocolId)
    {
        $this->protocol_id = $protocolId;
    
        return $this;
    }

    /**
     * Get protocol_id
     *
     * @return integer 
     */
    public function getProtocolId()
    {
        return $this->protocol_id;
    }

    /**
     * Set hostname_id
     *
     * @param \int $hostnameId
     * @return Request
     */
    public function setHostnameId(\int $hostnameId)
    {
        $this->hostname_id = $hostnameId;
    
        return $this;
    }

    /**
     * Get hostname_id
     *
     * @return \int 
     */
    public function getHostnameId()
    {
        return $this->hostname_id;
    }

    /**
     * Set user
     *
     * @param \Yamei\UserBundle\Entity\User $user
     * @return Request
     */
    public function setUser(\Yamei\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Yamei\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set protocol
     *
     * @param \Yamei\RecEyeBundle\Entity\Protocol $protocol
     * @return Request
     */
    public function setProtocol(\Yamei\RecEyeBundle\Entity\Protocol $protocol = null)
    {
        $this->protocol = $protocol;
    
        return $this;
    }

    /**
     * Get protocol
     *
     * @return \Yamei\RecEyeBundle\Entity\Protocol 
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Set hostname
     *
     * @param \Yamei\RecEyeBundle\Entity\Hostname $hostname
     * @return Request
     */
    public function setHostname(\Yamei\RecEyeBundle\Entity\Hostname $hostname = null)
    {
        $this->hostname = $hostname;
    
        return $this;
    }

    /**
     * Get hostname
     *
     * @return \Yamei\RecEyeBundle\Entity\Hostname 
     */
    public function getHostname()
    {
        return $this->hostname;
    }
}