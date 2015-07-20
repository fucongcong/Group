<?php
use core\Group\Kernal;

$loader = require __DIR__.'/vendor/autoload.php';

$loader->setUseIncludePath(true);

//dev,prod
$kernal = new Kernal("dev");

$kernal->init();

?>