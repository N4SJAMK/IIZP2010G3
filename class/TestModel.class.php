<?php

class TestModel implements Model{
	private $db;
	private $models;
	public $number = 0;
	
	public function __construct(MongoDB $db, Array &$models=null){
		$this->db = $db;
		$this->models = $models;
	}

	public function generateRandomNumber(){
		$this->number = rand(0,100);
	}

	public function getBoards(){
		$collection = $this->db->boards;
		$cursor = $collection->find();
		return $cursor;
	}
}

?>