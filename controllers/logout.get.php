<?php

use Siler\Container;
use Siler\Http;
use function Siler\Http\Request\get;

if (get('_csrf') === Container\get('csrf-token')) {
    Http\setsession('user', null);
    Http\setsession('successAlert', 'You have been disconnected.');
}

Http\redirect('/');

die();
