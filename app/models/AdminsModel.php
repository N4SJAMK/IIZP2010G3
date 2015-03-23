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
			if($row !== null){
				$result = $this->getUser($row["userid"]);
				$result["adminid"] = $row["_id"];
			}else{
				$result = null;
			}
		}

		return $result;
	}

	public function count($filter = array()){
		$collection = $this->db->admins;
		return $collection->count($filter);
	}

	public function add($userid){
		$collection = $this->db->admins;
		$collection->insert(array(
			"userid"=>new MongoId($userid)
		));
		return true;
	}
	
	public function remove($filter = null){
		if(is_array($filter)){
			$admins = $this->db->admins;
			$admins->remove($filter);
			return true;
		}else{
			return false;
		}
	}

	private function getUser($id){
		$users = $this->db->users;
		return $users->findOne(array(
			"_id"=>$id
		));
	}
}

?>