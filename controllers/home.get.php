<?php
use Kilte\Pagination\Pagination;
use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\redirect;

global $db;
global $request;

// Prepare pagination
$postsPerPage = 5;
$page = $request->get('page', 1);

if ($page < 1) {
    redirect('/');
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

Response\html(Twig\render('home.twig', compact('posts', 'pagination')));
