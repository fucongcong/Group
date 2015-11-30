<?php

namespace core\Group\Contracts\Controller;

interface Controller
{
    /**
     * 渲染模板的方法
     *
     * @param  string  $tpl
     * @param  array   $array
     * @return response
     */
    public function render($tpl, $array = array());

    /**
     * 实例化一个服务类
     *
     * @param  string  $serviceName
     * @return class
     */
    //to do 单列 可以扩展为模块
    public function createService($serviceName);

    /**
     * route的实例
     *
     * @return core\Group\Routing\Route
     */
    public function route();

    /**
     * 获取容器
     *
     * @return core\Group\Container\Container
     */
    public function getContainer();
}
