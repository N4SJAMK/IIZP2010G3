<?php

class Users extends Controller{
	public function __construct(){
		$this->addModel("Session");
		$this->addModel("UsersModel");
	}

	public function index(){
		$session = $this->model("Session");
		$users = $this->model("UsersModel");

		if($session->isLogged() === true){
			$list = $users->getAll();

			$this->view("users/index", array(
				"userlist"=>$list
			));
		}else{
			$this->view("errors/denied");
		}
	}
}

?>