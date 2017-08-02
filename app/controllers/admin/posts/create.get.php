<?php

use App\Models\Category;
use App\Models\User;
use Siler\Http\Response;
use Siler\Twig;

$users = User::select(['id', 'username'])->get();
$categories = Category::select(['id', 'name'])->get();

Response\html(
    Twig\render('admin/posts/create.twig', compact('users', 'categories'))
);

die();
