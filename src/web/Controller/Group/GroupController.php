<?php
use src\web\Controller\BaseController;

class GroupController extends BaseController
{
    public function indexAction()
    {   
        //$group=$this->getGroupService()->getGroup(1);

        return $this->render('web/views/Group/index.html.twig',array(
            'group'=>$group));
    }

    public function getGroupService()
    {
        return $this->createService("Group:Group");
    }

}

?>