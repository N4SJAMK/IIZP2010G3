<?php

class UsersModel{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function get($filter = array(), $one = false, $asArray = true){
		$collection = $this->db->users;
		return ($one === false) ? (($asArray === true) ? iterator_to_array($collection->find($filter)) : $collection->find($filter)) : $collection->findOne($filter);
	}

	public function changePassword($id, $passwordRaw){
		$salt = bin2hex(mcrypt_create_iv(64, MCRYPT_DEV_RANDOM));
		$passwordHash = crypt($passwordRaw, "$2a$10$".$salt."$");

		$collection = $this->db->users;
		$status = $collection->update(array(
			"_id"=>new MongoId($id)
		),array(
			'$set'=>array("password"=>$passwordHash)
		));
		
		return $status["updatedExisting"];
	}
}

?>