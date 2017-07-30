<?php
require_once __DIR__ . '/guard.php';

use Kilte\Pagination\Pagination;
use Siler\Http\Response;
use Siler\Twig;

$posts = \Models\Post::orderBy('created', 'DESC')->paginate(20);
$pagination = new Pagination($posts->total(), $posts->currentPage(), $posts->perPage());

Response\html(
    Twig\render('admin/home.twig', compact('posts', 'pagination'))
);

die();