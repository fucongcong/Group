Group
=====

初级MVC框架，整合了前段框架bootstrap，seajs.  后端分为controller,service,dao3层。
基础类全部未封装.


如何配置：
将doc文件夹中的NGNIX配置复制即可


config.php 为配置文件

web文件夹下的routing.php 为路由配置
新增路由匹配机制

src/routing.php:


	return array(

		'/'=>[
			'pattern' => 'homepage',
			'_controller' => 'web:Default:index',
			'methods' => 'GET',
		],

		'/group/{id}'=>[
			'pattern' => 'group',
			'_controller' => 'web:Group:index',
			'methods' => 'GET',
		],

		'/user/{id}/group/{groupId}'=>[
			'pattern' => 'user_group',
			'_controller' => 'web:Group:test',
			'methods' => 'Get',
		],


	);



controller 为控制层文件存放目录
views为模板文件存放目录

files为上传文件存放目录

services为服务文件夹，控制业务逻辑


asset文件夹中的lib文件夹存放网站JS文件

js文件夹存放js的资源文件