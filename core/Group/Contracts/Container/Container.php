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
}
