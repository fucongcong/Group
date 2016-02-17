<?php

return array(

    'homepage'=>[
    	'pattern' => '/',
    	'controller' => 'Web:Home:Default:index',
    ],

    'group'=>[
    	'pattern' => '/group/{id}',
    	'controller' => 'Web:Group:Group:test',
    	'methods' => 'GET',
    ],

    'create_group'=>[
        'pattern' => '/group/{id}',
        'controller' => 'Web:Group:Group:add',
        'methods' => 'POST',
    ],

    'user_group'=>[
    	'pattern' => '/user/{id}/group/{groupId}',
    	'controller' => 'Web:Group:Group:test',
    	'methods' => 'GET',
    ],


    );
?>