<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    header('Content-type:application/json;charset=utf-8');
    $response->getBody()->write("Hello, $name");

    return $response;
});


//customer routes
require "../src/routes/customers.php";

$app->run();
