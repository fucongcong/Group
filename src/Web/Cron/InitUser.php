<?php

namespace src\Web\Cron;

use Group\Cron\CronJob;

class InitUser extends CronJob
{
    public function handle()
    {   
        $users = [];
        for ($i=0; $i < 300; $i++) { 
            $users[] = [
                'nickname' => 'user_'.$i.time(),
                'email' => 'test@qq.com'.$i.time(),
                'password' => mt_rand(0, 9999),
            ];
        }

        $this->getUserService()->addUsers($users);

        foreach ($users as $user) {
            $res = \Queue::put('update_user_info', json_encode($user));
            // if ($res) {
            //     \Cache::getRedis()->incr('cron_count');
            // }
        }
    }

    public function getUserService()
    {
        return service("User:User");
    }
}