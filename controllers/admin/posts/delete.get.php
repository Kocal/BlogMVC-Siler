<?php
use Siler\Container;
use Siler\Http;
use function Siler\Http\Request\get;
use function Siler\Http\Request\header;

$referer = header('Referer', '/admin');

if (get('_csrf') === Container\get('csrf-token')) {
    $postId = array_get($params, 'id');
    $post = \Models\Post::find($postId);

    if($post && $post->delete()) {
        Http\setsession('successAlert', 'The post has been successfully deleted.');
    } else {
        Http\setsession('errorAlert', 'Something happens during post deletion.');
    }
}

Http\redirect($referer);
