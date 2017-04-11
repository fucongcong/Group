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

    public function addAction()
    {
        return new \Response('1');
    }
    
    public function testAction(Request $request, $id)
    {   
        //var_dump(\Rpc::call('User:User', 'getUser', [1]));

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
        //echo \Session::get('aa','123');
        // \Session::getFlashBag() -> setAll(['group', 'good']);
        // \Session::getFlashBag() -> all();
        // $tube = 'testjob1';
        // $data = '这是第一个队列任务';
        // \Queue::put($tube, $data);
        $uri = $this -> route() -> getUri();
        $uri = \Route::getUri();

        $parameters = $this -> route() -> getParameters();
        $parameters = \Route::getParameters();

        $parametersName = $this -> route() -> getParametersName();

        $action = $this -> route() -> getAction();

        $methods = $this -> route() -> getMethods();

        $currentMethod = $this -> route() -> getCurrentMethod();

        $timezone = $this -> getContainer() -> getTimezone();

        $environment = $this -> getContainer() -> getEnvironment();

        $this -> setFlashMessage('info', '消息提示！');

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
