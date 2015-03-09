<?php

class AnotherPageView extends View{
	public function output(){
		$this->setLayoutTag("title","Anotherpage - Contriboard Adminpanel");

		return $this->showAsTable($this->models["TestModel"]->getBoards());
	}

	private function showAsTable($cursor){
		$result = array();
		foreach($cursor as $document){
			$cols = array();
			foreach($document as $columnName => $value){
				$value = (gettype($value) !== "array") ? $value : implode(",", $value);
				array_push($cols, "<td><b>".$columnName."</b>:<br>".$value."</td>");
			}

			array_push($result,"<tr>".implode("", $cols)."</tr>");
		}
		return "<table>".implode("", $result)."</table>";
	}
}

?>