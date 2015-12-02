<?php

namespace core\Group\App;

use core\Group\Handlers\AliasLoaderHandler;
use core\Group\Config\Config;
use Exception;
use core\Group\Routing\Router;

class App
{
    /**
     * array singletons
     *
     */
    protected $singletons;

    private static $instance;

    protected $container;

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
        'Filesystem'        => 'core\Group\Common\Filesystem',
        'FileCache'         => 'core\Group\Cache\FileCache',
        'Route'             => 'core\Group\Routing\Route',
        'Request'           => 'core\Group\Http\Request',
        'Response'          => 'core\Group\Http\Response',
        'Service'           => 'core\Group\Services\Service',
        'ServiceProvider'   => 'core\Group\Services\ServiceProvider',
        'Test'              => 'core\Group\Test\Test',
    ];

    /**
     * array singles
     *
     */
    protected $singles = [];

    protected $serviceProviders = [];

    protected $instances = [
        'route'             => '\Route',
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
    public function init()
    {
        self::$instance = new self;

        $request = \Request::createFromGlobals();

        $this -> registerServices();

        $this -> container = $this -> singleton('container');

        $this -> router = new Router($this -> container, $request);
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
        if(!isset($this -> singletons[$name]) && $callable) {

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
    public static function getInstance(){

        if(!(self::$instance instanceof self)){

            self::$instance = new self;
        }

        return self::$instance;
    }

}