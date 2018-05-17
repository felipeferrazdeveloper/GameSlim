<?php

$loader = require_once "vendor/autoload.php";

$app = new \Slim\Slim(array(
    "templates.path" => "templates"
));

$app->get("/generos", function ()use ($app){
    $controller = new \controller\GeneroController($app);
    $controller->getAll();
});

$app->post("/generos", function ()use ($app){
    $controller = new \controller\GeneroController($app);
    $controller->cadastrarGenero();
});

$app->delete("/generos/:id", function ($id)use ($app){
    $controller = new \controller\GeneroController($app);
    $controller->apagarGenero($id);
});

$app->run();