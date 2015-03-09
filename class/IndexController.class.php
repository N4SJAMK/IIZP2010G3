<?php

class IndexController extends Controller{
	public function __construct($models){
		parent::__construct($models);

		$this->registerAction("POST", "Login");
		$this->registerAction("GET", "hello");
	}

	protected function hello($data){
		$this->models["TestModel"]->generateRandomNumber();
	}
}

?>