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
				"userlist"=>$listAdmins,
				"backuppath"=>PATH_DB_BACKUP
			));
		}else{
			$this->setSetting("navigation", false);
			$this->view("errors/denied");
		}
	}

	public function backup(){
		$session = $this->model("Session");

		if($session->isLogged()){
			$folder = $this->getNewBackUpName();
			echo exec("mkdir ".PATH_DB_BACKUP.$folder);
			exec("mongodump --db ".DB_NAME." --out ".PATH_DB_BACKUP.$folder." > /dev/null &");
		}
	}

	private function getNewBackUpName(){
		return date("Ymd-His")."-".uniqid();
	}
}

?>