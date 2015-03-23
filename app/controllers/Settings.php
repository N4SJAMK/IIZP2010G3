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
			$util = new Util();
			$folder = $this->getNewBackUpName();

			$mkdir = $util->commandline("mkdir ".PATH_DB_BACKUP.$folder." 2>&1");

			if($mkdir === true){
				$mongodump = $util->commandline("mongodump --db ".DB_NAME." --out ".PATH_DB_BACKUP.$folder." 2>&1");
				if($mongodump === true){
					$this->ajaxResponse(0); # success
				}else{
					$this->ajaxResponse(1, $mongodump);
				}
			}else{
				$this->ajaxResponse(1, $mkdir);
			}
		}
	}
	
	public function removeadmin(){
		$session = $this->model("Session");

		if($session->isLogged()){
			$admins = $this->model("AdminsModel");
			$admins->remove(array(
				"_id"=>new MongoId($this->data("adminid"))
			));
			$this->ajaxResponse(0, "Removed");
		}
	}

	private function getNewBackUpName(){
		return date("Ymd-His")."-".uniqid();
	}
}

?>