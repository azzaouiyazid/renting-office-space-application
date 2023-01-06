<?php include('controller/connect.php');?>
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
	
	<?php 
		//get the old space info to fill in the form as a default
			
		$sid = $_POST['sid'];
		$sid = htmlspecialchars($sid);
		$raw_results = mysqli_query($conn,"SELECT * FROM space
						WHERE sid='".$sid."'");
		$results = mysqli_fetch_array($raw_results);
			
	?> 
	

	
		<section class="logform">
		<div class="wrapper">
		<br>
		<h1>Update Space Listing</h1>
				<!-- below is the information a user can fill out when they want to update a space -->
				<form action="controller/updatespace.php" method="post" enctype="multipart/form-data">
					<div class="search_fields">
						<input type="hidden" name="sid"  value="<?=$sid?>" autocomplete="off">
						<hr class="form_horiz"/>
						<input type="text" class="float" id="logform" name="name"  placeholder="Name" value="<?=$results['name']?>" autocomplete="off" required>
						<br>
						<hr class="form_horiz"/>
						<input type="text" class="float" id="logform" name="location"  placeholder="Location" value="<?=$results['location']?>" autocomplete="off" required>
						<br>
						<hr class="form_vert"/>
						<input type="number" min="0" class="float" id="logform" name="price" placeholder="Price" value="<?=$results['price']?>" autocomplete="off" required>
						<br>
						<hr class="form_horiz"/>
						<textarea name="description" class="float" rows="15" cols="45" placeholder="Description" required><?=$results['description']?></textarea>
						<hr class="form_vert"/>
						<input type="file" class="float" id="logform" name="photo" accept="image/*">
					</div>
					<hr class="form_horiz"/>					
					<input type="submit" id="edit_space" class="form_button" name="edit_space" value="submit"/>
				</form>	
		</div>
	</section>


<?php require('footer.html');?>
</body>	

</html>	