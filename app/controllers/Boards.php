<?php

class Boards extends Controller{
	public function __construct(){
		$this->addModel("Session");
		$this->addModel("BoardsModel");
	}

	public function index(){
		$session = $this->model("Session");
		$boards = $this->model("BoardsModel");

		if($session->isLogged() === true){
			$list = $boards->getAll();

			$this->view("boards/index", array(
				"boardlist"=>$list
			));
		}else{
			$this->view("errors/denied");
		}
	}
}

?>