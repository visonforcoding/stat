<?php

namespace Yamei\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class YameiUserBundle extends Bundle{
    public function getParent (){
        return 'FOSUserBundle';
    }	
}
