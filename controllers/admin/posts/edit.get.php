<?php

use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\redirect;
use function Siler\Http\setsession;

$postId = array_get($params, 'id');
$post = \Models\Post::find($postId);

if ($post === null) {
    setsession('errorAlert', 'Post does not exist.');
    redirect('/admin');
    die();
}

setsession('requestData', $_POST);
$users = \Models\User::select(['id', 'username'])->get();
$categories = \Models\Category::select(['id', 'name'])->get();

Response\html(
    Twig\render('admin/posts/edit.twig', compact('post', 'users', 'categories'))
);


die();