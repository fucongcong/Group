Group
=====

####MVC框架，整合了前段框架bootstrap，seajs.模板引擎使用的是Twig(非常强大好用)  后端分为controller,service,dao3层。
基础类未封装完成.


###Step.1如何配置服务器(目前只有Ngnix配置)：
	将doc文件夹中的NGNIX配置复制即可


###Step.２配置数据库与自定义路由

####2.1根目录config.php为数据库配置文件 

####2.2web文件夹下的routing.php 为路由配置

	src/routing.php:


	return array(

		    'homepage'=>[
		    	'pattern' => '/',
		    	'_controller' => 'Web:Home:Default:index',
		    	'methods' => 'GET',
		    ],

		    'group'=>[
		    	'pattern' => '/group/{id}',
		    	'_controller' => 'Web:Group:Group:test',
		    	'methods' => 'GET',
		    ],

		    'create_group'=>[
		        'pattern' => '/group/{id}',
		        '_controller' => 'Web:Group:Group:index',
		        'methods' => 'POST',
		    ],

		    'user_group'=>[
		    	'pattern' => '/user/{id}/group/{groupId}',
		    	'_controller' => 'Web:Group:Group:test',
		    	'methods' => 'GET',
		    ],


	);

####2.3控制层，以路由　user_group　为例
	 'user_group'=>[
		    	'pattern' => '/user/{id}/group/{groupId}',
		    	'_controller' => 'Web:Group:Group:test',
		    	'methods' => 'GET',
	    ],

	我们自定义路由/user/{id}/group/{groupId}，id与groupId都是参数，用 {} 包起来,
	我们定义了_controller　地址为Web:Group:Group:test
	接下来我们可以在　Web/Controller　中找到　Ｇroup　文件夹下的　GroupController的　testAction　这个方法

	<?php
		namespace src\web\Controller\Group;

		use core\Group\Controller\Controller;

		class GroupController extends Controller
		{
		    //可获得路由中传入的参数id, groupId
		    public function testAction($id, $groupId)
		    {   
		        echo $id;　echo $groupId;
		        //获取当前路由地址
		        echo $this->route()->getUri();
		        //获取当前参数
		        print_r($this->route()->getParameters());
		        //获取当前参数名
		        print_r($this->route()->getParametersName());
		        //获取当前方法名
		        echo $this->route()->getAction();
		        //获取系统允许的方法
		        print_r($this->route()->getMethods());

		        
		        //$group=$this->getGroupService()->getGroup(1);
		        return $this->render('Web/Views/Group/index.html.twig',array(
		            'group'=>$group));
		    }

		    //这是进入我们服务层的方法
		    public function getGroupService()
		    {
		        return $this->createService("Group:Group");
		    }

		}

		?>
####2.4服务层Service,找到我们的src\Service
	
	在controller层中，我们定义了
	public function getGroupService()
	{
	    return $this->createService("Group:Group");
	}

	这时候系统会自动寻找src\Service下，Ｇroup文件夹中的GroupServiceImpl类，具体请看src\Service\Group中的demo


###Step.3一些目录介绍

####3.1 src/web

Controller 为控制层文件存放目录

views为模板文件存放目录

####3.2 src/Services

服务文件夹，控制业务逻辑

####3.3 asset

css文件夹存放css的资源文件

fonts文件夹存放fonts的资源文件

img文件夹存放img的资源文件

js文件夹存放js的资源文件

lib文件夹存放网站js库文件
