<?php
namespace src\services\Group\Impl;

use src\services\BaseService;
use src\services\Group\GroupService;

class GroupServiceImpl extends BaseService implements GroupService
{

    public function getGroup($id)
    {
        return $this->getGroupDao()->getGroup($id);
    }
    
    public function getGroupDao()
    {
        return $this->createDao("Group:Group");
    }

}
?>