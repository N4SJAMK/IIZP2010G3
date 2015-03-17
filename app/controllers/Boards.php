<?php

class Boards extends Controller{
	public function __construct(){
		parent::__construct();
		$this->addModel("Session");
		$this->addModel("BoardsModel");
		$this->addModel("UsersModel");
	}

	private function getList($filter = array()){
		# Models to be needed
		$boards = $this->model("BoardsModel");
		$users = $this->model("UsersModel");

		# Get boards matching filter
		$list = $boards->get($filter);

		# Find user for each board
		foreach($list as &$board){
			$board["createdBy"] = $users->get(array(
				"_id"=>$board["createdBy"]
			), true);
		}

		return $list;
	}

	private function userMayEnter(){
		$session = $this->model("Session");
		if($session->isLogged() === true){
			return true;
		}else{
			return false;
		}
	}

	public function index(){
		if($this->userMayEnter() === true){
			$this->view("boards/index", array(
				"boardlist"=>$this->getList()
			));
		}else{
			$this->view("errors/denied");
		}
	}

	public function byuser($id=null){
		if($this->userMayEnter() === true){
			$this->view("boards/index", array(
				"boardlist"=>$this->getList(array(
					"createdBy"=>(new MongoId($id))
				))
			));
		}else{
			$this->view("errors/denied");
		}
	}
}

?>