<?php
return
[
    //默认可以不开启读写配置，读写配置可以配置多个
    'pdo' => [

        'default' => [

            "database_driver" => "mysql",

            "database_host" => "127.0.0.1",

            "database_port" => "3306",

            "database_name" => "Group",

            "database_user" => "root",

            "database_password" => "123",

            "database_charset" => "utf8",
        ],

        // 'write' => [

        //     'master1' => [

        //         "database_driver" => "mysql",

        //         "database_host" => "127.0.0.1",

        //         "database_port" => "3306",

        //         "database_name" => "Group1",

        //         "database_user" => "root",

        //         "database_password" => "123",

        //         "database_charset" => "utf8",
        //     ],

        //     'master2' => [

        //         "database_driver" => "mysql",

        //         "database_host" => "127.0.0.1",

        //         "database_port" => "3306",

        //         "database_name" => "Group2",

        //         "database_user" => "root",

        //         "database_password" => "123",

        //         "database_charset" => "utf8",
        //     ],
        // ],

        // 'read' => [

        //     'slave1' => [

        //         "database_driver" => "mysql",

        //         "database_host" => "127.0.0.1",

        //         "database_port" => "3306",

        //         "database_name" => "Group3",

        //         "database_user" => "root",

        //         "database_password" => "123",

        //         "database_charset" => "utf8",
        //     ],

        //     'slave2' =>  [

        //         "database_driver" => "mysql",

        //         "database_host" => "127.0.0.1",

        //         "database_port" => "3306",

        //         "database_name" => "Group4",

        //         "database_user" => "root",

        //         "database_password" => "123",

        //         "database_charset" => "utf8",
        //     ],
        // ],
    ],



    //redis null
    'cache' => 'null',

    'redis' => [

        'default' => [
            'host'     => '127.0.0.1',
            'port'     => 6379,
            'prefix'   => 'group_',
            'auth'     => '',
        ],

    ],

];
