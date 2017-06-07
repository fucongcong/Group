<?php

namespace src\Web\Queue;

use Group\Queue\QueueJob;

class UpdateUser extends QueueJob
{	
    public function handle()
    {	
        $data = json_decode($this->jobData, true);
        $nickname = $data['nickname'];

        $user = $this->getUserService()->getUserByName($nickname);
        if ($user) {
            $res = $this->getUserService()->updateUserPassword($user['id'], "password_".$this->jobId);
            //if ($res) \Cache::getRedis()->incr('queue_count');
        } else {
            \Queue::put('update_user_info', $this->jobData);
            \Log::error($this->jobId, [$data, $user], 'queue.job');
        }
    }

    public function getUserService()
    {
        return service("User:User");
    }
}