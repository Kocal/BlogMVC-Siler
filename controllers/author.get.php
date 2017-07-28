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
$page = (int)Request\get('page', 1);

if ($id < 1 || $page < 1) {
    redirect('/');

    return;
}

// Fetch author posts
$user = $db->user()->where('id', $id)->fetch();

if ($user === null) {
    setsession('error', 'This author does not exists');
    redirect('/');

    return;
}

$posts = $db->post()
            ->where('user_id', $user->id)
            ->orderBy('created', 'DESC')
            ->paged($postsPerPage, $page);

foreach ($posts as $post) {
    $post->category = $post->category()->fetch();
}
// Creating pagination
$pagination = new Pagination($db->post()->count('id'), $page, $postsPerPage);

// Return response
Response\html(
    Twig\render('author.twig', compact('user', 'posts', 'pagination'))
);
