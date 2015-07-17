Group
=====

MVC框架，整合了前段框架bootstrap，seajs.模板引擎使用的是Twig(非常强大好用)  后端分为controller,service,dao3层。
基础类簪未封装.


如何配置：
将doc文件夹中的NGNIX配置复制即可


config.php 为配置文件

web文件夹下的routing.php 为路由配置
新增路由匹配机制（还将完善，目前还没有对methods和pattern做相应方法处理）

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
