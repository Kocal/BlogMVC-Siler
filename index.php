<?php

use Siler\Route;
use RedBeanPHP\R;

require_once __DIR__.'/vendor/autoload.php';

R::setup('sqlite:' . __DIR__ . '/database/database.sqlite');

Route\get('/', function () {
    echo 'Hello World';
});
