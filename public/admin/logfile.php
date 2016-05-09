<?php
require_once("../../includes/init.php");
if (!$session->is_logged_in()) { redirect_to("login.php"); }
$session->active_tab="#photos";
$log_file = SITE_ROOT.'/logs/logfile.txt';

?>

<?php include_layout_template('admin_header.php'); ?>

<?php



	if (file_exists($log_file)){

		if($_GET['clear'] == 'true'){

			if(is_writable($log_file)) {
				$log_handle = fopen( $log_file, 'w' );
				fclose($log_handle);
			}
		
		}else{
			if(!is_readable($log_file)){
				echo "Error cannot access log file!";
			}else{
				
				$log_handle = fopen($log_file, 'r');

				if($log_handle){
					while($content = fgets($log_handle)){
						echo '<h4>'.$content.'</h4>';
					}
					
				}

				fclose($log_handle);

			}

		}

		
	}

?>

	<a href="logfile.php?clear=true">Clear Log File</a>
	

<?php include_layout_template('admin_footer.php'); ?>