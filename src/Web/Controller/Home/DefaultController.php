<?php

namespace src\Web\Controller\Home;

use Controller;

//请继承Controller
class DefaultController extends Controller
{
    //一个action 与route对应
    public function indexAction()
    {	
    	// $server = 'user_server'; //config配置的serverName
	    // $cmd = "getUserInfo"; // 传给server的指令
	    // $data = [1,2,3,4,5,6,7,8,9,10]; // 数据
	    // $needRecvData = true; //默认为true，false的话server端不会返回数据
	    // $users = \Async::call($server, $cmd, $data, $needRecvData);
    	// dump(json_decode($users, true));
        //渲染模版 模版的启始路径可在config的view.php配置
        return $this -> render('Web/Views/Default/index.html.twig');
    }
}
