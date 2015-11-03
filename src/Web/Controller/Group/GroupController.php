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
        // echo $id; echo "<br>";

        $uri = $this -> route() -> getUri();

        $parameters = $this -> route() -> getParameters();

        $parametersName = $this -> route() -> getParametersName();

        $action = $this -> route() -> getAction();

        $methods = $this -> route() -> getMethods();

        $timezone = $this -> getContainer() -> getTimezone();

        $environment = $this -> getContainer() -> getEnvironment();

        //$group=$this->getGroupService()->getGroup(1);
        return $this -> render('Web/Views/Group/index.html.twig',array(
            'uri' => $uri,
            'parameters' => $parameters,
            'parametersName' => $parametersName,
            'action' => $action,
            'methods' => $methods,
            'timezone' => $timezone,
            'environment' => $environment
            ));
    }

    public function getGroupService()
    {
        return $this -> createService("Group:Group");
    }

}

?>