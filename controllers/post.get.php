<?php
use Siler\Container;
use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\redirect;

$db = Container\get('db');
$slug = array_get($params, 'slug');

if ($slug === null) {
    redirect('/');
    return;
}

// Fetching post
$post = \Models\Post::where('slug', $slug)->with('comments')->first();

// Return response
Response\html(Twig\render('post.twig', compact('post')));
