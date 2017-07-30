<?php

use Kocal\Validator\Validator;
use Siler\Container;
use function Siler\Http\redirect;
use function Siler\Http\setsession;

$referer = header('Referer', '/');

$validator = new Validator([
    '_csrf' => 'required|in:' . Container\get('csrf-token'),
    'username' => 'required',
    'password' => 'required',
], 'en');

$validator->validate($_POST);

if ($validator->fails()) {
    setsession('requestData', $_POST);
    setsession('validationErrors', $validator->errors());
} else {
    $user = \Models\User::where('username', $_POST['username'])->first();

    if (!password_verify($_POST['password'], $user->password)) {
        setsession('requestData', $_POST);
        setsession('errorAlert', 'Unknown credentials.');
    } else {
        setsession('user', $user);
        setsession('requestData', null);
        setsession('successAlert', 'You are now successfully logged.');
        redirect('/admin');
        die();
    }
}

redirect($referer);
die();
