<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$dbConfig = 'prod';
if (config('env.debug')) {
    // Whoops 错误提示
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    $dbConfig = 'test';
}

// Eloquent ORM
$Capsule = new Capsule;
$dbConfig = 'database.' . $dbConfig;
$Capsule->addConnection(config($dbConfig));
$Capsule->setAsGlobal();  //make DB::foo,bar, like `DB:raw()` callable;
$Capsule->bootEloquent();
