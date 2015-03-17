<?php

class Formatter{
	public function filesize($bytes){
		if($bytes > 1000000) return ($bytes/1000000)." MB";
		elseif($bytes > 1000) return ($bytes/1000)." kB";
		else{
			return $bytes." B";
		}
	}
}

?>