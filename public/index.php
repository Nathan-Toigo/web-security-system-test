<?php

require_once __DIR__ . '/core/router.php';
require_once __DIR__ . '/core/controller.php';

$router = new Router();
$router->handleRequest();
