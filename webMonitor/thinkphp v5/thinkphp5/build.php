<?php
return [
    // 生成应用公共文件
    '__file__' => ['common.php', 'config.php', 'database.php'],

    // 后台模块
    'admin'     => [
        '__file__'   => ['common.php', 'config.php', 'database.php'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view'],
        'controller' => ['Index'],
        'model'      => [],
        'view'       => ['index/index'],
    ],
    
    // 前台模块
    'index'     => [
        '__file__'   => ['common.php', 'config.php', 'database.php'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view'],
        'controller' => ['Index'],
        'model'      => [],
        'view'       => ['index/index'],
    ]
    // 其他更多的模块定义
];