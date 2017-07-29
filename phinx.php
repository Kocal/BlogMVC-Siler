<?php
require __DIR__ . '/bootstrap/container.php';
require __DIR__ . '/bootstrap/database.php';

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'development',
        'development' => [
            'adapter' => 'sqlite',
            'name' =>'./database/database.sqlite',
        ],
        'testing' => [
            'adapter' => 'sqlite',
            'memory' => true,
        ],
    ],

    'version_order' => 'creation',
];
