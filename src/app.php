<?php

/**
 * The server to get the data from
 */
$app->dataServer = 'http://safe-plains-5453.herokuapp.com/bill.json';

/**
 * Add the error handler
 */
$app->error(function (\Exception $e) use ($app) {
    $app->response->headers->set('Content-Type', 'application/json');

    $app->response->setStatus(502);
    $app->response->setBody(json_encode($e->getMessage()));
});

/**
 * Give the app container curl
 * So we can mock curl
 */
$app->curl = function ($c) use ($app) {
    return new \Curl();
};

/**
 * Define the route that the client will make a GET request to
 */
$app->get('/', function () use ($app) {
    $app->response->headers->set('Content-Type', 'application/json');
    $response = $app->curl->get($app->dataServer);

    if ($response->headers['Status-Code'] != 200) {
        throw new Exception('Error contacting external server.');
    }

    $app->response->setBody($response->body);
});
