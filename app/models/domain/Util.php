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

	public function commandline($cmd){
		exec($cmd, $output, $failure);

		if(!$failure){
			return true;
		}else{
			if(count($output) > 0){
				return implode("<br>", $output);
			}else{
				return "Unknown error with command: ".$cmd;
			}
		}
	}
}

?>