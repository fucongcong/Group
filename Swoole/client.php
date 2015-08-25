<?php

use core\Group\Handlers\AliasLoaderHandler;
use core\Group\Config\Config;

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->setUseIncludePath(true);


function aliasLoader()
{
    $aliases = Config::get('app::aliases');
    AliasLoaderHandler::getInstance($aliases) -> register();

}

aliasLoader();

$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9502, 0.5))
{
    die("connect failed.");
}

if ($client->send("hello world"))
{
    echo '成功发送';
}


echo $client->recv();
$client->close();