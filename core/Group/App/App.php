<?php

namespace core\Group\App;

use core\Group\Handlers\AliasLoaderHandler;
use core\Group\Config\Config;
use core\Group\Routing\Router;
use core\Group\Handlers\ExceptionsHandler;
use core\Group\Events\HttpEvent;
use core\Group\Events\KernalEvent;

class App
{
    /**
     * array singletons
     *
     */
    protected $singletons;

    private static $instance;

    public $container;

    protected $router;

    /**
     * array aliases
     *
     */
    protected $aliases = [
        'App'               => 'core\Group\App\App',
        'Cache'             => 'core\Group\Cache\Cache',
        'Config'            => 'core\Group\Config\Config',
        'Container'         => 'core\Group\Container\Container',
        'Controller'        => 'core\Group\Controller\Controller',
        'Dao'               => 'core\Group\Dao\Dao',
        'Event'             => 'core\Group\Events\Event',
        'EventDispatcher'   => 'core\Group\EventDispatcher\EventDispatcher',
        'Filesystem'        => 'core\Group\Common\Filesystem',
        'FileCache'         => 'core\Group\Cache\FileCache',
        'Route'             => 'core\Group\Routing\Route',
        'Request'           => 'core\Group\Http\Request',
        'Response'          => 'core\Group\Http\Response',
        'JsonResponse'      => 'core\Group\Http\JsonResponse',
        'Service'           => 'core\Group\Services\Service',
        'ServiceProvider'   => 'core\Group\Services\ServiceProvider',
        'Session'           => 'core\Group\Session\Session',
        'Test'              => 'core\Group\Test\Test',
        'Log'               => 'core\Group\Log\Log',
        'Listener'          => 'core\Group\Listeners\Listener',
    ];

    /**
     * array singles
     *
     */
    protected $singles = [];

    protected $serviceProviders = [];

    //to do
    protected $instances = [
        'container'         => '\Container',
    ];

    public function __construct()
    {
        $this -> aliasLoader();

        $this -> doSingle();

        $this -> doSingleInstance();
    }

    /**
     * init appliaction
     *
     */
    public function init($path)
    {
        $this -> initSelf();

        $request = \Request::createFromGlobals();

        $this -> registerServices();
        
        \EventDispatcher::dispatch(KernalEvent::INIT);

        //做一些request过来要做的 然后在派发事件
        //\EventDispatcher::dispatch(KernalEvent::REQUEST, new HttpEvent($request));

        $this -> container = $this -> singleton('container');
        $this -> container -> setAppPath($path);
        $this -> container -> setRequest($request);

        $handler = new ExceptionsHandler();
        $handler -> bootstrap($this);

        $this -> router = new Router($this -> container);
        $this -> router -> match();
    }

    /**
     * do the class alias
     *
     */
    public function aliasLoader()
    {
        $aliases = Config::get('app::aliases');

        $this -> aliases = array_merge($aliases, $this -> aliases);

        AliasLoaderHandler::getInstance($this -> aliases) -> register();

    }

    /**
     *  向App存储一个单例对象
     *
     * @param  name，callable
     * @return object
     */
    public function singleton($name, $callable = null)
    {
        if (!isset($this -> singletons[$name]) && $callable) {

            $this -> singletons[$name] = call_user_func($callable);
        }

        return $this -> singletons[$name];
    }

    /**
     *  在网站初始化时就已经生成的单例对象
     *
     */
    public function doSingle()
    {
        foreach ($this -> singles as $alias => $class) {

            $this -> singletons[$alias] = new $class();
        }
    }

    public function doSingleInstance()
    {
        foreach ($this -> instances as $alias => $class) {

            $this -> singletons[$alias] = $class::getInstance();
        }
    }

    /**
     *  注册服务
     *
     */
    public function registerServices()
    {
        $providers = Config::get('app::serviceProviders');

        $this -> serviceProviders = array_merge($providers, $this -> serviceProviders);

        foreach ($this -> serviceProviders as $provider) {

            $provider = new $provider(self::$instance);
            $provider -> register();
        }
    }

    /**
     * return single class
     *
     * @return core\App\App App
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)){

            self::$instance = new self;
        }

        return self::$instance;
    }

    public function handleHttp()
    {
        $response = $this -> container -> getResponse();
        $request = $this -> container -> getRequest();
        \EventDispatcher::dispatch(KernalEvent::RESPONSE, new HttpEvent($request,$response));
    }

    public function initSelf()
    {
        self::$instance = new self;
    }

    public function rmSingletons($name)
    {
        if(isset($this -> singletons[$name]))
            unset($this -> singletons[$name]);
    }
}
