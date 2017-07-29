<?php
use Illuminate\Pagination\Paginator;
use Kilte\Pagination\Pagination;
use Models\Post;
use Siler\Http\Response;
use Siler\Twig;

$perPage = 5;
$posts = Post::orderBy('created', 'desc')->paginate($perPage);
$pagination = new Pagination($posts->total(), $posts->currentPage(), $perPage);

Response\html(
    Twig\render('home.twig', compact('posts', 'pagination'))
);
