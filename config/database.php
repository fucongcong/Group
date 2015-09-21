<?php
return
[
    //pdo DB
    'driver' => 'DB',

    'connect' => [

        "database_driver" => "mysql",

        "database_host" => "192.168.1.4",

        "database_port" => 192,

        "database_name" => "banciyuan",

        "database_user" => "banciyuan",

        "database_password" => "banciyuan",

        "database_encoding" => "utf8mb4"
    ],

    'redis' => [

        'default' => [
            'host'     => '127.0.0.1',
            'port'     => 6379,
        ],

    ],

];
