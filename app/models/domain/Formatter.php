<?php

class Formatter{
	public function filesize($bytes){
		if($bytes > 1000000) return round($bytes/1000000, 1)." MB";
		elseif($bytes > 1000) return round($bytes/1000, 1)." kB";
		else{
			return $bytes." B";
		}
	}
}

?>