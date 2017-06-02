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

        $this -> addSql("INSERT INTO `groups` (`id`, `title`) VALUES (NULL, 'demo1');");

        $this->addSql("CREATE TABLE IF NOT EXISTS `user` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `nickname` varchar(255) NOT NULL DEFAULT '',
          `email` varchar(255) NOT NULL DEFAULT '',
          `password` varchar(255) NOT NULL DEFAULT '',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");

        $this->addSql("
        INSERT INTO `user` VALUES
        (1, '张三', 'zhangsan@github.com', '123456'),
        (2, '李四', 'lisi@github.com', '123456'),
        (3, '李四1', 'lisi@github.com1', '1234561'),
        (4, '李四2', 'lisi@github.com2', '123456'),
        (5, '李四3', 'lisi@github.com3', '1234561'),
        (6, '李四4', 'lisi@github.com4', '123456'),
        (7, '李四5', 'lisi@github.com5', '1234561'),
        (8, '李四6', 'lisi@github.com6', '123456'),
        (9, 'coco', 'coco@qq.com', '123456'),
        (10, 'coco1', 'coco1@qq.com', '123456'),
        (11, 'coco12', 'coco1@qq.com', '123456');
        ");
    }

    public function back()
    {

    }

}
