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
];
