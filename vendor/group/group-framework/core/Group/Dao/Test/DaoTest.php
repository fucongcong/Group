<?php

namespace Group\Dao\Test;

use Dao;

class DaoTest extends \Test
{	
	protected $dao;

	public function __initialize()
	{
		$this -> dao = new Dao();
	}

	public function testQuerySql()
	{
		// $sql = "CREATE TABLE IF NOT EXISTS `groups` (
  //         `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  //         `title` varchar(255) NOT NULL,
  //         PRIMARY KEY (`id`)
  //       ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		// INSERT INTO `Group`.`groups` (`id`, `title`) VALUES (1, '1222222');";
		// $this -> dao -> querySql($sql, 'default');

		// $sql = "SELECT * FROM `Group`.`groups` WHERE id=:id LIMIT 0,1";
		// $bind = array('id' => 1);
		// $result = $this -> dao -> getRead()->fetchOne($sql, $bind);

		// $this -> assertEquals('1222222', $result['title']);
	}
}