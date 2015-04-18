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
			if($admins->remove(array("_id"=>new MongoId($this->data("adminid"))))){
				$this->ajaxResponse(0, "Admin rights removed!");
			}else{
				$this->ajaxResponse(1, "Failed to remove admin rights!");
			}
		}
	}

	public function addadmin(){
		$session = $this->model("Session");

		if($session->isLogged()){
			$users = $this->model("UsersModel");

			# Find out how to get user
			if($this->data("userid") !== null){
				$filter = array("_id"=>new MongoId($this->data("userid")));
			}elseif($this->data("email") !== null){
				$filter = array("email"=>$this->data("email"));
			}else{
				# exit if nothing sent
				$this->ajaxResponse(1, "No data sent? User id or email required.");
			}

			$user = $users->get($filter, true);

			if($user !== null){
				$admins = $this->model("AdminsModel");
				$admin = $admins->get(array(
					"userid"=>$user["_id"]
				),true);

				# Doesn't exist yet -> add
				if($admin === null){
					if($admins->add($user["_id"])){
						$this->ajaxResponse(0, "User promoted to admin!");
					}else{
						$this->ajaxResponse(1, "Failed to promote user to admin!");
					}
				}else{
					$this->ajaxResponse(1, "This user is already an admin!");
				}
			}else{
				$this->ajaxResponse(1, "User doesn't exist!");
			}
		}
	}

	private function getNewBackUpName(){
		return date("Ymd-His")."-".uniqid();
	}
}

?>