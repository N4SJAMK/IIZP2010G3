<?php

class AnotherPageView extends View{
	public function output(){
		$this->setLayoutTag("title","Anotherpage - Contriboard Adminpanel");

		return $this->showAsTable($this->models["TestModel"]->getUkot());
	}

	private function showAsTable($cursor){
		$result = array();
		foreach($cursor as $document){
			array_push($result,
				"<tr>".
				"<td>".$document["nimi"]."</td>".
				"<td>".$document["ika"]."</td>".
				"</tr>"
			);
		}
		return implode("", $result);
	}
}

?>