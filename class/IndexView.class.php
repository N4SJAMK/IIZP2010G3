<?php

class IndexView extends View{
	public function output(){
		$this->setLayoutTag("title","Index - Contriboard Adminpanel");

		return replace_tags($this->getHTML("index.php"),
			array(
				"somenumber"=>$this->models["TestModel"]->number;
			)
		);
	}
}

?>