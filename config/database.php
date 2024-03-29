<?php
return [
    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */
    'fetch' => PDO::FETCH_CLASS,
    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */
    'default' => env('DB_CONNECTION', 'dev'),
    'migrations' => 'migrations',
    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */
    'connections' => [

        'local' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST'),
            'port'      => env('DB_PORT'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'charset'   => env('DB_CHARSET', 'utf8'),
            'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => env('DB_PREFIX'),
            'timezone'  => env('DB_TIMEZONE', '+00:00'),
            'strict'    => env('DB_STRICT_MODE', false),
        ],

        'dev' => [
            'driver'    => 'mysql',
            'host'      => env('DB_DEV_HOST'),
            'port'      => env('DB_DEV_PORT'),
            'database'  => env('DB_DEV_DATABASE'),
            'username'  => env('DB_DEV_USERNAME'),
            'password'  => env('DB_DEV_PASSWORD'),
            'charset'   => env('DB_DEV_CHARSET', 'utf8'),
            'collation' => env('DB_DEV_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => env('DB_DEV_PREFIX'),
            'timezone'  => env('DB_DEV_TIMEZONE', '+00:00'),
            'strict'    => env('DB_DEV_STRICT_MODE', false),
        ],
    ],

];