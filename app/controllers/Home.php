<?php

class Home extends Controller{
	public function __construct(){
		parent::__construct();
		$this->addModel("Session");
		$this->addModel("UsersModel");
		$this->addModel("AdminsModel");
		$this->addModel("BoardsModel");
		$this->addModel("TicketsModel");
	}

	public function index(){
		$session = $this->model("Session");

		# If logged -> show front page
		# Not logged -> show login screen
		if($session->isLogged() === true){
			$users = $this->model("UsersModel");
			$admins = $this->model("AdminsModel");
			$boards = $this->model("BoardsModel");
			$tickets = $this->model("TicketsModel");

			$this->view("home/index", array(
				"count"=>array(
					"Users"=>$users->count(),
					"Admins"=>$admins->count(),
					"Boards"=>$boards->count(),
					"Tickets"=>$tickets->count()
				)
			));
		}else{
			$this->addStyleClass("loginBox");
			$this->setSetting("navigation", false);
			$this->setSetting("dialogs", false);
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