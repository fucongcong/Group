<?php

namespace src\web\Controller\Error;

use Controller;

class NotFoundController extends Controller
{
    public function indexAction()
    {
        return $this -> render('Web/Views/Error/404.html.twig');
    }

}
