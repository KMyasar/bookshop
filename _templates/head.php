<head>
	<!-- fetch the title based on script -->
	<title>
		<?php echo basename(sessions::CurrentScript(), ".php") ?>
	</title>
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">

	<script src="js/core.min.js"></script>
	<link rel="icon" href="images/planner.png" type="image/x-icon">
	<?php
	if ((basename(sessions::CurrentScript(), ".php") == "login")or(basename(sessions::CurrentScript(),".php")=="signup")) {
	?>
		<link rel="stylesheet" href="css/credentials.css">
	<?php
	}
	elseif (basename(sessions::CurrentScript(),".php")=="checkout") {
		?>
		<link rel="stylesheet" href="css/checkout.css">
		<link rel="stylesheet" href="css/lib/bootstrap.min.css ">
		<?php
	} 
	else {
		?>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/fonts.css">
		<?php
	}
	?>
</head>