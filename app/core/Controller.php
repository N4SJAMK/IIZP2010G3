<?php

abstract class Controller{
	protected $view;
	private $modelsReady = false;
	private $models = array();

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