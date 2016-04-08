<?php

namespace Group\Cron;

abstract class CronJob
{
    abstract function handle();
}