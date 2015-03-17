<?php

class TicketsModel{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function get($filter = array(), $one = false, $asArray = true){
		$collection = $this->db->tickets;
		return ($one === false) ? (($asArray === true) ? iterator_to_array($collection->find($filter)) : $collection->find($filter)) : $collection->findOne($filter);
	}
}

?>