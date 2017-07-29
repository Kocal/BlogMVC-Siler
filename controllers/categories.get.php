<?php
use Kilte\Pagination\Pagination;
use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\redirect;
use function Siler\Http\setsession;

$slug = array_get($params, 'slug');

// Fetching category
$category = \Models\Category::where('slug', $slug)->first();

if ($category === null) {
    setsession('error', 'This category does not exists.');
    redirect('/');

    return;
}

// Fetching its posts
$posts = $category->posts()->paginate(5);

// Creating pagination
$pagination = new Pagination($posts->total(), $posts->currentPage(), $posts->perPage());

// Return response
Response\html(
    Twig\render('category.twig', compact('category', 'posts', 'pagination'))
);
