<?php
return [
    'driver' => 'pdo_mysql',
    'host' => getenv('DATABASE_HOST'),
    'dbname' => getenv('DATABASE_DBNAME'),
    'user' => getenv('DATABASE_USER'),
    'password' => getenv('DATABASE_PASSWORD'),
    'charset' => 'UTF8'
];