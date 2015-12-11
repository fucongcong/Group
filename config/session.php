<?php
return [

    //存储方式file|redis，当开启redis时，必须确保database的cache为redis选项
    'driver' => 'file',

    //当driver为file，可以指定存储路径
    'file' => 'runtime/sessions',

    //当driver为redis时，可配置session前缀，注意与redis配置中的前缀不冲突
    'prex' => 'session',

    //浏览器端session过期时间
    'cookie_lifetime' => '1440',

    //服务器端session过期时间
    'lifetime' => '3600',
];
