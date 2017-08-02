<?php

use function Siler\Http\redirect;
use function Siler\Http\session;
use function Siler\Http\setsession;

if (session('user') === null) {
    setsession('errorAlert', 'You should be logged to access this page.');
    redirect('/login');
    die();
}