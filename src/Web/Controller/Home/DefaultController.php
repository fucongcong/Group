<?php
namespace src\web\Controller\Home;

use core\Group\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {   
        return $this->render('Web/Views/Default/index.html.twig');
    }

}

?>