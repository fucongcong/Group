<?php

namespace app\sql;

use core\Group\Dao\SqlMigration;

class Sql20151126110051 extends SqlMigration
{
    public function run()
    {
        $this -> addSql("INSERT INTO `groups` (`id`, `title`) VALUES (NULL, 'testtestststststs');");
    }

    public function back()
    {

    }

}
