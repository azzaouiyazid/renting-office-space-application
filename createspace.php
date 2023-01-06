<!DOCTYPE html>
<html lang="en">
<head>
	<title>SynergySpace</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/formpages.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	
</head>
<body>

	<section class="topper">
	<?php session_start(); ?>
	<?php require('header.php');?>

	
		<section class="logform">
		<div class="wrapper">
		<br>
		<h1>Create a Space Listing</h1>
				<!-- below are is the information a user can fill out when they want to list a space -->
				<form action="controller/makespace.php" method="post" enctype="multipart/form-data">
					<div class="search_fields">
						<hr class="form_horiz"/>
						<input type="text" class="float" id="logform" name="name"  placeholder="Name" autocomplete="off" required>
						<br>
						<hr class="form_horiz"/>
						<input type="text" class="float" id="logform" name="location"  placeholder="Location" autocomplete="off" required>
						<br>
						<hr class="form_vert"/>
						<input type="number" min="0" class="float" id="logform" name="price" placeholder="Price" autocomplete="off" required>
						<br>
						<hr class="form_horiz"/>
						<textarea name="description" class="float" rows="15" cols="45" placeholder="Description" required></textarea>
						<hr class="form_vert"/>
						<input type="file" class="float" id="logform" name="photo" accept="image/*" required>
					</div>
					<hr class="form_horiz"/>					
					<input type="submit" id="spacecreate" class="form_button" name="spacecreate" value="submit"/>
				</form>	
		</div>
	</section>


<?php require('footer.html');?>
</body>	

</html>	