<?php
use Siler\Route;

require_once __DIR__ . '/../bootstrap/bootstrap.php';

Route\get('/', '../controllers/home.get.php');
Route\get('/category/{slug}', '../controllers/categories.get.php');
Route\get('/author/{slug}', '../controllers/authors.get.php');
Route\get('/{slug}', '../controllers/post.get.php');
Route\get('/admin', '');
