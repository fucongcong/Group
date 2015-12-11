# Group
觉得帮到您了点击右上star!给我一点动力！
关注我们的ＱＱ群：390536187

[![Code Climate](https://codeclimate.com/repos/5657fbc8ea0d1f5571028f67/badges/c8175ffa03bd301eb7c7/gpa.svg)](https://codeclimate.com/repos/5657fbc8ea0d1f5571028f67/feed)
[![Build Status](https://travis-ci.org/fucongcong/Group.svg?branch=master)](https://travis-ci.org/fucongcong/Group)

####1.[Group框架简介](#user-content-group框架简介)

- [后端框架介绍](#user-content-框架介绍)

####2.[快速开始](#user-content-快速开始)
- [服务器配置文件](#user-content-1服务器配置文件)
- [进入框架](#user-content-2进入框架)
- [目录结构](#user-content-3目录结构)

####3.[路由篇](#user-content-路由篇)

####4.[控制层](#user-content-控制层)

####5.[服务层](#user-content-服务层)

####6.[数据层](#user-content-数据层)

####7.[框架基础服务](#user-content-框架基础服务)
- [Container](#user-content-container)
- [Cache](#user-content-cache)
- [Config](#user-content-config)
- [Console](#user-content-console)
- [CronJob](#user-content-cronjob)
- [Exception](#user-content-exception)
- [EventDispatcher](#user-content-eventdispatcher)
- [FileCache](#user-content-filecache)
- [Filesystem](#user-content-filesystem)
- [Request](#user-content-request)
- [Response](#user-content-response)
- [Session](#user-content-session)
- [Log](#user-content-log)


####8.[单元测试](#user-content-单元测试)

## Group框架简介

####环境依赖
- PHP > 5.5

####扩展模块
- [PhpRedis](https://github.com/phpredis/phpredis)
- [Swoole](https://github.com/swoole/swoole-src)

####框架介绍
（1）模版引擎：twig （symfony2使用的模版引擎）

（2）分层：Dao（模型层）,Service（服务层），Controller（控制层），View（视图层）

## 快速开始
#### 准备
进入目录，执行以下命令

	git clone https://github.com/fucongcong/Group.git

	cd Group

	composer install

####1.服务器配置文件

[Ngnix配置](https://github.com/fucongcong/Group/blob/master/doc/ngnix_server_config.txt)

####2.进入框架

访问 http://localhost:8081 进入框架主页

####3.目录结构
- app (脚本文件)
- asset (前端文件)
- config (配置文件)
- core (框架核心，后期将会打包到composer)
- doc (文档)
- runtime (缓存)
- src (你的网站核心代码)
	- Services （服务层）
		- Group (示例)
			- Dao （数据层）
		  		- Impl （数据层接口）
		  	- Impl （服务层接口）
		  	- Rely （服务之间的依赖）
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

```php
<?php
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
```


## 控制层

（1）第一个控制器

```php
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
```

（2）如何获取路由传过来的参数？

```php
<?php
namespace src\Web\Controller\Group;

use Controller;
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

    $currentMethod = $this -> route() -> getCurrentMethod();
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
        'currentMethod' => $currentMethod,
        'timezone' => $timezone,
        'environment' => $environment
        ));
}
public function getGroupService()
{
	//创建一个Service实例
    return $this -> createService("Group:Group");
}
```

## 服务层
#####（1）简单介绍一下目录结构
- Group (示例)
    - Dao （数据层）
    - Impl （服务层实现的接口）
    - Rely （定义服务之间的依赖关系）
GroupService.php(接口)

#####服务层主要用于处理数据层与控制层间数据的业务处理。只要继承Service类就可以了。

    GroupService.php
```php
<?php
namespace src\Services\Group;

interface GroupService
{
    public function getGroup($id);
}
```

    /Rely/GroupBaseService.php

```php
<?php
namespace src\Services\Group\Rely;

use Service;
//定义在Rely文件下的依赖
abstract class GroupBaseService extends Service
{
    //获取数据层的对象实例
    public function getGroupDao()
    {
        return $this->createDao("Group:Group");
    }

    //获取其他服务的对象实例
    public function getUserService()
    {
        return $this -> createService("User:User");
    }
}
```

    /Impl/GroupServiceImpl.php

```php
<?php
namespace src\Services\Group\Impl;

use src\Services\Group\Rely\GroupBaseService;
use src\Services\Group\GroupService;

class GroupServiceImpl extends GroupBaseService implements GroupService
{
    //实现定义的服务层接口方法
    public function getGroup($id)
    {
        return $this -> getUserService() -> getUser(1);
        //return $this->getGroupDao()->getGroup($id);
    }

}
```

## 数据层
#####支持主从配置(详见配置文件)

#####如何使用

```php
<?php

    namespace src\Services\Group\Dao\Impl;

    use Dao;
    use src\Services\Group\Dao\GroupDao;

    class GroupDaoImpl extends Dao implements GroupDao
    {
        //定以数据表
        protected $tables="groups";

        //具体方法
        public function getGroup($id)
        {
            $sql="SELECT * FROM {$this->tables} WHERE id=:id LIMIT 0,1";
            //动态参数绑定
            $bind = array('id' => $id);
            //读取默认配置
            //$group = $this->getDefault()->fetchOne($sql, $bind);

            //读取写服务器配置，如果没有指定具体参数，随机写入分配的服务器
            //$group = $this->getWrite('master1')->fetchOne($sql, $bind);
            //$group = $this->getWrite('master2')->fetchOne($sql, $bind);

            //读取读服务器配置，如果没有指定具体参数，随机读取分配的服务器
            //$group = $this->getRead()->fetchOne($sql, $bind);
            return $group ? $group : null;
        }

    }
```

#####支持的语法

#####fetch(*)
```php
    $pdo = $this->getDefault();

    $stm  = 'SELECT * FROM test WHERE foo = :foo AND bar = :bar';
    $bind = array('foo' => 'baz', 'bar' => 'dib');
    $result = $pdo->fetchAll($stm, $bind);

    // fetchAssoc() returns an associative array of all rows where the key is the
    // first column, and the row arrays are keyed on the column names
    $result = $pdo->fetchAssoc($stm, $bind);

    // fetchGroup() is like fetchAssoc() except that the values aren't wrapped in
    // arrays. Instead, single column values are returned as a single dimensional
    // array and multiple columns are returned as an array of arrays
    // Set style to PDO::FETCH_NAMED when values are an array
    // (i.e. there are more than two columns in the select)
    $result = $pdo->fetchGroup($stm, $bind, $style = PDO::FETCH_COLUMN)

    // fetchObject() returns the first row as an object of your choosing; the
    // columns are mapped to object properties. an optional 4th parameter array
    // provides constructor arguments when instantiating the object.
    $result = $pdo->fetchObject($stm, $bind, 'ClassName', array('ctor_arg_1'));

    // fetchObjects() returns an array of objects of your choosing; the
    // columns are mapped to object properties. an optional 4th parameter array
    // provides constructor arguments when instantiating the object.
    $result = $pdo->fetchObjects($stm, $bind, 'ClassName', array('ctor_arg_1'));

    // fetchOne() returns the first row as an associative array where the keys
    // are the column names
    $result = $pdo->fetchOne($stm, $bind);

    // fetchPairs() returns an associative array where each key is the first
    // column and each value is the second column
    $result = $pdo->fetchPairs($stm, $bind);

    // fetchValue() returns the value of the first row in the first column
    $result = $pdo->fetchValue($stm, $bind);

    // fetchAffected() returns the number of affected rows
    $stm = "UPDATE test SET incr = incr + 1 WHERE foo = :foo AND bar = :bar";
    $row_count = $pdo->fetchAffected($stm, $bind);
```
#####数组转换

```php
    $pdo = $this->getDefault();

    $stm = 'SELECT * FROM test WHERE foo IN (:foo)'

    $array = array('foo', 'bar', 'baz');
    $cond = 'IN (' . $pdo->quote($array) . ')';

    $bind_values = array('foo' => $array);
    $sth = $pdo->perform($stm, $bind_values);
    echo $sth->queryString;
    // "SELECT * FROM test WHERE foo IN ('foo', 'bar', 'baz')"
```

## 框架基础服务

## Container
#####Container是一个基础的容器，一些系统变量会存放于这里

## Cache

#####目前只支持了Redis得cache，使用请在cache.php配置中配置redis

```php

    use Cache;
    //key value expireTime
    Cache::set('ha', 123, 60);
    //也可以这样
    Cache::redis() -> set('haa', 123, 60);

    Cache::get('ha');
    Cache::hSet($hashKey, $key, $data, $expireTime);
    Cache::hGet($hashKey, $key);
    Cache::hDel($hashKey, $key);
    Cache::hDel($hashKey);

    //现在的类库方法还未扩展完全，目前只有以上方法
    //你可以使用Cache::redis() 获取redis实例，这是一个PhpRedis的实例，api－》(https://github.com/phpredis/phpredis)
```

## FileCache

#####文件形式的缓存

```php

    use FileCache;

    //默认路径是放在runtime/cache/
    FileCache::set('test.php', ['testdfata' => 'datadata']);
    //指定路径
    FileCache::set('test.php', ['testdfata' => 'datadata'], 'runtime/cache/test/');

    FileCache::get('test.php');
    FileCache::get('test.php', 'runtime/cache/test/');

```

## Config

#####用于查找config目录下得配置

```php

    use Config;

    //文件名::key
    Config::get('app::environment');

    //也可以重新设置ests
    Config::set('app', 'environment', 'dev');
```

## EventDispatcher

#####事件监听

#####先写一个监听KernalResponseListener
```php
<?php

namespace src\web\Listeners;

use Listener;
use Event;

class KernalResponseListener extends Listener
{
    public function setMethod()
    {
        return 'onKernalResponse';
    }

    //触发时执行
    public function onKernalResponse(Event $event)
    {
        echo 'this is a KernalResponse Listener';
    }
}

```

#####绑定监听

```php

    use EventDispatcher;

    $listener = new KernalResponseListener();

    //定义一个事件名称，触发的监听器，和一个重要指数
    EventDispatcher::addListener('kernal.responese', $listener, 10);

    EventDispatcher::removeListener('kernal.responese', $listener);

    EventDispatcher::hasListeners('kernal.responese');

    //最后可以在需要的时候派发事件
    EventDispatcher::dispatch('kernal.responese');
    EventDispatcher::dispatch('kernal.responese', $envet);

```

## Session

#####Session 目前支持2中方式存储，默认存放在runtime/sessions下，也可以开启redis driver，将session存在redis中，详见配置
```php

    use Session;

    Session::set('group', 'good');
    Session::get('group');
    Session::remove('group');
    Session::has('group');
    Session::clear();
    Session::all();
    Session::isStarted();

    $attributes = ['group' => 'hello'];
    Session::replace($attributes);
```
## Log

#####默认存放于runtime/log
```php

    use Log;

    Log::debug('123',['user'=>1]);
    Log::info('123',['user'=>1]);
    Log::notice('123',['user'=>1]);
    Log::warning('123',['user'=>1]);
    Log::error('123',['user'=>1]);
    Log::critical('123',['user'=>1]);
    Log::alert('123',['user'=>1]);
    Log::emergency('123',['user'=>1]);

    //默认model是web.app,也可以自定义
    Log::emergency('123',['user'=>1],'web.admin');

```

## Console

####控制台的使用方法

    //进入根目录 执行
    app/console


    ----------------------------------------------------------

     -----        ----      ----      |     |   / ----
    /          | /        |      |    |     |   |      |
    |          |          |      |    |     |   | ----/
    |   ----   |          |      |    |     |   |
     -----|    |            ----       ----     |

    ----------------------------------------------------------

    使用帮助:
    Usage: core/console [options] [args...]

    generate:service name       生成一个自定义service
    generate:controller  name    生成一个自定义controller
    sql:generate                生成一个sql执行模板(存放于app/sql)
    sql:migrate                 执行sql模板


## CronJob
#####异步定时器介绍
#####依赖：[Swoole1.7.14以上版本](https://github.com/swoole/swoole-src)

#####配置文件config/cron.php
#####执行命令

    php app/cron.php &

#####注意，如果要更新定时器配置，或者代码逻辑时，需要重新执行脚本命令(暂不支持热更新)，文件日志存放于runtime/cron，定时器进程id为runtime/pid


## 单元测试

    phpunit --bootstrap app/test.php src
