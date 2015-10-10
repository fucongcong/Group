<?php
namespace src\web\Controller\Group;

use core\Group\Controller\Controller;

class GroupController extends Controller
{
    public function indexAction()
    {
        //$group=$this->getGroupService()->getGroup(1);

        return $this -> render('Web/Views/Group/index.html.twig',array(
            'group' => $group));
    }

    public function testAction($id)
    {
        echo $id; echo "<br>";

        echo $this -> route() -> getUri();echo "<br>";

        print_r($this -> route() -> getParameters());echo "<br>";

        print_r($this -> route() -> getParametersName());echo "<br>";

        echo $this -> route() -> getAction();echo "<br>";

        print_r($this -> route() -> getMethods());echo "<br>";

        echo $this -> getContainer() -> getTimezone();echo "<br>";

        echo $this -> getContainer() -> getEnvironment();echo "<br>";
        //$group=$this->getGroupService()->getGroup(1);
        return $this -> render('Web/Views/Group/index.html.twig',array(
            'group' => ""));
    }

    public function getGroupService()
    {
        return $this -> createService("Group:Group");
    }

}

?>