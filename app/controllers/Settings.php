<?php

class Settings extends Controller{
	public function __construct(){
		parent::__construct();
		$this->addModel("Session");
		$this->addModel("UsersModel");
		$this->addModel("AdminsModel");
	}

	public function index(){
		$session = $this->model("Session");
		$admins = $this->model("AdminsModel");

		# If logged -> show front page
		# Not logged -> show login screen
		if($session->isLogged() === true){
			$listAdmins = $admins->get();
			$this->view("settings/index", array(
				"userlist"=>$listAdmins
			));
		}else{
			$this->setSetting("navigation", false);
			$this->view("errors/denied");
		}
	}
}

?>