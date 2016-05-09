<?php require_once("../includes/init.php"); ?>
<?php
	// Find all photos
	$photos = Photograph::find_all();
?>

<?php include_layout_template('header.php'); ?>

<?php foreach($photos as $photo) { ?>
  <div style="float: left; margin-left: 20px;">
		<a href="photo.php?id=<?php echo $photo->id; ?>">
			<img src="<?php echo $photo->image_path(); ?>" width="200" height="150"/>
		</a>
    <p><?php echo $photo->caption; ?></p>
  </div>
<?php } ?>

<?php include_layout_template('footer.php'); ?>