<?php
return
[
    'pdo' => [

        "database_driver" => "mysql",

        "database_host" => "127.0.0.1",

        "database_port" => 3306,

        "database_name" => "Group",

        "database_user" => "root",

        "database_password" => "123",
    ],

    //redis null
    'cache' => null,

    'redis' => [

        'default' => [
            'host'     => '127.0.0.1',
            'port'     => 6379,
        ],

    ],

];
