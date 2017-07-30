<?php
use Siler\Container;
use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\redirect;
use function Siler\Http\setsession;

$db = Container\get('db');
$slug = array_get($params, 'slug');

// Fetching post
$post = \Models\Post::where('slug', $slug)->with('comments')->first();

if ($post === null) {
    setsession('errorAlert', 'This post does not exists.');
    redirect('/');

    die();
}

// Return response
Response\html(Twig\render('post.twig', compact('post')));

die();
