<?php

class Session{
	private $db;

	public function __construct($db){
		$this->db = $db;

		session_start();

		# Check user session, slight security
		if(!$this->isValid()) $this->regenerate();
	}

	# Checks if the user's session is fine and there's "nothing suspicious"
	private function isValid(){
		if(isset($_SESSION["hash"]) && $_SESSION["hash"] === $this->makeUserHash()){
			return true;
		}else{
			return false;
		}
	}

	# User hash used for checking that user's IP/UA doesn't change between requests
	private function makeUserHash(){
		return sha1($_SERVER["REMOTE_ADDR"].$_SERVER["HTTP_USER_AGENT"]);
	}

	# Generates new session id, keeps user logged if logged
	private function regenerate(){
		$_SESSION = array();
		session_regenerate_id(true);
		$_SESSION["hash"] = $this->makeUserHash();
		$_SESSION["userid"] = null;
	}

	public function login($email, $password){
		# Collections
		$users = $this->db->users;
		$admins = $this->db->admins;

		# Find user
		$user = $users->findOne(array(
			"email"=>$email
		));

		if($user !== null){
			# Is it admin?
			$admin = $admins->findOne(array(
				"userid"=>$user["_id"]
			));

			if($admin !== null && password_verify($password, $user["password"])){
				$this->regenerate();
				$_SESSION["userid"] = $admin["_id"];
				return true;
			}else{
				return false;
			}
		}
	}

	public function isLogged(){
		return (isset($_SESSION["userid"]) && $_SESSION["userid"] !== null) ? true : false;
	}

	public function logout(){
		$this->regenerate();
	}
}

?>