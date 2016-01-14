<?php

namespace src\Web\Queue;

use Group\Queue\QueueJob;

class TestJob extends QueueJob
{	
    public function handle()
    {	
        \Log::info('queue handle job'.$this -> jobId, ['time' => date('Y-m-d H:i:s', time())], 'queue.job');
    }

}