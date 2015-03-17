<?php

class Home extends Controller{
	public function __construct(){
		parent::__construct();
		$this->addModel("Session");
	}

	public function index(){
		$session = $this->model("Session");

		# If logged -> show front page
		# Not logged -> show login screen
		if($session->isLogged() === true){
			$this->view("home/index");
		}else{
			$this->addStyleClass("loginBox");
			$this->setSetting("navigation", false);
			$this->view("home/login");
		}
	}

	public function login(){
		$session = $this->model("Session");

		# Try to login
		if($session->isLogged() === false){
			$session->login($this->data("email"), $this->data("password"));
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