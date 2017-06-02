<?php

namespace src\Dao\User\Impl;

use Dao;
use src\Dao\User\UserDao;

class UserDaoImpl extends Dao implements UserDao
{
    protected $tables = "user";

    public function getUser($id)
    {
    	$sql="SELECT * FROM {$this->tables} WHERE id=:id LIMIT 0,1";
        //动态参数绑定
        $bind = array('id' => $id);
        //读取读服务器配置，如果没有指定具体参数，随机读取分配的服务器
        $user = $this->getDefault()->fetchOne($sql, $bind);
        return $user ? $user : null;
    }
}
