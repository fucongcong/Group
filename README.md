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
			'_controller' => 'web:Home:Default:index',
			'methods' => 'GET',
		],

		'group'=>[
			'pattern' => '/group/{id}',
			'_controller' => 'web:Group:Group:index',
			'methods' => 'GET',
		],

		'create_group'=>[
			'pattern' => '/group/{id}',
			'_controller' => 'web:Group:Group:index',
			'methods' => 'POST',
		],

		'user_group'=>[
			'pattern' => '/user/{id}/group/{groupId}',
			'_controller' => 'web:Group:Group:test',
			'methods' => 'GET',
		],


	);

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
