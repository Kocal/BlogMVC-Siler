<?php

use Siler\Route;

require_once __DIR__.'/vendor/autoload.php';

Route\get('/', function () {
    echo 'Hello World';
});
