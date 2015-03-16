<?php

abstract class Controller{
	protected $view;
	private $modelsReady = false;
	private $models = array();

	# Adds a model
	protected function addModel($model){
		if($this->modelsReady === false) $this->models[$model] = $model;
		else throw new Exception("Nasty error: Add Models in the constructor of the controller. This way the application will provied database access for them.");
	}

	# Gets a model
	protected function model($model){
		return $this->models[$model];
	}

	# Prints a view with data
	protected function view($view, $data = array()){
		include PATH_VIEW.$view.".php";
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