# Group
访问[xitongxue.com](http://xitongxue.com),觉得帮到您了点击右上star!给我一点动力！
关注我们的ＱＱ群：390536187

####1.[Group框架简介](#user-content-Group框架简介)
- [前端框架介绍](#user-content-1前端框架介绍)
- [后端框架介绍](#user-content-2后端框架介绍)

####2.[快速开始](#user-content-快速开始)
- [配置文件](#user-content-1配置文件)
- [进入框架](#user-content-2进入框架)
- [目录结构](#user-content-3目录结构)

####3.[路由篇](#user-content-路由篇)

####4.[控制层](#user-content-控制层)

####5.[服务层](#user-content-服务层)

####6.[数据层](#user-content-数据层)

####7.[框架基础服务](#user-content-框架基础服务)
- [Container](#user-content-1Container)
- [Cooike](#user-content-2Cooike)
- [Session](#user-content-3Session)
- [Request](#user-content-4Request)
- [Response](#user-content-5Response)
- [Log](#user-content-6Log)
- [Exception](#user-content-7Exception)
- [Redis](#user-content-8Redis)
- [Console](#user-content-9Console)

## Group框架简介
####1.前端框架介绍
（1）整合bootstrap（帮助你更快速开发）

（2）整合seajs（有效管理JS模块）

####2.后端框架介绍
（1）模版引擎：twig （symfony2使用的模版引擎）

（2）DSCV架构：Dao（数据层）,Service（服务层），Controller（控制层），View（视图层）

## 快速开始
####1.配置文件

[Ngnix配置](https://github.com/fucongcong/Group/blob/master/doc/ngnix_server_config.txt)

####2.进入框架

访问 http://localhost:8081 进入框架主页

####3.目录结构
- asset (前端文件)
    - css
    - fonts
    - img
    - js
    - lib
- config (配置文件)
	- app.php
    - database.php
    - view.php
- core (框架核心，后期将会打包到composer)
- doc (文档)
- runtime (缓存)
- src (你的网站核心代码)
	- Services （服务层）
		- Group (示例)
			- Dao （数据层）
		  		- Impl （数据层接口）
		  	- Impl （服务层接口）
	- Web
	 	- Controller （控制层）
	 	- View (视图层)
	 	- routing.php （路由配置）
- index.php(主入口)

## 路由篇
（1）自定义路由

（2）动态参数绑定

（3）restful API 风格

示例：
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


## 控制层


