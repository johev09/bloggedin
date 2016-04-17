<?php

require_once '/core/functions.php';

config('source','config.ini');
require_once "/classes/template.class.php";
require_once "/classes/database.class.php";
require_once "/classes/user.class.php";

date_default_timezone_set('Asia/Kolkata');

session_start();

//set timezone

$TEMPLATE = new template(); 
global $TEMPLATE;

//$DB = new database();
global $DB;

$USER = new user($DB);
global $USER;