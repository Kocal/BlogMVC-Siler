<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Http\Request;
use Siler\Route;
use Siler\Twig;

// Database

$pdo = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
$db = new LessQL\Database($pdo);

// Request

$request = Request::capture();

// Twig

$twig = Twig\init(__DIR__ . '/../views', __DIR__ . '/../cache', true);
$twig->addExtension(new Twig_Extension_Debug());
$twig->addFunction(new Twig_SimpleFunction('str_words', '\Illuminate\Support\Str::words'));

// Routes

Route\get('/', '../controllers/home.get.php');
Route\get('/category/{slug}', '../controllers/categories.get.php');
Route\get('/author/{slug}', '../controllers/authors.get.php');
Route\get('/{slug}', '../controllers/post.get.php');
Route\get('/admin', '');
