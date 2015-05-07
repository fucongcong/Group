<?php
namespace src\Services\Group\Impl;

use src\Services\BaseService;
use src\Services\Group\GroupService;

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