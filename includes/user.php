<?php
/************************************************
 * This class extends DatabaseObject class and 
 * provides methods for working with users. 
 *
 * @author  Akmal Fayziyev
 * @version 1.0, 07/05/2016
 ************************************************/

require_once('database.php');

class User extends DatabaseObject{

	static protected $table_name = 'users';
	public $id;
	public $username;
	public $password;
	public $firstname;
	public $lastname;
	static $db_fields = array('username', 'password', 'firstname', 'lastname');


	//Authenticate user with giver username and password
	static function authenticate($username = '', $password = ''){
		global $db;

		$username = $db->escape_chars($username);
		$password = $db->escape_chars($password);

		$query_str = "SELECT * FROM users ";
		$query_str .= "WHERE username = '{$username}' ";		
		$query_str .= "AND password = '{$password}' LIMIT 1";
		
		$object_array = self::find_by_sql($query_str);
		return !empty($object_array) ? array_shift($object_array) : false;
	}

	//Return the full name
	public function full_name(){
		if(isset($this->firstname) && isset($this->lastname)){
			return $this->firstname." ".$this->lastname;
		}else{
			return "";
		}
	}

	
	
}

?>