<?php echo $session;?>
<html>
  <head>
    <title>Photo Gallery</title>
    <link href="../styles/bootstrap.custom.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../styles/main.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
  	<ul class="topnav">
		<li><a id="admin_home" class="active" href="index.php">Home</a></li>
		<?php if($_SESSION['user_id']){ ?>
			<li><a id="photos" href="photo_list.php">Photos</a></li>
			<li><a id="logs" href="logfile.php">Activity Logs</a></li>
			<li><a href="../index.php">User view</a></li>
			<li class="right"><a href="logout.php">Logout</a></li>

		<?php } else { ?>
			<li class="right"><a href="../index.php">User view</a></li>
		<?php } ?>
	</ul>
    <div id="main">
