<?php
use Illuminate\Pagination\Paginator;

// Set up a current page resolver
Paginator::currentPageResolver(function ($pageName = 'page') {
    return isset($_REQUEST[$pageName]) ? $_REQUEST[$pageName] : 1;
});

