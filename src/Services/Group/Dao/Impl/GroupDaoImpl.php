<?php

namespace src\Services\Group\Dao\Impl;

use core\Group\Dao\Dao;
use src\Services\Group\Dao\GroupDao;
use PDO;
class GroupDaoImpl extends Dao implements GroupDao
{
    protected $tables="groups";

    public function getGroup($id)
    {
        $sql="SELECT * FROM {$this->tables} WHERE id=:id LIMIT 0,1";

        $rs = $this->getConnection()->prepare($sql);

        $rs->bindParam(':id',$id);
        $rs->execute();

        $rs->setFetchMode(PDO::FETCH_ASSOC);

        $group=$rs->fetch() ? : null;

        return $group;
    }

}
