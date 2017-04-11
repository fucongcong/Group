<?php

namespace src\Web\Controller\Home;

use Controller;

//请继承Controller
class DefaultController extends Controller
{
    //一个action 与route对应
    public function indexAction()
    {	
        //渲染模版 模版的启始路径可在config的view.php配置
        return $this -> render('Web/Views/Default/index.html.twig');
    }
}
