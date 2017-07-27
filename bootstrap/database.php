<?php
use function Siler\Container\get;
use function Siler\Container\set;

set('pdo', new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite'));
set('db', new LessQL\Database(get('pdo')));
