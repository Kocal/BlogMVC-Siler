<?php

use Kocal\Validator\Validator;
use Siler\Container;
use function Siler\Http\redirect;
use function Siler\Http\Request\header;
use function Siler\Http\setsession;

$referer = header('Referer', '/');

$validator = new Validator([
    '_csrf' => 'required|in:' . Container\get('csrf-token'),
    'post_id' => 'required|integer|min:1',
    'email' => 'required|email',
    'username' => 'required',
    'content' => 'required',
], 'en');

$validator->validate($_POST);

if ($validator->fails()) {
    setsession('requestData', $_POST);
    setsession('validationErrors', $validator->errors());
} else {
    \Models\Comment::create([
        'post_id' => $_POST['post_id'],
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'content' => $_POST['content'],
    ]);
    setsession('requestData', null);
    setsession('successAlert', 'Your comment has been successfully posted.');
}

redirect($referer);

die();
