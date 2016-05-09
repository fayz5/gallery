<?php
/* *******************************************
 * This class is responsible for creating and 
 * maintaining sessions.
 *
 * @author  Akmal Fayziyev
 * @version 1.0, 06/05/2016
 *********************************************/


class Session {

	private $logged_in;
	public $message;
	public $user_id;
	public $active_tab;

	//Constructor Starts a Session & populates object attributes
	function __construct(){
		session_start();
		$this->check_login();
		$this->check_message();
	}

	public function is_logged_in(){
		return $this->logged_in; 
	}

	public function login($user){
		if($user){
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->logged_in = true; 
		}
	}

	public function logout(){
		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->logged_in = false;
	}

	private function check_login(){

		if(isset($_SESSION['user_id'])){
			$this->user_id = $_SESSION['user_id'];
			$this->logged_in = true;
		}else{
			unset($this->user_id);
			$this->logged_in = false;
		}
	}
	
	//Set or return a message
	public function message($msg="") {
		if(!empty($msg)) {
			$_SESSION['message'] = $msg;
		} else {
			return $this->message;
		}
	}

	private function check_message() {
		if(isset($_SESSION['message'])) {
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else {
			$this->message = "";
		}
	}

}

$session = new Session();
$message = $session->message();


?>