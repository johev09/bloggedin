<?php

require "core/config.php";
require "vendor/autoload.php";

$app = new Silex\Application();


$app->get('/', function () {
    //echo 'Hello';
    return $GLOBALS['template']->render('homepage');
});

$app->get('/login', function () {
    //echo 'Hello';
    return $GLOBALS['template']->render('login');
});

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->get("/{all}", function ($all) {
    // do stuff
    return $all;
    exit;
})->assert("all", ".*");

$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message);
});


$app->run();