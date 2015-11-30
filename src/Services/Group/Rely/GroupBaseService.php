<?php
namespace src\Services\Group\Rely;

use Service;

abstract class GroupBaseService extends Service
{
    public function getGroupDao()
    {
        return $this->createDao("Group:Group");
    }

    public function getUserService()
    {
        return $this -> register("User:User");
    }
}