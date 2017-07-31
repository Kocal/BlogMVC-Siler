<?php
use Siler\Route;

require_once __DIR__ . '/../bootstrap/bootstrap.php';


Route\get('/admin', '../controllers/admin/home.get.php');
Route\get('/admin/posts/create', '../controllers/admin/posts/create.get.php');
Route\post('/admin/posts/create', '../controllers/admin/posts/create.post.php');
Route\get('/admin/posts/edit/{id}', '../controllers/admin/posts/edit.get.php');
Route\post('/admin/posts/edit/{id}', '../controllers/admin/posts/edit.post.php');
Route\get('/admin/posts/delete/{id}', '../controllers/admin/posts/delete.get.php');

Route\get('/login', '../controllers/login.get.php');
Route\post('/login', '../controllers/login.post.php');
Route\get('/logout', '../controllers/logout.get.php');

Route\get('/category/{slug}', '../controllers/categories.get.php');
Route\get('/author/{id}', '../controllers/author.get.php');
Route\post('/comments', '../controllers/comments.post.php');
Route\get('/{slug}', '../controllers/post.get.php');
Route\get('/', '../controllers/home.get.php');



