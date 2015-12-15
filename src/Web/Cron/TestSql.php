<?php

namespace src\Web\Cron;

class TestSql
{
    public function handle()
    {
        // $dao = new \Dao();
        // $date = time();
        // $sql = "INSERT INTO `Group`.`groups` (`id`, `title`) VALUES (NULL, {$date});";
        // $dao -> querySql($sql, 'default');
        \Cache::set('test', date('Y-m-d H:i:s', time()));
    }

}