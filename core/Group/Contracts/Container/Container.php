<?php

namespace core\Group\Contracts\Container;

interface Container
{
    /**
     * build a moudle class
     *
     * @param  class
     * @return ReflectionClass class
     */
    public function buildMoudle($class);

    /**
     * do the moudle class action
     *
     * @param  class
     * @param  action
     * @param  array parameters
     * @return string
     */
    public function doAction($class, $action, array $parameters = []);

    /**
     * 设置时区
     *
     */
    public function setTimezone();

    /**
     * 获取当前时区
     *
     */
    public function getTimezone();

    /**
     * 设置环境
     *
     *@return string prod｜dev
     */
    public function getEnvironment();

    /**
     * 获取当前环境
     *
     */
    public function setEnvironment();
}
