<?php
namespace src\Services\Group\Impl;

use src\Services\Group\Rely\GroupBaseService;
use src\Services\Group\GroupService;

class GroupServiceImpl extends GroupBaseService implements GroupService
{

    public function getGroup($id)
    {
        return $this -> getUserService() -> getUser(1);
        return $this->getGroupDao()->getGroup($id);
    }

}
?>