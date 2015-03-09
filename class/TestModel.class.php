<?php

class TestModel implements Model{
	private $database;
	private $models;
	public $number = 0;
	
	public function __construct(MySQLDatabase $database, Array &$models=null){
		$this->database = $database;
		$this->models = $models;
	}

	public function generateRandomNumber(){
		$this->number = rand(0,100);
	}
}

?>