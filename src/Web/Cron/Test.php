<?php

namespace src\Web\Cron;

class Test
{
    public function handle()
    {
        \Log::info('nihao', ['time' => date('Y-m-d H:i:s', time())], 'cron.job');
    }

}