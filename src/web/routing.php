<?php

return array(
/*    '/group'=>'web:Group:index',
    '/'=>'web:Default:index',
    */

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
    	'pattern' => 'group',
    	'_controller' => 'web:Group:test',
    	'methods' => 'GET',
    ],


    );
?>