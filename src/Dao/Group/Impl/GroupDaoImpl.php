<?php

namespace src\Dao\Group\Impl;

use Dao;
use src\Dao\Group\GroupDao;

class GroupDaoImpl extends Dao implements GroupDao
{
    //定以数据表
    protected $tables="groups";

    //具体方法
    public function getGroup($id)
    {
        $sql="SELECT * FROM {$this->tables} WHERE id=:id LIMIT 0,1";
        //动态参数绑定
        $bind = array('id' => $id);
        //读取默认配置
        //$group = $this->getDefault()->fetchOne($sql, $bind);

        //读取写服务器配置，如果没有指定具体参数，随机写入分配的服务器
        //$group = $this->getWrite('master1')->fetchOne($sql, $bind);
        //$group = $this->getWrite('master2')->fetchOne($sql, $bind);

        //读取读服务器配置，如果没有指定具体参数，随机读取分配的服务器
        $group = $this->getDefault()->fetchOne($sql, $bind);
        return $group ? $group : null;
    }
}
