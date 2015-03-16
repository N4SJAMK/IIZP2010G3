<?php

class Application{
	# Default values
	private $layout = "../app/views/layout.php";
	protected $controller = "Home";
	protected $action = "index";
	protected $params = array();

	# Vars
	private $db;

	public function __construct($db){
		$this->db = $db;
		$this->loadPage($this->getPath());
	}

	private function loadPage($url){
		# Parse URL
		$urlArr = $this->parseURL($url);

		# Check if URL has all we need, otherwise use defaults
		$controller = (isset($urlArr[0])) ? array_shift($urlArr) : $this->controller;
		$action = (isset($urlArr[0])) ? array_shift($urlArr) : $this->action;
		$params = (isset($urlArr[0])) ? $urlArr : $this->params;

		# Path to the controller
		$controllerPath = PATH_CONTROLLER.$controller.".php";

		# Create controller
		if(file_exists($controllerPath)){
			include_once $controllerPath;
			$this->controller = new $controller();
			$this->controller->createModels($this->db);

			# Call the action
			if(method_exists($this->controller, $action)){
				ob_start();
				call_user_func_array(array($this->controller, $action), $params);
				$output = ob_get_contents();
				ob_end_clean();

				$this->output($output);
			}
		}
	}

	private function getPath(){
		return (isset($_GET["path"])) ? filter_var(rtrim($_GET["path"], "/"), FILTER_SANITIZE_URL) : "";
	}

	private function parseURL($url){
		if(isset($_GET["path"])){
			return explode("/", $url);
		}
	}

	private function prepareOutput($buffer){
		$path = $this->getPath();
		$pregPath = str_replace("/", "\/", preg_quote(PATH_APP)."/".$path);
		$replacements = array(
			"/(href|src|action)\=(\"|\')(\/)([^\>\n\r\"]*)(\"|\')/i"=>"$1=$2".PATH_APP."$3$4$5", # absolute links
			"/(href|src|action)\=(\"|\')([^\/]{1})([^\>\n\r\"]*)(\"|\')/i"=>"$1=$2".PATH_APP."/".$path."$3$4$5", # relative links
			"/(href|src|action)\=(\"|\'){$pregPath}(http\:\/\/|https\:\/\/|www\.)([^\>\n\r\"]*)(\"|\')/i"=>"$1=$2$3$4$5" # external links (fix)
		);
		return preg_replace(array_keys($replacements), $replacements, $buffer);
	}

	private function output($content){
		ob_start();
		include $this->layout;
		$output = ob_get_contents();
		ob_end_clean();

		echo $this->prepareOutput($output);
	}
}

?>