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
			$this->setSetting("navigation", false);
			$this->view("errors/denied");
		}
	}

	public function changepassword(){
		$session = $this->model("Session");

		if($session->isLogged() === true){
			$users = $this->model("UsersModel");
			$changeStatus = $users->changePassword($this->data("userid"), $this->data("newpassword"));
			if($changeStatus === true){
				$this->ajaxResponse(0, "Password changed!");
			}else{
				$this->ajaxResponse(1, "Failed to change password!");
			}
		}else{
			$this->ajaxResponse(1);
		}
	}

	public function remove(){
		$session = $this->model("Session");

		if($session->isLogged()){
			$users = $this->model("UsersModel");
			if($users->remove(array("_id"=>new MongoId($this->data("userid"))))){
				$this->ajaxResponse(0, "User removed!");
			}else{
				$this->ajaxResponse(1, "Failed to remove user!");
			}
		}
	}
}

?>