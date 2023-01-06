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
		<?php require('controller/connect.php');?>
		<?php require('header.php');
		$sid = $_GET['sid'];?>
	
		<section class="logform">
			<div class="wrapper">
				<h1>Write Review</h1>
				<form action="controller/reviewcont.php?sid=<?=$sid?>" method="post" enctype="multipart/form-data">
					<div class="search_fields">
						<hr class="form_horiz"/>
						<input type="number" class="float" id="logform" name="rating" placeholder="Rating" min="1" max="10" autocomplete="off" required>
						<hr class="form_vert"/>
						<textarea name="review" rows="15" cols="45" placeholder="Review" required/></textarea>
						<br>
					</div>
					<hr class="form_horiz"/>					
					<input type="submit" id="add_review" class="form_button" name="add_review" value="submit"/>
				</form>	
				<a class="form_button" href="reviews.php?sid=<?=$sid?>">cancel</a>
			</div>
		</section>	


	<?php require('footer.html');?>
</body>	

</html>