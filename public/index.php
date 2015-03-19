<?php

# Show errors
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

## Use UTF-8 strings
mb_internal_encoding('UTF-8');

## Output as UTF-8 to browsers
mb_http_output('UTF-8');

# Include settings
include "../app/settings.php";

# Autoloader for domain models
spl_autoload_register(function($class){
	include PATH_DMODELS.$class.".php";
});

# Core includes
include_once PATH_CORE."App.php";
include_once PATH_CORE."Controller.php";

# Database connection
$mongo = new MongoClient("mongodb://localhost:27017/".DB_NAME);
$database = $mongo->selectDB(DB_NAME);

# Start application
$app = new Application($database);

?>