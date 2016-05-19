<?php

namespace src\Web\Controller\Goods;

use src\Web\Controller\BaseController;
use Request;

class IndexController extends BaseController
{
    public function listGoodsAction(Request $request)
    {
        $goods = M('Goods') -> select();
        if ($goods) return $this -> createJsonResponse($goods, '', 1);
        return $this -> createJsonResponse(null, '', 0);
    }

    public function detailAction(Request $request)
    {
        $gid = $request -> query -> get('gid');
    }
}