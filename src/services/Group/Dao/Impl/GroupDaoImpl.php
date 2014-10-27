<?php
require 'src/services/BaseDao.php';
require 'src/services/Group/Dao/GroupDao.php';

class GroupDaoImpl extends BaseDao implements GroupDao
{
    protected $tables="groups";

    public function getGroup($id)
    {  
        $this->getConnection()->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);

        $sql="SELECT * FROM {$this->tables} WHERE id={$id} LIMIT 0,1";
        $rs = $this->getConnection()->query($sql);
        $rs->setFetchMode(PDO::FETCH_ASSOC);

        $group=$rs->fetch() ? : null;

        return $group;
    }
    

}
?>