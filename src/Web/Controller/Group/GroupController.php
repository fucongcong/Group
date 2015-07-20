<?php
namespace src\web\Controller\Group;

use core\Group\Controller\Controller;

class GroupController extends Controller
{
    public function indexAction()
    {   
        //$group=$this->getGroupService()->getGroup(1);

        return $this->render('Web/Views/Group/index.html.twig',array(
            'group'=>$group));
    }

    public function testAction($id)
    {   
        echo $id;
        
        echo $this->route()->getUri();

        print_r($this->route()->getParameters());

        print_r($this->route()->getParametersName());

        echo $this->route()->getAction();

        print_r($this->route()->getMethods());

        //$group=$this->getGroupService()->getGroup(1);
        return $this->render('Web/Views/Group/index.html.twig',array(
            'group'=>$group));
    }

    public function getGroupService()
    {
        return $this->createService("Group:Group");
    }

}

?>