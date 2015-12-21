<?php

namespace src\Web\Cron;

class TestCache
{
    public function handle()
    {
        // $dao = new \Dao();
        // $date = time();
        // $sql = "INSERT INTO `Group`.`groups` (`id`, `title`) VALUES (NULL, {$date});";
        // $dao -> querySql($sql, 'default');
        //注意启动cache配置 否则会出错
        \Cache::set('hour', '每小时执行'.date('Y-m-d H:i:s', time()));
    }

}