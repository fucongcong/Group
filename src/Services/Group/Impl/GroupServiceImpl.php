<?php
namespace src\Services\Group\Impl;

use core\Group\Services\Service;
use src\Services\Group\GroupService;

class GroupServiceImpl extends Service implements GroupService
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