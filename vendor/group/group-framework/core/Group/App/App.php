<?php

namespace Group\App;

use Group\Handlers\AliasLoaderHandler;
use Group\Config\Config;
use Group\Routing\Router;
use Group\Handlers\ExceptionsHandler;
use Group\Events\HttpEvent;
use Group\Events\KernalEvent;
use Group\Cache\BootstrapClass;

class App
{
    /**
     * array singletons
     *
     */
    protected $singletons;

    private static $instance;

    public $container;

    public $router;

    /**
     * array aliases
     *
     */
    protected $aliases = [
        'App'               => 'Group\App\App',
        'Cache'             => 'Group\Cache\Cache',
        'Config'            => 'Group\Config\Config',
        'Container'         => 'Group\Container\Container',
        'Controller'        => 'Group\Controller\Controller',
        'Dao'               => 'Group\Dao\Dao',
        'Event'             => 'Group\Events\Event',
        'EventDispatcher'   => 'Group\EventDispatcher\EventDispatcher',
        'Filesystem'        => 'Group\Common\Filesystem',
        'FileCache'         => 'Group\Cache\FileCache',
        'Route'             => 'Group\Routing\Route',
        'Request'           => 'Group\Http\Request',
        'Response'          => 'Group\Http\Response',
        'JsonResponse'      => 'Group\Http\JsonResponse',
        'Service'           => 'Group\Services\Service',
        'ServiceProvider'   => 'Group\Services\ServiceProvider',
        'Session'           => 'Group\Session\Session',
        'Test'              => 'Group\Test\Test',
        'Log'               => 'Group\Log\Log',
        'Listener'          => 'Group\Listeners\Listener',
        'Queue'             => 'Group\Queue\Queue',
    ];

    /**
     * array singles
     *
     */
    protected $singles = [];

    protected $serviceProviders = [];

    protected $bootstraps = [
        'Route', 'EventDispatcher', 'Event', 'Dao', 'Controller', 'Cache', 'Session', 'Log', 'Listener', 'Request', 'Response'
    ];

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
    public function init($path, $loader)
    {
        $this -> initSelf();

        $this -> doBootstrap($loader);

        $request = \Request::createFromGlobals();

        $this -> registerServices();
       
        \EventDispatcher::dispatch(KernalEvent::INIT);

        $this -> container = $this -> singleton('container');
        $this -> container -> setAppPath($path);
        
        $handler = new ExceptionsHandler();
        $handler -> bootstrap($this);

        $this -> container -> setRequest($request);

        $this -> router = new Router($this -> container);
        self::getInstance() -> router = $this -> router;
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

    /**
     * 处理响应请求
     *
     */
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

    /**
     * 类文件缓存
     *
     * @param loader
     */
    public function doBootstrap($loader) 
    {   
        $this -> setServiceProviders();

        if (Config::get('app::environment') == "prod" && file_exists("runtime/cache/bootstrap.class.cache")) {
            require "runtime/cache/bootstrap.class.cache";
            return;
        }

        $bootstrapClass = new BootstrapClass($loader);
        foreach ($this -> serviceProviders as $serviceProvider) {
            $bootstrapClass -> setClass($serviceProvider);
        }
        foreach ($this -> bootstraps as $bootstrap) {
            $bootstrap = isset($this -> aliases[$bootstrap]) ? $this -> aliases[$bootstrap] : $bootstrap;
            $bootstrapClass -> setClass($bootstrap);
        }
        $bootstrapClass -> bootstrap();
    }

    /**
     * set ServiceProviders
     *
     */
    public function setServiceProviders()
    {
        $providers = Config::get('app::serviceProviders');
        $this -> serviceProviders = array_merge($providers, $this -> serviceProviders);
    }
}
