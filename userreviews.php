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
		<?php require('controller/connect.php');?>
		<?php require('header.php');?>
		
		
		<?php 
			//gets the sid of the appropriate listing and queries for its info
			if (isset($_GET['u'])) {
				$user = $_GET['u'];
				$user = htmlspecialchars($user);
				$raw_results = mysqli_query($conn,"SELECT * FROM users
						WHERE username='".$user."'");
				$results = mysqli_fetch_array($raw_results);
				}  
		?> 
		
		<section class="logform">
		<div class="wrapper">
			<div class="profiles">
			<div class="backlinks">
				<div class="insidelinks">
					<img src="uploads/<?=$results['photo']?>" width="200" alt="Profile Picture!" />
					<h5><?=$results['first']?> <?=$results['last']?></h5>
					<h5> Occupation: <?=$results['occupation']?></h5>
					<h5> Location: <?=$results['location']?></h5>
					<h5><a href="profile.php?u=<?=$user?>">Full Profile</a></h5>
					<?php 
					if (isset($_GET['u']) and isset($_SESSION['username'])) {
						//checks if user is logged in and other user is set
						$user = $_GET['u'];
						$reviewer = $_SESSION['username'];
						
						//checks if users are friend to display reviewing option
						$check_friend = mysqli_query($conn,"SELECT * FROM friendswith WHERE (username1 = '$user' AND username2 = '$reviewer')
							OR (username1 = '$reviewer' AND username2 = '$user')");
						if(mysqli_num_rows($check_friend) > 0){//current user is a friend and can write a review
						?>
						<h5><a href="adduserreview.php?u=<?=$user?>">Write a Review?</a></h5>
						<?php
						}
					}?>
				</div>
			</div>
			<?php
			if (isset($_GET['u'])) {
				$user = $_GET['u'];
				$user = htmlspecialchars($user);
				$userresults = mysqli_query($conn,"SELECT * FROM userreview
						WHERE reviewedusername='".$user."'");
				if(mysqli_num_rows($userresults) > 0){ //checks if there are reviews for this user
					while($review = mysqli_fetch_array($userresults)){ ?>
						<div class="mainprof">
							<h3>Rating: <?=$review['score']?>/10</h3>
							<h4><a href="profile.php?u=<?=$review['reviewerusername']?>"><?=$review['reviewerusername']?></a></h4>
							<hr class="profbreak" />
							<p><?=$review['description']?></p>
						</div>
						<br>
					<?php
					}
				}else{ //there are no reviews ?>
					<div class="mainprof">
						<h3>There are no reviews for this user!</h3>
						<?php
						//checks if users are friends to allow the current user to write a review
						if (isset($_GET['u']) and isset($_SESSION['username'])) {
							$user = $_GET['u'];
							$reviewer = $_SESSION['username'];
			
							$check_friend = mysqli_query($conn,"SELECT * FROM friendswith WHERE (username1 = '$user' AND username2 = '$reviewer')
								OR (username1 = '$reviewer' AND username2 = '$user')");
							if(mysqli_num_rows($check_friend) > 0){//current user is a friend and can write a review
							?>
							<h5><a href="adduserreview.php?u=<?=$user?>">Write a Review?</a></h5>
							<?php
							}
						}?>
						<hr class="profbreak" />
					</div>
					<br>
				<?php
				}
			} 
			?>
			</div>
		</div>
	</section>	


<?php require('footer.html');?>
</body>	

</html>