<?php

require "core/config.php";
require "vendor/autoload.php";

$app = new Silex\Application();

$app->get('/', function () {
    //echo 'Hello';
    return $GLOBALS['template']->render('homepage');
    //return '';
});

/*
$app->match('/login', function () {
    //echo 'Hello';
    return $GLOBALS['template']->render('login');
});
$app->match('/logout', function () {
    //echo 'Hello';
});*/

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->get('/author/{author}', function ($author) use ($app) {
    return $GLOBALS['template']->render('blog',
                                       array("author"=>$author));
});
$app->get('/post/delete/{author}/{pid}', function ($author,$pid) use ($app) {
    
    if($GLOBALS['user']->is_logged_in($author)) {
        $GLOBALS['user']->delete_post($pid);
        redirect("/author/$author");
    }
});

$app->match("/{all}", function ($all) {
    // do stuff
    switch($all) {
        case "login":
        case "register":
        case "post":
            return $GLOBALS['template']->render($all);
            break;
        case "logout":
            $GLOBALS['user']->logout();
            redirect('/');
            break;
        default:
            return $all;            
    }
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

    return $e->getMessage();
});

$app->run();