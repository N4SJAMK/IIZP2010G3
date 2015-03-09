<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

## Use UTF-8 strings
mb_internal_encoding('UTF-8');

## Output as UTF-8 to browsers
mb_http_output('UTF-8');

## Core files
include_once "core/core.php";
include_once "core/msgsys.php";

## Autoloader for classes
function __autoload($className){
	include "class/". $className .".class.php";
}

# Database connection
$mongo = new MongoClient();
$database = $mongo->jokutesti;

# Router, handles paths
$router = new Router();

# Front controller creates models, view, controller and passes db connection
$front = new Front($router, g("_route"), $database);

# Output the page
echo $front->output();

?>