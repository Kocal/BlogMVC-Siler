<?php
use Kilte\Pagination\Pagination;
use Siler\Container;
use Siler\Http\Request;
use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\redirect;

$db = Container\get('db');

// Prepare pagination
$postsPerPage = 5;
$page = (int)Request\get('page', 1);

if ($page < 1) {
    redirect('/');
    return;
}

// Fetching posts
$posts = $db->post()
            ->orderBy('created', 'DESC')
            ->paged($postsPerPage, $page);

foreach ($posts as $post) {
    $post->user = $post->user()->fetch();
    $post->category = $post->category()->fetch();
}

// Creating pagination
$pagination = new Pagination($db->post()->count('id'), $page, $postsPerPage);

// Return response
Response\html(
    Twig\render('home.twig', compact('posts', 'pagination'))
);
