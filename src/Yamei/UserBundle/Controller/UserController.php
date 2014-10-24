<?php

namespace Yamei\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller{
    public function indexAction($name)
    {
        return $this->render('YameiUserBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function getUserAction(){
        
    }
}
