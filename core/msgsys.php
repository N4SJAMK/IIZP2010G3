<?php

abstract class MessageSystem{
	private $messages = array();

	public function getMessages(){
		return $this->messages;
	}

	protected function addMessage(Message $msg){
		array_push($this->messages, $msg);
	}

	public function allToString(){
		$result = array();
		foreach($this->messages as $message){
			array_push($result, $message->toString());
		}
		return implode(" ", $result);
	}
}

class Message{
	const TYPE_ERR = 1;
	const TYPE_MSG = 2;
	const TYPE_SUC = 3;
	const HTML_WRAP = "<div class=\"{classes}\">{content}</div>";

	private $classes = array();
	private $title = null;
	private $content;

	public function __construct($content, $title=null, $type=self::TYPE_ERR){
		$this->title = $title;
		$this->content = $content;
		array_push($this->classes, "message");

		switch ($type) {
			case self::TYPE_ERR:
				array_push($this->classes, "messageError");
				break;

			case self::TYPE_SUC:
				array_push($this->classes, "messageSuccess");
				break;
			
			default:
				array_push($this->classes, "messageNormal");
				break;
		}
	}

	public function getContent(){
		return $this->content;
	}

	public function setContent($msg){
		$this->content = $msg;
	}

	public function toString(){
		return replace_tags(self::HTML_WRAP,array("content"=>$this->content,"classes"=>implode(" ", $this->classes)));
	}
}

class MessagePDOError extends Message{
	private static $pdoerrors = array();
	public function __construct($pdoErrorCode){
		$msg = (array_key_exists($pdoErrorCode, self::$pdoerrors)) ? self::$pdoerrors[$pdoErrorCode] : array("title"=>"Error ".$pdoErrorCode,"content"=>"Unknown error: ".$pdoErrorCode);
		parent::__construct($msg["content"], $msg["title"], self::TYPE_ERR);
	}

	static public function init(){
		self::$pdoerrors = array(
			"23000"=>array("title"=>"Duplicate entry","content"=>"Such entry already exists.")
		);
	}
}
MessagePDOError::init();

?>