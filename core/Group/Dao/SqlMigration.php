<?php
namespace core\Group\Dao;

abstract class SqlMigration
{
    protected $sqlArr = [];

    abstract function run();

    abstract function back();

    public function addSql($sql)
    {
        $this -> setSqlArr($sql);
    }

    public function getSqlArr()
    {
        return $this -> sqlArr;
    }

    public function setSqlArr($sql)
    {
        $sqlArr = $this -> sqlArr;
        $sqlArr[] = $sql;
        $this -> sqlArr = $sqlArr;
    }
}