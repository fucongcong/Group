<?php

namespace src\Web\Cron;

use Group\Cron\CronJob;

class Test extends CronJob
{
    public function handle()
    {
        \Log::info('nihao', ['time' => date('Y-m-d H:i:s', time())], 'cron.job');
    }

}