<?php

require_once('../../includes/init.php');

if (!$session->is_logged_in()) { redirect_to("login.php"); }

if(empty($_GET['id'])) {
	redirect_to('index.php');
}

$photo = Photograph::find_by_id($_GET['id']);

if($photo && $photo->destroy()) {
	redirect_to('photo_list.php');
} else {
	redirect_to('photo_list.php');
}
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
