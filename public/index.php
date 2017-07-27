<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Http\Request;
use Kilte\Pagination\Pagination;
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
$twig->addFunction(new Twig_SimpleFunction('paginate', function (Pagination $pagination, $url = '/') {
    $output = ['<ul class="pagination">'];

    foreach ($pagination->build() as $page => $item) {
        $link = $url . '?page=' . $page;

        switch ($item) {
            case Pagination::TAG_PREVIOUS:
            case Pagination::TAG_NEXT:
                $output[] = '<li><a href="' . $link . '">' . $page . '</a></li>';
                break;
            case Pagination::TAG_CURRENT:
                $output[] = '<li class="active"><span>' . $page . ' <span class="sr-only">(current)</span></li>';
                break;
            case Pagination::TAG_FIRST:
                $output[] = '<li><a href="' . $link . '">«</a></li>';
                break;
            case Pagination::TAG_LAST:
                $output[] = '<li><a href="' . $link . '">»</a></li>';
                break;
            case Pagination::TAG_LESS:
            case Pagination::TAG_MORE:
                $output[] = '<li><a href="' . $link . '">...</a></li>';
                break;
        }
    }

    $output [] = '</ul>';

    echo implode('', $output);
}));

// Routes

Route\get('/', '../controllers/home.get.php');
Route\get('/category/{slug}', '../controllers/categories.get.php');
Route\get('/author/{slug}', '../controllers/authors.get.php');
Route\get('/{slug}', '../controllers/post.get.php');
Route\get('/admin', '');
