<?php
namespace src\web\Controller\Error;

use core\Group\Controller\Controller;

class NotFoundController extends Controller
{
    public function indexAction()
    {   
        return $this->render('web/views/Error/404.html.twig');
    }

}

?>