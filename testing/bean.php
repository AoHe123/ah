<?php

return [
    'config'              => [
        'path' => __DIR__ . '/../config',
    ],
    'mgsql'          => [
        'class'    => MongoDb::class,
        'host'     => '127.0.0.1',
        'port'     => 5432,
        'database' => 'dbname',
        'schema'   => ['topology', 'public'],
        'charset'  => 'utf8',
        'user'     => 'user',
        'password' => 'pass'
    ],
    'mgsql.pool'      => [
        'class'     => \Swoft\Mongo\Pool::class,
        'pgsqlDb'   => bean('mgsql'),
        'minActive' => 2,
        'mixActive' => 20,
        'maxWait'   => 0,
        'maxWaitTime' => 0,
        'maxIdleTime' => 60,
    ],
];
