<?php

header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:GET,POST,OPTIONS');  
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');

// Defines some named constants
define('ROOT_PATH', __DIR__ . '/../');
define('APP_PATH', __DIR__ . '/../app/');

error_reporting(E_ALL & ~E_NOTICE);
echo ($_SERVER['REQUEST_URI']);

// Autoload 自动载入
require_once __DIR__ . '/../vendor/autoload.php';

// 启动器
require_once __DIR__ . '/../app/Bootstrap.php';

// 路由配置
require_once __DIR__ . '/../route/web.php';
