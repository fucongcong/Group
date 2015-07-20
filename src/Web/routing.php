<?php

return array(

    'homepage'=>[
    	'pattern' => '/',
    	'_controller' => 'Web:Home:Default:index',
    	'methods' => 'GET',
    ],

    'group'=>[
    	'pattern' => '/group/{id}',
    	'_controller' => 'Web:Group:Group:index',
    	'methods' => 'GET',
    ],

    'create_group'=>[
        'pattern' => '/group/{id}',
        '_controller' => 'Web:Group:Group:index',
        'methods' => 'POST',
    ],

    'user_group'=>[
    	'pattern' => '/user/{id}/group/{groupId}',
    	'_controller' => 'Web:Group:Group:test',
    	'methods' => 'GET',
    ],


    );
?>