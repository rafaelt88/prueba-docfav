<?php
require_once __DIR__ . '/../src/bootstrap.php';

// Inicializar la aplicación.
$app = new \App\Core\Application($entityManager);

// Ejecutar la aplicación.
$app->run();