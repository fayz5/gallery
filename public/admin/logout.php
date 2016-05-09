<?php require_once("../../includes/init.php"); ?>
<?php	
    $session->logout();
    redirect_to("login.php");
?>
