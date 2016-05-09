<?php
/* *******************************************
 * This class is wrapper around msqli
 * which provides for maintaining connections 
 * and working with MySQL database.
 *
 * @author  Akmal Fayziyev
 * @version 1.0, 06/05/2016
 *********************************************/

require_once("config.php");

class MySQLDatabase {
	
	private $connection;

	//Constructor function
	function __construct(){
		$this->open_connection();
	}

	//Connect to DB
	public function open_connection(){
		$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		
		//Check if connection was successful
		if(mysqli_connect_errno()){
			die("Connection failed ".mysql_connect_error());

		}
	}

	//Close existing connection
	public function close_connection(){
		if(isset($this->connection)){

			mysqli_close($this->connection);
			unset($this->connection);
		}
	}

	//SQL query function
	public function query($sql_query){
		if(!empty($sql_query)){
			$result = mysqli_query($this->connection, $sql_query);
			$this->confirm_query($result);
			return $result;	
		}
		return NULL;
	}

	//Check if query was successful
	private function confirm_query($result){
		if(!$result){
			die("Database query failed");
		}
	}

	//Escape special characters in a string
	public function escape_chars($string){
		$escaped_string = mysqli_real_escape_string($this->connection, $string);
		return $escaped_string;
	}

	//Fetch a result row as an associative array
	public function fetch($result_set){
		$result = mysqli_fetch_assoc($result_set);
		return $result;
	}

	//Get the number of rows in a result set
	public function num_rows($result_set){
		return mysqli_num_rows($result_set);	
	}

	//Get the number of rows affected by the last query. 
	public function affected_rows(){
		return mysqli_affected_rows($this->connection);
	}

	//Get the last inserted ID
	public function insert_id(){
		return mysqli_insert_id($this->connection);
	}

}

//Instantiation
$db = new MySQLDatabase();

?>