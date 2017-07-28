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
$post = $db->post()->where('slug', $slug)->fetch();
$post->user = $post->user()->fetch();
$post->category = $post->category()->fetch();
$post->comments = $post->commentList();

// Return response
Response\html(Twig\render('post.twig', compact('post')));
