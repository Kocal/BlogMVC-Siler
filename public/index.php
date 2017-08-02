<?php
use Siler\Route;

require_once __DIR__ . '/../bootstrap/bootstrap.php';

define('PATH_CONTROLLERS', __DIR__ . '/../app/controllers');

Route\get('/admin', PATH_CONTROLLERS . '/admin/home.get.php');
Route\get('/admin/posts/create', PATH_CONTROLLERS . '/admin/posts/create.get.php');
Route\post('/admin/posts/create', PATH_CONTROLLERS . '/admin/posts/create.post.php');
Route\get('/admin/posts/edit/{id}', PATH_CONTROLLERS . '/admin/posts/edit.get.php');
Route\post('/admin/posts/edit/{id}', PATH_CONTROLLERS . '/admin/posts/edit.post.php');
Route\get('/admin/posts/delete/{id}', PATH_CONTROLLERS . '/admin/posts/delete.get.php');

Route\get('/login', PATH_CONTROLLERS . '/login.get.php');
Route\post('/login', PATH_CONTROLLERS . '/login.post.php');
Route\get('/logout', PATH_CONTROLLERS . '/logout.get.php');

Route\get('/category/{slug}', PATH_CONTROLLERS . '/categories.get.php');
Route\get('/author/{id}', PATH_CONTROLLERS . '/author.get.php');
Route\post('/comments', PATH_CONTROLLERS . '/comments.post.php');
Route\get('/{slug}', PATH_CONTROLLERS . '/post.get.php');
Route\get('/', PATH_CONTROLLERS . '/home.get.php');
