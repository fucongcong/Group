<?php

namespace src\Web\Controller\Home;

use src\Web\Controller\BaseController;
use Request;

class IndexController extends BaseController
{
    public function indexAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) 
            
        return $this -> render('Web/Views/Home/index.html.twig');
    }
}