<?php
require_once('../../includes/init.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
$session->active_tab="#photos";
?>
<?php

if(isset($_POST['submit'])){
	$photo = new Photograph();
	$photo->caption = $_POST['caption'];
	$photo->attach_file($_FILES['file_upload']);
	if($photo->save()){
		$session->message("File successfully uploaded.");
		//$message = "File successfully uploaded";
		redirect_to('photo_list.php');
	}else{
		$message = join('<br />', $photo->error);
	}
}


?>


<?php include_layout_template('admin_header.php'); ?>

	<h2>Upload Photo</h2>
	<form action="photo_upload.php" enctype="multipart/form-data" method="POST">
		<div class="form-group col-xs-4">
			<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
			<div class="form-group">
				<label for="inputFile">Select a file to upload:</label>
				<input id="inputFile" type="file" class="btn btn-default" name="file_upload" id="file_upload">
			</div>
			<div class="form-group">
				<label for="caption">Caption:</label>
				<input id ="caption" class="form-control" type="text" name="caption"></input>
			</div>
		    
		    
		    <?php echo output_message($message);?>
		    <input class="btn btn-success" type="submit" value="Upload" name="submit">
	    </div>	
	</form>

<?php include_layout_template('admin_footer.php'); ?>
		