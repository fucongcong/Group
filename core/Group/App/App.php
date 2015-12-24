<?php

namespace Group\App;

use Group\Handlers\AliasLoaderHandler;
use Group\Config\Config;
use Group\Routing\Router;
use Group\Handlers\ExceptionsHandler;
use Group\Events\HttpEvent;
use Group\Events\KernalEvent;

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
