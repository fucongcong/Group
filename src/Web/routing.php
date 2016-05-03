<?php

return [

    'user_register'=>[
        'pattern' => '/register',
        'controller' => 'Web:User:User:register',
        'methods' => 'POST',
    ],

    'user_login'=>[
        'pattern' => '/login',
        'controller' => 'Web:User:User:login',
        'methods' => 'POST',
    ],

    'user_detail'=>[
        'pattern' => '/user/detail',
        'controller' => 'Web:User:User:detail',
    ],

    'user_edit'=>[
        'pattern' => '/user/edit',
        'controller' => 'Web:User:User:edit',
        'methods' => 'POST',
    ],

    'user_setAvatar'=>[
        'pattern' => '/user/setAvatar',
        'controller' => 'Web:User:User:setAvatar',
        'methods' => 'POST',
    ],
    
];
