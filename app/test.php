<?php
use core\Group\App\App;

$loader = require __DIR__.'/../vendor/autoload.php';

define('__ROOT__', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "../");

$loader->setUseIncludePath(true);

$app = new App();

?>