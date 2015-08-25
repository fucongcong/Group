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

    public function waveCount()
    {
        $sql="UPDATE {$this->tables} SET count=count+1 LIMIT 1";

        $rs = $this->getConnection()->prepare($sql);

        $rs->execute();

        $rs->setFetchMode(PDO::FETCH_ASSOC);

        $count=$rs->fetch() ? : null;

        return $count;
    }

    public function waveDownCount()
    {
        $sql="UPDATE {$this->tables} SET count=count-1 LIMIT 1";

        $rs = $this->getConnection()->prepare($sql);

        $rs->execute();

        $rs->setFetchMode(PDO::FETCH_ASSOC);

        $count=$rs->fetch() ? : null;

        return $count;
    }

}
?>