<?php
namespace Yamei\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use FOS\UserBundle\Model\UserInterface as UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ym_user")
 */
class User extends BaseUser implements UserInterface {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $company;    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $fullname;
    
    /**
     * @ORM\Column(type="string",length = 64,nullable = true)
     */
    protected $code;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $crt_time;    

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $upd_time;    


    public function __construct(){
        parent::__construct();
        $this->roles = array('ROLE_USER'); 
    }

    public function isGranted($role){
        return in_array($role, $this->getRoles());
    }    

    /*
     * Return customer Fullname if it is setted, and username if not
     */
    public function getName(){
        return (empty($this->fullname))?$this->username:$this->fullname;
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
     * Set company
     *
     * @param string $company
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     * @return User
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    
        return $this;
    }

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullname()
    {
        return $this->fullname;
    }   

   /**
    * set code
    * @param string $code
    * @return \Yamei\UserBundle\Entity\User
    */
    public function setCode($code){
        $this->code = $code;
        return $this;
    }
    
    /**
     * Get code
     * @return user
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * Set crt_time
     * @ORM\PrePersist
     * @return User
     */
    public function setCrtTime(){
        $this->crt_time = new \DateTime('now');
        return $this;
    }

    /**
     * Get crt_time
     */
    public function getCrtTime(){
        if ($this->crt_time){
            $date = $this->crt_time;
            return $date->format('Y-m-d H:i:s');
        }else{
            return $this->crt_time;
        } 
    }

    /**
     * Set upd_time
     * @ORM\PreUpdate
     * @return User
     */
    public function setUpdTime(){
        $this->upd_time = new \DateTime("now");
    
        return $this;
    }

    /**
     * Get upd_time
     */
    public function getUpdTime(){
        if ($this->upd_time){
            $date = $this->upd_time;
            return $date->format('Y-m-d H:i:s');
        }else{
            return $this->upd_time;
        } 
    }
}
