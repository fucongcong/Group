<?php

namespace src\Admin\Controller\Default;

use Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this -> render('Admin/Views/Default/index.html.twig');
    }

}

