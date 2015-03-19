<?php

abstract class Controller{
	protected $view;
	private $modelsReady = false;
	private $models = array();
	private $viewSettings = array();

	public function __construct(){
		# CSS classes to be set to #wrapper-element
		$this->viewSettings["classes"] = array();

		# Display navigation
		$this->viewSettings["navigation"] = true;
		$this->viewSettings["layout"] = true;
		$this->viewSettings["dialogs"] = true;
	}

	# Adds a model
	protected function addModel($model){
		if($this->modelsReady === false) $this->models[$model] = $model;
		else throw new Exception("You cannot add more models after the construction. Add Models in the constructor of the controller. This way the application will provied database access for them.");
	}

	# Gets a model
	protected function model($model){
		return $this->models[$model];
	}

	# Prints a view with data
	protected function view($view, $data = array()){
		include PATH_VIEW.$view.".php";
	}

	# Gets data from the $_POST, does some very basic filtering, returns null if key not set
	protected function data($key){
		return filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
	}

	# Set a view setting
	protected function setSetting($key, $value){
		$this->viewSettings[$key] = $value;
	}

	# Adds CSS class to wrapper
	protected function addStyleClass($classname){
		array_push($this->viewSettings["classes"], $classname);
	}

	# To respond with a JSON object
	protected function ajaxResponse($error, $message="", $data=array()){
		# Display only this
		exit(json_encode(array(
			"error"=>$error,
			"message"=>$message,
			"data"=>$data
		)));
	}

	# Gets CSS style classes
	public function getViewSettings(){
		return $this->viewSettings;
	}

	# Creates the added models
	public function createModels($db){
		foreach($this->models as &$model){
			include PATH_MODELS.$model.".php";
			$model = new $model($db);
		}
		$this->modelsReady = true;
	}
}

?>