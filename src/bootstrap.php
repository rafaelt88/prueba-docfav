<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

// Read and load environment variables.
array_filter(
    parse_ini_file(__DIR__ . '/../.env'), function ($value, $name) {
        putenv("$name=$value");
    }, ARRAY_FILTER_USE_BOTH
);

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [
    __DIR__ . '/Entities',
    __DIR__ . '/Attributes'
    ], isDevMode: true
);

// configuring the database connection
$connection = DriverManager::getConnection(require_once __DIR__ . '/../config/database.php', $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);