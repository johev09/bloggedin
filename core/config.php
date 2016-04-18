<?php

require_once '/core/functions.php';

config('source','config.ini');
require_once "/classes/template.class.php";
require_once "/classes/database.class.php";
require_once "/classes/user.class.php";

date_default_timezone_set('Asia/Kolkata');

session_start();

//set timezone
$GLOBALS['site.root']=config('site.root');

$TEMPLATE = new Template(); 
global $TEMPLATE;
$GLOBALS['template']=$TEMPLATE;

$DB = new Database();
global $DB;
$GLOBALS['db']=$DB;

$USER = new User($DB);
global $USER;
$GLOBALS['user']=$USER;