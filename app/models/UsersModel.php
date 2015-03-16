<?php

class UsersModel{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getAll(){
		$collection = $this->db->users;
		return $collection->find();
	}
}

?>