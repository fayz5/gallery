<?php
require_once("../../includes/init.php");

if($session->is_logged_in()){
	redirect_to('index.php');
}

$session->active_tab="#admin_home";
//If user submitted login information
if(isset($_POST['submit'])){
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	//Check database if that user exist
	$found_user = User::authenticate($username, $password);

	if ($found_user){
		$session->login($found_user);
		log_action('Login', $found_user->username." logged in");
		redirect_to('index.php');
	}else{
		$message = "Username or password is incorrect.";
	}
}else{

}
?>

<?php include_layout_template('admin_header.php'); ?>

	<h2>Staff Login</h2>
	<?php echo output_message($message); ?>

	<form class="form-group col-xs-4" action="login.php" method="post">
		<div class="form-group form-inline">
			<label for="username">Username:</label>
			<input id = "username" class="form-control" type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
		</div>
		<div class="form-group form-inline">
			<label for="password">Password:&nbsp</label>
			<input id="password" class="form-control" type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		</div>
		<input class= "btn btn-success" type="submit" name="submit" value="Login" />
	</form>

<?php include_layout_template('admin_footer.php'); ?>




