<?php

require_once 'vendor/autoload.php';

/**
 * A very simple server app that acts as a proxy to the bill endpoint
 * Dubug defaults to true, this prevents custom error handing from been used
 */
$app = new \Slim\Slim([
    'debug' => false
]);

/**
 * Our single route is defined in here, along with adding curl to the container
 * and setting the error handler. As th app grows, these can be seperated out
 * to routes.php etc
 */
require_once 'app.php';

/**
 * Run the app
 */
$app->run();
