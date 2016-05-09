<?php
/* *******************************************
 * This class extends DatabaseObject class
 * and provides many methods for 
 * working with user uploaded images.
 *
 * @author  Akmal Fayziyev
 * @version 1.0, 08/05/2016
 *********************************************/

require_once('database.php');

class Photograph extends DatabaseObject{

	static protected $table_name = 'photos';
	public $id;
	public $filename;
	public $type;
	public $size;
	public $caption;
	static $db_fields = array('filename', 'type', 'size', 'caption');

	//File upload related properties
	public $eroors = array();
	private $temp_path;
	protected $upload_dir = 'images';

	//File upload error constants and descriptions
	protected $upload_errors  = array(
		UPLOAD_ERR_OK => 'Successfully uploaded',
		UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive.',
		UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE.',
		UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded.',
		UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
		UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
		UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
		UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.'
	);


	//Process uploaded file pass $_FILE['uploaded_file']
	public function attach_file($file){
		//Error checking
		if(!$file || empty($file) || !is_array($file)){
			$this->error[] = "No wile was uploaded";
			return false;
		}else if($file['error'] !==0 ){
			$this->error[] = $upload_errors[$file['error']];
			return false;
		}

		//Setting object attributes
		$this->temp_path = $file['tmp_name'];
		$this->filename = basename($file['name']);
		$this->type = $file['type'];
		$this->size = $file['size'];

		return true;
	}

	//@Override 
	public function save(){

		if(isset($this->id)){
			//Update a caption
			$this->update();
		}else{
			//If there was an error with the file stop
			if(!empty($this->error)) {return false;}

			//Caption should't be more than 255 characters
			if(strlen($this->caption) >= 255){
				$this->error[] = 'The caption can only be 255 characters long!';
				return false;
			}
			// Check file size
			if ($this->caption > 5242880) {
			    $this->error[] = "Sorry, your file is too large.";
			    return false;
			}

			// Allow certain file formats
			if($this->type != "image/jpeg" && $this->type != "image/png" && $this->type != "image/bmp"
			&& $this->type != "image/gif" ) {
			    $this->error[] = "Only JPG, JPEG, PNG, BMP, & GIF files are allowed!";
			    return false;
			}

			//Can't save without filename and temp location
			if(empty($this->filename) || empty($this->temp_path) ){
				$this->error[] = 'The file location is not available!';
				return false;	
			}

			//Path where photo will be saved
			$target_path = SITE_ROOT."/public/".$this->upload_dir."/".$this->filename;
			//Make sure that file doesn't already exist
			if(file_exists($target_path)){
				$this->error[] = 'File with this name already exists!';
				return false;	
			}

			//Attempt to move file from temp directory
			if(move_uploaded_file($this->temp_path, $target_path)){
				//Success
				//Save entry to DB
				if($this->create()){
					//File has been moved and there is nothing in $temp_path
					unset($this->temp_path);
					return true;
				}

			}else{
				//File was not moved
				$this->error[] = "The file upload failed.";
				return false;
			}

		}


	}

	public function image_path(){
		return $this->upload_dir."/".$this->filename;
	}

	//Returns filesize in bytes, KB or MB
	public function size_as_text() {
		if($this->size < 1024) {
			return "{$this->size} bytes";
		} elseif($this->size < 1048576) {
			$size_kb = round($this->size/1024);
			return "{$size_kb} KB";
		} else {
			$size_mb = round($this->size/1048576, 1);
			return "{$size_mb} MB";
		}
	}

	//Delete a photo
	public function destroy() {
		// Remove the database entry
		if($this->delete()) {
			// Remove the file and return the result
			$target_path = SITE_ROOT.'/public/'.$this->image_path();
			return unlink($target_path) ? true : false;
		} else {
			// Database delete failed
			return false;
		}
	}

}

?>