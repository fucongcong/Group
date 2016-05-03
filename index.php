<?php

use Group\Kernal;

define('__ROOT__', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

$loader = require __DIR__.'/vendor/autoload.php';

$loader->setUseIncludePath(true);

$kernal = new Kernal();

$kernal->init(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR, $loader);
