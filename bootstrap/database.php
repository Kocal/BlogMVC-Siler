<?php
use Siler\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__ . '/../database/database.sqlite',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
]);

$capsule->setEventDispatcher(Container\get('dispatcher'));
$capsule->setAsGlobal();
$capsule->bootEloquent();
