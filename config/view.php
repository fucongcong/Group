<?php
return [

    //模板主路径
    'path' => 'src',

    //false|true
    'cache' => false,

    //缓存的目录
    'cache_dir' => 'runtime/cache/views',

    //模板扩展，继承自Twig_Extension，详见twig文档
    'extensions' =>[
        //like
        //'src/Demo/DemoExtension',
    ],

];
