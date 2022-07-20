<?php

return [

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

    'default' => env('DB_CONNECTION', 'mysql'),

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

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql_la' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_la', '104.238.83.157'),
            'port' => env('DB_PORT_la', '3306'),
            'database' => env('DB_DATABASE_la', 'nikkenla_incorporation'),
            'username' => env('DB_USERNAME_la', 'nikkenla_mkrt'),
            'password' => env('DB_PASSWORD_la', 'NNikken2011$$'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]),
        ],

        'mysql_las' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_las', '104.130.46.73'),
            'port' => env('DB_PORT_las', '3306'),
            'database' => env('DB_DATABASE_las', 'nikkenla_site'),
            'username' => env('DB_USERNAME_las', 'nikkenla_mkrt'),
            'password' => env('DB_PASSWORD_las', 'NNikken2011$$'),
            'unix_socket' => env('DB_SOCKET_TV', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            
        ],

        'mysql_la_ci' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_la', '104.238.83.157'),
            'port' => env('DB_PORT_la', '3306'),
            'database' => env('DB_DATABASE_la', 'nikkenla_marketing'),
            'username' => env('DB_USERNAME_la', 'nikkenla_mkrt'),
            'password' => env('DB_PASSWORD_la', 'NNikken2011$$'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]),
        ],

        'mysql_la_users' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_WOOTBIT', '35.207.54.39'),
            'port' => env('DB_PORT_WOOTBIT', '3306'),
            'database' => env('DB_DATABASE_WOOTBIT', 'mitiendanikken'),
            'username' => env('DB_USERNAME_WOOTBIT', 'forge'),
            'password' => env('DB_PASSWORD_WOOTBIT', '8L8xQ1O9l6cVZMBtBBKS'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]),
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        'sqlpreregi' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', '200.66.68.173'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'RETOS_ESPECIALES'),
            'username' => env('DB_USERNAME', 'latamti'),
            'password' => env('DB_PASSWORD', 'N1k3N$17!'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'predis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'predis'),
        ],

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
