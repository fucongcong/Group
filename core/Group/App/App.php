<?php

namespace core\Group\App;

use core\Group\Handlers\AliasLoaderHandler;
use core\Group\Config\Config;
use Exception;
use core\Group\Routing\Router;

class App
{
    protected $singletons;

    private static $_instance;

    protected $services;

    protected $container;

    protected $router;

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
        'Service'           => 'core\Group\Services\Service',
        'ServiceProvider'   => 'core\Group\Services\ServiceProvider',
        'Test'              => 'core\Group\Test\Test',
    ];

    protected $singles = [

    ];

    protected $instances = [
        'route'             => '\Route',
        'container'             => '\Container',
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
        self::$_instance = new self;

        $this -> container = $this -> singleton('container');

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
        $aliases = array_merge($aliases, $this -> aliases);
        AliasLoaderHandler::getInstance($aliases) -> register();

    }

    public function singleton($name, $callable = null)
    {
        if(!isset($this -> singletons[$name]) && $callable) {

            $this -> singletons[$name] = call_user_func($callable);
        }

        return $this -> singletons[$name];
    }

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
     * return single class
     *
     * @return core\App\App App
     */
    public static function getInstance(){

        if(!(self::$_instance instanceof self)){

            self::$_instance = new self;
        }

        return self::$_instance;
    }

}