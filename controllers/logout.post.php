<?php

use Siler\Container;
use Siler\Http;

if (array_get($_POST, '_csrf') === Container\get('csrf-token')) {
    Http\setsession('user', null);
    Http\setsession('successAlert', 'You have been disconnected.');
}

Http\redirect('/');

die();
