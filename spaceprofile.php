<?php include('controller/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SynergySpace</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/formpages.css">
	<link rel="stylesheet" type="text/css" href="css/profpages.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	
</head>
<body>

	<section class="topper">

		<?php session_start(); ?>
		<?php include('header.php');?>
		
		
		<?php 
			//gets the sid of the appropriate listing and queries for its info
			if (isset($_GET['sid'])) {
				$sid = $_GET['sid'];
				$sid = htmlspecialchars($sid);
				$raw_results = mysqli_query($conn,"SELECT * FROM space
						WHERE sid='".$sid."'");
				$results = mysqli_fetch_array($raw_results);
				}  

			if (isset($_SESSION['username'])){
				//see if user owns this space
				$user = $_SESSION['username'];
				$raw_owner = mysqli_query($conn,"SELECT * FROM space WHERE sid='".$sid."' AND ownerusername='".$user."'");
						
				//see if user is already working in this space
				$in_space = mysqli_query($conn,"SELECT * FROM members WHERE sid='".$sid."' AND username='".$user."'");
			}
		?> 
		
		<section class="logform">
		<div class="wrapper">
			<div class="profiles">
			<div class="backlinks">
				<div class="insidelinks">
					<img src="uploads/<?=$results['photo']?>" width="200" alt="Thumb!" />
					<h5> Location: <?php 
						//gets the location of the appropriate listing
						echo "".$results['location'].""; 
					?> 
					</h5>
					<h5> Price: <?php 
						//gets the price of the appropriate listing
						echo "".$results['price']."";
					?> 
					</h5>
					<h5> Owner: 
						<!--gets the username of the owner of the appropriate listing-->
						<a href="profile.php?u=<?=$results['ownerusername']?>"><?=$results['ownerusername']?></a>
						
					</h5>
					
					<h5> Score: <?php 
						//gets the score of the appropriate listing
						echo "".$results['score']."";
						?> 
					</h5>

					<hr class="sidebreak" />
						<!-- Display edit button if the user owns this space -->
						<?php if ((isset($_SESSION['username'])) && (mysqli_num_rows($raw_owner) > 0)){ ?> 
							<form action="editspace.php" method="post">		
								<input type="hidden" name="sid"  value="<?=$sid?>" autocomplete="off">
								<input type="submit" id="edit_space" class="form_button" name="edit_space" value="Edit!"/>
							</form>
						<!-- Displays add review if the user works in this space -->
						<?php }else if ((isset($_SESSION['username'])) && (mysqli_num_rows($in_space) > 0)){ ?> 
							<a class="side_action" href="addreview.php?sid=<?=$sid?>">Rate</a>
						<!-- Displays express interest otherwise (user must be logged in) -->
						<?php }else if (isset($_SESSION['username'])){ ?> 
							<form action="controller/expressinterest.php" method="post">
								<input type="hidden" name="sid"  value="<?=$sid?>" autocomplete="off">
								<input type="submit" id="interest" class="form_button" name="interest" value="Work here!"/>
							</form>
						<?php } ?>
						<br><br><br>
						<!-- Display view applicants button if this is the user's space -->
						<?php if ((isset($_SESSION['username'])) && (mysqli_num_rows($raw_owner) > 0)){ ?> 
						<form action="applicants.php" method="get">	
							<input type="hidden" name="sid"  value="<?=$sid?>" autocomplete="off">
							<input type="submit" id="view_interested" class="form_button" name="view_interested" value="Applicants"/>
						</form>
					<?php } ?>
					<br><br>
				</div>
			</div>
			<div class="mainprof">
				<h3><?=$results['name']?> </h3>
				<hr class="profbreak" />
				<p>
				<?php 
					//gets the description of the appropriate listing
					echo "".$results['description']."";
				?> 
				</p>
								
			</div>
			<br>
			<div class="mainprof">
				<h3> Reviews </h3>
				<!--Displays reviews for this space -->
				<hr class="profbreak" />
				<?php
				if (isset($_GET['sid'])) {
					$sid = $_GET['sid'];
					$sid = htmlspecialchars($sid);
					$reviewresults = mysqli_query($conn,"SELECT * FROM review
							WHERE sid='".$sid."'");
					if(mysqli_num_rows($reviewresults) > 0){ //checks if there are reviews for this space
						$review = mysqli_fetch_array($reviewresults)?>
						
						<h4>Rating: <?=$review['score']?>/10</h4>
						<h5><a href="profile.php?u=<?=$review['reviewerusername']?>"><?=$review['reviewerusername']?></a></h5>
						<p><?=$review['description']?></p>
						<br>
						<p><a href="reviews.php?sid=<?=$sid?>">View All</a></p>
					<?php
					
					}else{ //there are no reviews ?>
						<h5>There are no reviews for this space!</h5>
						<br>
				<?php 
					}
				} ?>
			</div>
			<br>
			</div>
		</div>
	</section>	

	
<?php require('footer.html');?>
</body>	

</html>