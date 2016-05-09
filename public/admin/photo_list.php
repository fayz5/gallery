<?php
require_once('../../includes/init.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
$session->active_tab="#photos";
?>

<?php $photos = Photograph::find_all(); ?>
<?php include_layout_template('admin_header.php'); ?>
	<h2>Images</h2>
	<?php echo output_message($message); ?>
	<table class="table table-bordered table-condensed table-responsive">
	  <tr>
	    <th>Image</th>
	    <th>Filename</th>
	    <th>Caption</th>
	    <th>Size</th>
	    <th>Type</th>
			<th>&nbsp;</th>
	  </tr>
	<?php foreach($photos as $photo){ ?>
	  <tr>
	    <td><img src="../<?php echo $photo->image_path(); ?>" width="200" /></td>
	    <td><?php echo $photo->filename; ?></td>
	    <td><?php echo $photo->caption; ?></td>
	    <td><?php echo $photo->size_as_text(); ?></td>
	    <td><?php echo $photo->type; ?></td>
		<td>
			<a href="delete_photo.php?id=<?php echo $photo->id; ?>">
				<span class="glyphicon glyphicon-remove"></span>
				Delete
			</a>
		</td>
	  </tr>
	<?php } ?>
	</table>
	<br />
	<a href="photo_upload.php">Upload a new photo</a>
<?php include_layout_template('admin_footer.php'); ?>
		