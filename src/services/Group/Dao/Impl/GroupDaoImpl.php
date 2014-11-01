<?php

namespace src\services\Group\Dao\Impl;

use src\services\BaseDao;
use src\services\Group\Dao\GroupDao;
use PDO;
class GroupDaoImpl extends BaseDao implements GroupDao
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
?>