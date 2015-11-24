<?php
namespace src\Services\User\Impl;

use src\Services\User\Rely\UserBaseService;
use src\Services\User\UserService;

class UserServiceImpl extends UserBaseService implements UserService
{

    public function getUser($id)
    {
        return 2;
    }

}
