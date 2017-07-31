<?php

use Siler\Http\Response;
use Siler\Twig;
use function Siler\Http\redirect;
use function Siler\Http\setsession;

$users = \Models\User::select(['id', 'username'])->get();
$categories = \Models\Category::select(['id', 'name'])->get();

Response\html(
    Twig\render('admin/posts/create.twig', compact('users', 'categories'))
);

die();
