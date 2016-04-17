<?php

include "core/config.php";

require 'vendor/autoload.php';

$app = new Silex\Application();


$app->get('/', function () {
    //echo 'Hello';
    global $TEMPLATE;
    echo $TEMPLATE->render('homepage');
    return '';
});

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->run();