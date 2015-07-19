<?php
use core\Group\Controller\Controller;

class GroupController extends Controller
{
    public function indexAction()
    {   
        //$group=$this->getGroupService()->getGroup(1);

        return $this->render('web/views/Group/index.html.twig',array(
            'group'=>$group));
    }

    public function testAction($groupId, $id)
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