<?php

class Users extends Controller{
	public function __construct(){
		parent::__construct();
		$this->addModel("Session");
		$this->addModel("UsersModel");
		$this->addModel("BoardsModel");
	}

	public function index(){
		$session = $this->model("Session");
		$users = $this->model("UsersModel");
		$boards = $this->model("BoardsModel");

		if($session->isLogged() === true){
			$list = $users->get(array(), false, true);

			# Find number of boards for user
			foreach($list as &$user){
				$user["boardCount"] = $boards->get(array(
					"createdBy"=>$user["_id"]
				), false, false)->count();
			}

			$this->view("users/index", array(
				"userlist"=>$list
			));
		}else{
			$this->view("errors/denied");
		}
	}
}

?>