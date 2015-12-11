<?php

namespace core\Group\Cron\Tests;

class Test
{
    public function init()
    {
        \Log::info('nihao', ['time' => date('Y-m-d H:i:s', time())], 'cron.job');
    }

}