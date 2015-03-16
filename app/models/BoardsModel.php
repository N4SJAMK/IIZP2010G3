<?php

class BoardsModel{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getAll(){
		$collection = $this->db->boards;
		return $collection->find();
	}
}

?>