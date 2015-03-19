<?php

class Boards extends Controller{
	public function __construct(){
		parent::__construct();
		$this->addModel("Session");
		$this->addModel("BoardsModel");
		$this->addModel("UsersModel");
		$this->addModel("TicketsModel");
	}

	private function getList($filter = array(), $withSummary = true){
		$util = new Util();

		# Models to be needed
		$boards = $this->model("BoardsModel");
		$users = $this->model("UsersModel");
		$tickets = $this->model("TicketsModel");

		# Get boards matching filter
		$list = $boards->get($filter);

		# Find user for each board
		foreach($list as &$board){
			# Get user
			$board["createdBy"] = $users->get(array(
				"_id"=>$board["createdBy"]
			), true);

			# Get number of tickets
			$boardTickets = $tickets->get(array(
				"board"=>$board["_id"]
			), false, false);

			# Add new fields
			$board["ticketCount"] = $boardTickets->count();
			$board["boardSize"] = $this->calculateBoardSize($boardTickets);
		}

		#array_push($list, $util->createSummary($list));

		return $list;
	}

	private function calculateBoardSize($boardTickets){
		$result = 0;
		foreach($boardTickets as $ticket){
			$result = $result + mb_strlen($ticket["content"], "8bit");
		}
		return $result;
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
				"boardlist"=>$this->getList(),
				"user"=>"all users"
			));
		}else{
			$this->setSetting("navigation", false);
			$this->view("errors/denied");
		}
	}

	public function byuser($id=null){
		if($this->userMayEnter() === true){
			$this->view("boards/index", array(
				"boardlist"=>$this->getList(array(
					"createdBy"=>(new MongoId($id))
				)),
				"user"=>"single user"
			));
		}else{
			$this->setSetting("navigation", false);
			$this->view("errors/denied");
		}
	}
}

?>