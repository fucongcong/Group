<?php

return array(

    '/'=>[
    	'pattern' => 'homepage',
    	'_controller' => 'web:Default:index',
    	'methods' => 'GET',
    ],

    '/group/{id}'=>[
    	'pattern' => 'group',
    	'_controller' => 'web:Group:index',
    	'methods' => 'GET',
    ],

    '/user/{id}/group/{groupId}'=>[
    	'pattern' => 'user_group',
    	'_controller' => 'web:Group:test',
    	'methods' => 'Get',
    ],


    );
?>