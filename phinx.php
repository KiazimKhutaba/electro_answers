<?php


require  __DIR__ . '/vendor/autoload.php';


// load environment vars
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env.prod');
$dotenv->load();



return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'development',
        'production' => [
            'adapter' => env('DB_ADAPTER'),
            'host'    => env('DB_HOST'),
            'name'    => env('DB_NAME'),
            'user'    => env('DB_USER'),
            'pass'    => env('DB_PASS'),
            'port'    => env('DB_PORT'),
            'charset' => env('DB_CHARSET'),
        ],
        'development' => [
            'adapter' => env('DB_ADAPTER'),
            'host'    => env('DB_HOST'),
            'name'    => env('DB_NAME'),
            'user'    => env('DB_USER'),
            'pass'    => env('DB_PASS'),
            'port'    => env('DB_PORT'),
            'charset' => env('DB_CHARSET'),
        ],
        'testing' => [
            'adapter' => env('DB_ADAPTER'),
            'host'    => env('DB_HOST'),
            'name'    => env('DB_NAME'),
            'user'    => env('DB_USER'),
            'pass'    => env('DB_PASS'),
            'port'    => env('DB_PORT'),
            'charset' => env('DB_CHARSET'),
        ]
    ],
    'version_order' => 'creation'
];
