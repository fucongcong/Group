<?php

namespace app\sql;

use Group\Dao\SqlMigration;

class Sql20151124181611 extends SqlMigration
{
    public function run()
    {
        $this -> addSql("INSERT INTO `Group`.`groups` (`id`, `title`) VALUES (NULL, '1222222');");
    }

    public function back()
    {

    }

}
