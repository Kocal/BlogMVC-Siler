<?php
use Siler\Container;

session_start();

if (empty($_SESSION['csrf-token'])) {
    $_SESSION['csrf-token'] = sha1(random_bytes(32));
}

Container\set('csrf-token', $_SESSION['csrf-token']);
