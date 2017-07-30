<?php
use Kilte\Pagination\Pagination;
use Siler\Container;
use Siler\Twig;
use function Siler\Http\session;
use function Siler\Http\flash;

$twig = Twig\init(
    __DIR__ . '/../views',
    __DIR__ . '/../cache',
    true
);

$twig->addExtension(new Twig_Extension_Debug());

$twig->addFilter(new Twig_SimpleFilter('to_markdown', 'Michelf\MarkdownExtra::defaultTransform'));
$twig->addFunction(new Twig_SimpleFunction('md5', 'md5'));
$twig->addFunction(new Twig_SimpleFunction('str_words', '\Illuminate\Support\Str::words'));
$twig->addFunction(new Twig_SimpleFunction('csrf_field', function () {
    echo '<input type="hidden" name="_csrf" value="' . Container\get('csrf-token') . '">';
}));
$twig->addFunction(new Twig_SimpleFunction('old', function ($key) {
    return array_get(session('requestData'), $key);
}));
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


$twig->addGlobal('user', session('user'));
$twig->addGlobal('errorAlert', flash('errorAlert'));
$twig->addGlobal('successAlert', flash('successAlert'));
$twig->addGlobal('validationErrors', flash('validationErrors'));
$twig->addGlobal('categories', \Models\Category::all());
$twig->addGlobal('last_posts', \Models\Post::orderBy('created', 'desc')->limit(2)->get());
