<?php
use core\Group\Kernal;

$loader = require __DIR__.'/vendor/autoload.php';

$loader->setUseIncludePath(true);

$kernal = new Kernal();

$kernal->init();

?>