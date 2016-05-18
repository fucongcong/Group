<?php

namespace src\Web\Controller\Home;

use src\Web\Controller\BaseController;
use Request;

class IndexController extends BaseController
{
    public function indexAction(Request $request)
    {   
        $uid = \Session::get('uid');
        if (!$uid) return $this -> redirect('/login');

        $scarf = D('Scarf') -> getLastScarf($uid);
        $scarf['user'] = D('User') -> getUserInfo($scarf['uid']);
        $scarf['myInfo'] = D('User') -> getUserInfo($scarf['to_uid']);
        $scarf['content'] = getShort($scarf['content'], 35);

        return $this -> render('Web/Views/Home/index.html.twig', [
            'scarf' => $scarf
            ]);
    }
}