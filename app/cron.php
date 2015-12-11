<?php

define('__ROOT__', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "../");

require __DIR__.'/../core/Group/Cron/Cron.php';

$cron = new Cron();
$cron -> run();

