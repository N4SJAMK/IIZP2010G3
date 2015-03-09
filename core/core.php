<?php

# ROUTER
########

final class Router{
	private $routes;

	public function __construct(){
		$this->getRoutes();
	}

	private function getRoutes(){
		$this->routes = json_decode(file_get_contents("routes.json"));
	}

	private function cleanRouteStr($route){
		$replacements = array(
			"/\s\s+/"=>" ", // several whitespaces => single whitespace
			"/\\\\/"=>"/", // "reverse slash" => slash
			"/\/\/+/"=>"/" // several slashes => single slash
		);

		// Replace -> trim -> explode and remove empty values -> back to string
		return implode("/", array_filter(explode("/", trim(preg_replace(array_keys($replacements), $replacements, $route)))));
	}

	public function find($route){
		$route = $this->cleanRouteStr($route);

		foreach($this->routes as $page){
			if($route === $page->route){
				return $page;
			}
		}
		return null;
	}
}

# FRONT
#######

final class Front{
	private $models = array();
	private $controller;
	private $view;
	private $database;

	public function __construct(Router $router, $route, $database){
		if(($page = $router->find($route)) !== null){
			$this->database = $database;
			
			// MVC class names
			$viewName = $page->view;
			$controllerName = $page->controller;

			// Create objects
			$this->createModels($page->model);
			$this->controller = (!empty($controllerName))?new $controllerName($this->models):null;
			$this->view = new $viewName($this->models);

			if(!empty($this->controller)) $this->controller->triggerAction();
		}else{
			die("Not valid route: ".$route.", query: ".var_dump($_GET));
		}
	}

	private function createModels($modelNames){
		foreach($modelNames as $modelName){
			$this->models[$modelName] = new $modelName($this->database, $this->models);
		}
	}

	public function output(){
		$output = $this->view->output();
		$layout = $this->view->getLayout();
		if(strpos($layout, "{content}") === false) $layout = "{content}";
		return replace_tags($layout,
			array(
				"content"=>$output
			)
		);
	}
}

# MODEL
#######

interface Model{
	public function __construct(MySQLDatabase $database, Array &$models=null);
}

# VIEW
######

abstract class View{
	const PATH_HTML = "view/";
	const FILENAME_LAYOUT = "layout.php";
	private $layoutTags;
	protected $models;

	public function __construct(Array &$models){
		$this->layoutTags = array();
		$this->models = $models;
	}

	protected function getHTML($filename){
		$path = self::PATH_HTML.$filename;
		return (file_exists($path)) ? file_get_contents($path) : "";
	}

	protected function setLayoutTag($tag, $value){
		$this->layoutTags[$tag] = $value;
	}

	public function getLayout(){
		return replace_tags($this->getHTML(self::FILENAME_LAYOUT),$this->layoutTags);
	}

	abstract public function output();
}

# CONTROLLER
############

abstract class Controller{
	const M_GET = "GET";
	const M_POST = "POST";

	protected $models;
	private $actions;

	public function __construct(Array &$models){
		$this->models = $models;
		$this->actions = array(
			self::M_GET=>array(),
			self::M_POST=>array()
		);
	}

	private function isValidAction($methodType,$methodName){
		return (in_array($methodName, $this->actions[$methodType]) && method_exists($this, $methodName)) ? true : false;
	}

	private function getData($type){
		return ($type === self::M_GET) ? $_GET : $_POST;
	}

	protected function registerAction($methodType,$methodName){
		if(!in_array($methodName, $this->actions)){
			array_push($this->actions[$methodType], $methodName);
		}
	}

	public function triggerAction(){
		$methodNames = array(
			self::M_POST=>p("action"),
			self::M_GET=>g("action")
		);
		
		foreach($methodNames as $methodType => $methodName){
			if($this->isValidAction($methodType,$methodName)){
				$this->$methodName($this->getData($methodType));
			}
		}
	}
}

# FUNCTIONS, RELOCATE PLS
###########

function g($key){
	return (isset($_GET[$key])) ? $_GET[$key] : null;
}

function p($key){
	return (isset($_POST[$key])) ? $_POST[$key] : null;
}

function replace_tags($output, $pairs=array()){
	foreach($pairs as $tag => $value){
		$output = str_replace("{".$tag."}", $value, $output);
	}
	return $output;
}


?>