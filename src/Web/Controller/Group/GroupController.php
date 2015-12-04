<?php

namespace src\Web\Controller\Group;

use Controller;
use Request;
use JsonResponse;

class GroupController extends Controller
{
    public function indexAction()
    {
        //$group=$this->getGroupService()->getGroup(1);

        return $this -> render('Web/Views/Group/index.html.twig',array(
            'group' => $group));
    }

    public function testAction(Request $request, $id)
    {
        // \Log::debug('123',['user'=>1]);
        // \Log::debug('1233',['user'=>12]);
        // \Log::debug('12asdasd33',['user'=>555]);
        // echo $id;
        // echo $request->query->get('token');
        // echo $id; echo "<br>";
        // \Cache::set('ha',123,60);
        // \Cache::redis() -> set('haa',123,60);
        // $config = \Config::getInstance();
        // var_dump($config -> getConfig());
        $uri = $this -> route() -> getUri();
        //echo \Session::get('aa','123');
        $parameters = $this -> route() -> getParameters();

        $parametersName = $this -> route() -> getParametersName();

        $action = $this -> route() -> getAction();

        $methods = $this -> route() -> getMethods();

        $currentMethod = $this -> route() -> getCurrentMethod();

        $timezone = $this -> getContainer() -> getTimezone();

        $environment = $this -> getContainer() -> getEnvironment();
        //return new JsonResponse([$id]);
        //var_dump($this->getGroupService()->getGroup(2));
        return $this -> render('Web/Views/Group/index.html.twig',array(
            'uri' => $uri,
            'parameters' => $parameters,
            'parametersName' => $parametersName,
            'action' => $action,
            'methods' => $methods,
            'currentMethod' => $currentMethod,
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