<?php

namespace src\Web\Controller;

use Controller;

class BaseController extends Controller
{
    public function __construct()
    {    
         \Session::set('uid',1);
        require(__ROOT__."/core/common.php");
    }

    public function createJsonResponse($data, $info, $status)
    {
        return new \Response(json_encode(['status' => $status, 'info' => $info, 'data' => $data]));
    }

    public function redirect($url, $status = 302)
    {
        header("location: {$url}");
    }
}

