<?php

class AdminsModel{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function get($filter = array(), $one = false){
		$admins = $this->db->admins;
		$adminsList = $admins->find($filter);

		if($one === false){
			$result = array();
			foreach($adminsList as $row){
				$user = $this->getUser($row["userid"]);
				$user["adminid"] = $row["_id"];
				array_push($result, $user);
			}
		}else{
			$row = $adminsList->getNext();
			$result = $this->getUser($row["userid"]);
			$result["adminid"] = $row["_id"];
		}

		return $result;
	}

	private function getUser($id){
		$users = $this->db->users;
		return $users->findOne(array(
			"_id"=>$id
		));
	}
}

?>