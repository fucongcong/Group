<?php

namespace src\Web\Aop; 

use Log;
use Exception;

class UserServiceAop {

    public function before($id)
    {
        Log::info('before userService', []);
    }

    public function after($id, $res)
    {
        Log::info('after userService', [$res]);
    }

    public function throw($id,Exception $e)
    {
        Log::info('throw userService', [$e->getMessage()]);
    }
}