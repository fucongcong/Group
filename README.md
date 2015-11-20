# Group
觉得帮到您了点击右上star!给我一点动力！
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
- [FileCache](#user-content-9FileCache)
- [Cache](#user-content-10Cache)
- [Config](#user-content-10Config)

## Group框架简介
####1.前端框架介绍
（1）整合bootstrap（帮助你更快速开发）

（2）整合seajs（有效管理JS模块）

####2.后端框架介绍
（1）模版引擎：twig （symfony2使用的模版引擎）

（2）架构：Dao（数据层）,Service（服务层），Controller（控制层），View（视图层）

## 快速开始
#### 准备
进入目录，执行以下命令

	git clone https://github.com/fucongcong/Group.git

	cd Group

	composer install

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
		    	'controller' => 'Web:Home:Default:index',
		    ],

		    'group'=>[
		    	'pattern' => '/group/{id}',
		    	'controller' => 'Web:Group:Group:test',
		    	'methods' => 'GET',
		    ],

		    'create_group'=>[
		        'pattern' => '/group/{id}',
		        'controller' => 'Web:Group:Group:index',
		        'methods' => 'POST',
		    ],

		    'user_group'=>[
		    	'pattern' => '/user/{id}/group/{groupId}',
		    	'controller' => 'Web:Group:Group:test',
		    	'methods' => 'GET',
		    ],


	);


## 控制层

（1）第一个控制器

	<?php
	namespace src\web\Controller\Home;

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

	?>

（2）如何获取路由传过来的参数？

	//在后面我们可以跟上路由定义好的参数，$id
    public function testAction($id)
    {
        // echo $id; echo "<br>";

        //可以获取整个路由地址
        $uri = $this -> route() -> getUri();
        //获取所有参数
        $parameters = $this -> route() -> getParameters();
        //获取参数名
        $parametersName = $this -> route() -> getParametersName();
        //获取当前action的名称
        $action = $this -> route() -> getAction();
        //获取系统支持的请求方法
        $methods = $this -> route() -> getMethods();
        //获取当前时区
        $timezone = $this -> getContainer() -> getTimezone();
        //获取当前运行环境
        $environment = $this -> getContainer() -> getEnvironment();
        //这里和Service服务层交互
        echo $this->getGroupService()->getGroup(1);
        //传入模板
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
    	//创建一个Service实例
        return $this -> createService("Group:Group");
    }

## 服务层

## 数据层

## 配置文件