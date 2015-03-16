<?php

# Show errors
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

## Use UTF-8 strings
mb_internal_encoding('UTF-8');

## Output as UTF-8 to browsers
mb_http_output('UTF-8');

# Settings
define("PATH_CORE", "../app/core/");
define("PATH_MODELS", "../app/models/");
define("PATH_DMODELS", "../app/models/domain/");
define("PATH_CONTROLLER", "../app/controllers/");
define("PATH_VIEW", "../app/views/");
define("PATH_APP", "/~vagrant/IIZP2010G3/public");

# Autoloader for domain models
spl_autoload_register(function($class){
	include PATH_DMODELS.$class.".php";
});

# Core includes
include_once PATH_CORE."App.php";
include_once PATH_CORE."Controller.php";

# Database connection
$mongo = new MongoClient("mongodb://localhost:27017/teamboard-dev");
$database = $mongo->selectDB("teamboard-dev");

# Start application
$app = new Application($database);

?>