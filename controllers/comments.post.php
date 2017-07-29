<?php
use Kocal\Validator\Validator;
use Siler\Container;
use Siler\Http;
use function Siler\Http\redirect;

$referer = array_get($_SERVER, 'HTTP_REFERER', '/');

$validator = new Validator([
    '_csrf' => 'required|in:' . Container\get('csrf-token'),
    'post_id' => 'required|integer|min:1',
    'email' => 'required|email',
    'username' => 'required',
    'content' => 'required',
], 'en');

$validator->validate($_POST);

if ($validator->fails()) {
    Http\setsession('requestData', $_POST);
    Http\setsession('validationErrors', $validator->errors());
} else {
    \Models\Comment::create([
        'post_id' => $_POST['post_id'],
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'content' => $_POST['content'],
    ]);
    Http\setsession('requestData', null);
    Http\setsession('successAlert', 'Your comment has been successfully posted.');
}

redirect($referer);
