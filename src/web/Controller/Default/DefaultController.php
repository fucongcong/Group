<?php
use core\Group\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {   
        return $this->render('web/views/Default/index.html.twig');
    }

}

?>