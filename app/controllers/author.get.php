<?php

use App\Models\Post;
use App\Models\User;
use Kilte\Pagination\Pagination;
use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\redirect;
use function Siler\Http\setsession;

$id = (int)array_get($params, 'id');

// Fetching user
$user = User::where('id', $id)->first();

if ($user === null) {
    setsession('errorAlert', 'This author does not exists.');
    redirect('/');

    return;
}

// Fetching its posts
$posts = Post::where('user_id', $user->id)->orderBy('created', 'DESC')->paginate(5);

// Creating pagination
$pagination = new Pagination($posts->total(), $posts->currentPage(), $posts->perPage());

// Return response
Response\html(
    Twig\render('author.twig', compact('user', 'posts', 'pagination'))
);

die();
