<?php

namespace app\sql;

use Group\Dao\SqlMigration;

class Sql20151124180913 extends SqlMigration
{
    public function run()
    {
       $this->addSql("CREATE TABLE IF NOT EXISTS `groups` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `title` varchar(255) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

        $this -> addSql("INSERT INTO `Group`.`groups` (`id`, `title`) VALUES (NULL, 'sadasd');");
    }

    public function back()
    {

    }

}
