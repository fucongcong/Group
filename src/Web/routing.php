<?php

return [
    
    'home'=>[
        'pattern' => '/',
        'controller' => 'Web:Home:Index:index',
    ],


    'user_register'=>[
        'pattern' => '/register',
        'controller' => 'Web:User:User:register',
    ],

    'user_do_register'=>[
        'pattern' => '/doRegister',
        'controller' => 'Web:User:User:doRegister',
        'methods' => 'POST',
    ],

    'user_login'=>[
        'pattern' => '/login',
        'controller' => 'Web:User:User:login',
    ],

    'user_login_out'=>[
        'pattern' => '/login_out',
        'controller' => 'Web:User:User:loginOut',
    ],


    'user_do_login'=>[
        'pattern' => '/doLogin',
        'controller' => 'Web:User:User:doLogin',
        'methods' => 'POST',
    ],

    'user'=>[
        'pattern' => '/user',
        'controller' => 'Web:User:User:index',
    ],

    'group_list'=>[
        'pattern' => '/group/list',
        'controller' => 'Web:Group:Index:list',
    ],

    'group_post'=>[
        'pattern' => '/group/post',
        'controller' => 'Web:Group:Index:post',
    ],

    'group_add'=>[
        'pattern' => '/group/add',
        'controller' => 'Web:Group:Index:addGroup',
        'methods' => 'POST',
    ],

    'group_detail'=>[
        'pattern' => '/group/{gid}',
        'controller' => 'Web:Group:Index:detail',
    ],

    'group_post_add'=>[
        'pattern' => '/group/post/add',
        'controller' => 'Web:Group:Post:addPost',
        'methods' => 'POST',
    ],

    












    'user_detail'=>[
        'pattern' => '/user/detail',
        'controller' => 'Web:User:User:detail',
    ],

    'user_changePassword'=>[
        'pattern' => '/user/changePassword',
        'controller' => 'Web:User:User:changePassword',
        'methods' => 'POST',
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

    'user_pets'=>[
        'pattern' => '/user/pets',
        'controller' => 'Web:User:Index:listPets',
        'methods' => 'POST',
    ],

    'user_groups'=>[
        'pattern' => '/user/groups',
        'controller' => 'Web:User:Index:listGroups',
        'methods' => 'POST',
    ],


    


    'group_edit'=>[
        'pattern' => '/group/edit',
        'controller' => 'Web:Group:Index:editGroup',
        'methods' => 'POST',
    ],

    'group_delete'=>[
        'pattern' => '/group/delete',
        'controller' => 'Web:Group:Index:deleteGroup',
        'methods' => 'POST',
    ],

    'group_ding'=>[
        'pattern' => '/group/ding',
        'controller' => 'Web:Group:Index:dingGroup',
        'methods' => 'POST',
    ],

    'group_unding'=>[
        'pattern' => '/group/unding',
        'controller' => 'Web:Group:Index:unDingGroup',
        'methods' => 'POST',
    ],

    // 'group_list'=>[
    //     'pattern' => '/group/list',
    //     'controller' => 'Web:Group:Index:listGroups',
    // ],



    'group_post_delete'=>[
        'pattern' => '/group/post/delete',
        'controller' => 'Web:Group:Post:deletePost',
        'methods' => 'POST',
    ],

     'group_post_list'=>[
        'pattern' => '/group/post/list',
        'controller' => 'Web:Group:Post:listPosts',
    ],

];
