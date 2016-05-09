<?php

/* *******************************************
 * This file contains several independent 
 * functions that simplifies certain tasks
 *
 * @author  Akmal Fayziyev
 * @version 1.0, 06/05/2016
 *********************************************/

//Redirect to indicated location
function redirect_to($location = NULL){
	if($location != NULL){
		header("Location: {$location}");
		exit;
	}
}

//Return a message surrounded with <p> tags
function output_message($message = ""){
	if(!empty($message)){
		return "<p class=\'message\'>{$message}</p>";
	}else{
		return "";	
	}
}

//Used to include commonly used parts like header and footers
function include_layout_template($template="") {
	include(SITE_ROOT.'/public/layouts/'.$template);
}

//Simple function that writes an action and user provided message to a logfile
function log_action($action, $message = ""){

	$log_file = SITE_ROOT.'/logs/logfile.txt';
	
	//Check if logfile exists
	if (file_exists($log_file)){
		
		//Check if logfile is writable
		if(!is_writable($log_file)){
			echo "Error cannot access log file!";
		}else{
			//Open logfile for append
			$log_handle = fopen($log_file, 'a');
			//If it is successfully opened log action and message to file
			if($log_handle){
				$content = strftime('%Y-%m-%d %H:%M:%S | ', time());
				$content .= $action." : ";
				$content .= $message.".";
				fwrite($log_handle, $content.PHP_EOL);
			}

			fclose($log_handle);

		}
	}

}

?>
