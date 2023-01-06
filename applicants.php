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
		//gets the sid of the appropriate listing and queries for its info
		$sid = $_GET['sid'];
		$sid = htmlspecialchars($sid);
		$raw_results = mysqli_query($conn,"SELECT * FROM interestedin WHERE sid='".$sid."'");			  
	?> 

	
		<section class="logform">
		<div class="wrapper">
		<br>
		<h1>Accept or decline applicants</h1>
			<section class="listings">
			<div class="wrapper">
				<ul class="properties_list">
				<?php
				if (mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
					while($results = mysqli_fetch_array($raw_results)){ 
						//output formatted applicants who have applied for this space with reject or accept buttons?>
						<li>
						<div class="wrapper">
						<form action="controller/rejectoraccept.php" method="post" enctype="multipart/form-data">
							<div class="search_fields">
								<h2><a href="profile.php?u=<?=$results['username']?>"><?=$results['username'] ?></a></h2>	
								<input type="hidden" class="float" id="logform" name="username" value="<?=$results['username']?>" autocomplete="off">
								<input type="hidden" class="float" id="logform" name="sid" value="<?=$results['sid']?>" autocomplete="off">
							</div>					
							<input type="submit" id="accept" class="form_button" name="accept" value="Accept"/>
							<input type="submit" id="decline" class="form_button" name="decline" value="Decline"/>
						</form>	
						</div>
						</li>
					<?php 
					}			 
				}
				else{ // if there is applicants for this space do following
					echo "No one has expressed interest in this space.";
				}
				?>
				</ul>
		</div>
		</section>
		</div>
	</section>


<?php require('footer.html');?>
</body>	

</html>	