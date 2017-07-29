<?php
use Kilte\Pagination\Pagination;
use Siler\Container;
use Siler\Http\Request;
use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\setsession;
use function Siler\Http\redirect;

$db = Container\get('db');
$id = (int)array_get($params, 'id');

// Prepare pagination
$postsPerPage = 5;

if ($id < 1) {
    redirect('/');

    return;
}

// Fetching user
$user = \Models\User::where('id', $id)->first();

if ($user === null) {
    setsession('error', 'This author does not exists');
    redirect('/');

    return;
}

// Fetching its posts
$posts = \Models\Post::where('user_id', $user->id)->orderBy('created', 'DESC')->paginate($postsPerPage);

// Creating pagination
$pagination = new Pagination($posts->total(), $posts->currentPage(), $postsPerPage);

// Return response
Response\html(
    Twig\render('author.twig', compact('user', 'posts', 'pagination'))
);
