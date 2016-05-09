<?php
/* *******************************************
 * This class is the base class for 
 * database related objects class
 * and provides methods for performing 
 * CRUD operations.
 *
 * @author  Akmal Fayziyev
 * @version 1.0, 06/05/2016
 *********************************************/
require_once('database.php');

class DatabaseObject {

	//Find all users in the DB
	static function find_all(){
		return static::find_by_sql("SELECT * FROM ".static::$table_name);
	}


	//Find the user with given ID
	static function find_by_id($id = 1){
		global $db;
		
		$object_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id =".$db->escape_chars($id). " LIMIT 1");
		return !empty($object_array) ? array_shift($object_array) : false;
	}
	//Perform arbitrary SQL query
	static function find_by_sql($query_str = ""){
		global $db;
		
		$result_set = $db->query($query_str);
		$object_array = array();
		while($row = $db->fetch($result_set)){
			$object_array[] = static::instantiate($row);
		}

		return $object_array;
	}


	//Private Method that Creates an object from a single user record
	private static function instantiate($record){
		// $class_name = get_called_class();
		$object = new static;

		foreach ($record as $attribute => $value) {
			if($object->has_attribute($attribute)){
				$object->$attribute = $value;
			}
		}
		return $object;
	}

	private function has_attribute($attribute){
		$object_vars = get_object_vars($this);
		return array_key_exists($attribute, $object_vars);
	}


	//Return the array of attributs(props)
	public function attributes(){
		global $db;

		// return get_class_vars(get_class($this));
		// $attributes = get_object_vars($this);
		$attributes = array();

		foreach (static::$db_fields as $field) {
			if(property_exists($this, $field)){
				//Clean the values
				$attributes[$field] = $db->escape_chars($this->$field);
			}
			
		}

		return $attributes;
	}

	//Update or Create based on the existance of an id
	public function save(){
		return isset($this->id) ? $this->update() : $this->create();
	}

	//Create entry in the DB
	protected function create(){
		global $db;

		$attributes = $this->attributes();

		$create_query = "INSERT INTO ".static::$table_name." (";
		$create_query .= join(", ", array_keys($attributes));
		$create_query .= ") VALUES ('";
		$create_query .= join("', '", array_values($attributes));
		$create_query .= "')";

 		if($db->query($create_query)){

			$this->id = $db->insert_id();
			return true;

		}else{
			return false;
		}

	}


	//UPDATE the existing object in the DB
	protected function update(){
		global $db;

		$attributes = $this->attributes();

		//Create array of key value pairs used for UPDATE query
		$attribute_pairs = array();
		foreach ($attributes as $key => $value) {
			$attribute_pairs[] = "{$key} = '{$value}'";
		}

		$update_query = "UPDATE ".static::$table_name." SET ";
		$update_query .= join(", ",$attribute_pairs);
		$update_query .= " WHERE id=". $db->escape_chars($this->id);

		$db->query($update_query);
		return ($db->affected_rows() == 1) ? true: false;
		
	}

	//Delete the DB record corresponding to current object
	public function delete(){

		global $db;

		$delete_query = "DELETE FROM ".static::$table_name;
		$delete_query .= " WHERE id=". $db->escape_chars($this->id);
		$delete_query .= " LIMIT 1";

		$db->query($delete_query);
		return ($db->affected_rows() == 1) ? true: false;

	}

}

?>