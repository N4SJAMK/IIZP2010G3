<?php

class Home extends Controller{
	public function __construct(){
		$this->addModel("Session");
	}

	public function index(){
		$session = $this->model("Session");

		# If logged -> show front page
		# Not logged -> show login screen
		if($session->isLogged() === false){
			$this->view("home/login");
		}else{
			$this->view("home/index");
		}
	}

	public function login(){
		$session = $this->model("Session");

		# Try to login
		if($session->isLogged() === false){
			$data = $_POST;
			$status = $session->login($data["email"], $data["password"]);
		}
		
		# Call the index method (frontpage)
		$this->index();
	}

	public function logout(){
		$session = $this->model("Session");

		# Log out
		$session->logout();

		# Call the index method (frontpage)
		$this->index();
	}
}

?>