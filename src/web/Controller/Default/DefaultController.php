<?php
use src\web\Controller\BaseController;

class DefaultController extends BaseController
{
    public function indexAction()
    {   
        return $this->render('web/views/Default/index.html.twig');
    }

}

?>