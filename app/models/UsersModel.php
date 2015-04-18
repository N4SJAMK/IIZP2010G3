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

	public function count($filter = array()){
		$collection = $this->db->users;
		return $collection->count($filter);
	}

	public function changePassword($id, $passwordRaw){
		$size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, "cbc");
		$salt = bin2hex(mcrypt_create_iv($size, MCRYPT_DEV_RANDOM));
		$passwordHash = crypt($passwordRaw, "$2a$10$".$salt."$");

		$collection = $this->db->users;
		$status = $collection->update(array(
			"_id"=>new MongoId($id)
		),array(
			'$set'=>array("password"=>$passwordHash)
		));
		
		return $status["updatedExisting"];
	}

	public function remove($filter = null){
		if(is_array($filter)){
			$util = new Util();
			$admins = new AdminsModel($this->db);
			$boards = new BoardsModel($this->db);
			$users = $this->db->users;

			# Filter for deleting admin mark and boards
			$adminsFilter = $util->generateItemFilter($this, $filter, "userid");
			$boardsFilter = $util->generateItemFilter($this, $filter, "createdBy");

			# Remove user and possible admin mark
			$admins->remove($adminsFilter);
			$boards->remove($boardsFilter);
			$users->remove($filter);
			return true;
		}else{
			return false;
		}
	}
}

?>