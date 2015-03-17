<?php

class Util{
	public function createSummary(Array $arr){
		$summary = array();
		foreach($arr as $row){
			foreach($row as $key => $value){
				if(!isset($summary[$key])) $summary[$key] = 0;
				if(is_int($value)) $summary[$key] = $summary[$key] + $value;
				else $summary[$key] = "-";
			}
		}
		return $summary;
	}
}

?>