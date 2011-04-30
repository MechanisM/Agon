<?php
	/*
	 * Level 2: Show when called
	 * Level 1: Log, and show on break
	 */
	$error_level = 2;
	
	$error_list = array();

	function show_error() {
		return "nope";
	}
	
	function set_error_level($level) {
		
	}
	/* 3 = Non-critical
	 * 2 = Ctitical, but can excape
	 * 1 = Critical, can not recover
	 */
	function log_error($name,$data,$level) {
		global $error_list, $error_level;
		if($error_level == 1) {
			$error_list[] = array($level,array($name,$data));
		} else {
			if($level == 1)
				die("<pre>Critical execption thrown. Shutting down.<br><br>".$name ." - ". $data);
			else
				echo "Error! " . $name .' - '. $data;
		}
	}
	
	function error_log_breakpoint() {
		global $error_list, $error_level;
		
		$error_level = 2; # Reset the error level
		
		if(count($error_list) != 0) {
			die("<pre>Critical execption(s) thrown <br>". var_dump($error_list));
		}
	}
?>
