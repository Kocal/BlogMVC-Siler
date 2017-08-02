<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\redirect;
use function Siler\Http\setsession;

$postId = array_get($params, 'id');
$post = Post::find($postId);

if ($post === null) {
    setsession('errorAlert', 'Post does not exist.');
    redirect('/admin');
    die();
}

setsession('requestData', $_POST);
$users = User::select(['id', 'username'])->get();
$categories = Category::select(['id', 'name'])->get();

Response\html(
    Twig\render('admin/posts/edit.twig', compact('post', 'users', 'categories'))
);


die();
