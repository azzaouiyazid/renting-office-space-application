<?php include("controller/connect.php"); 
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
		<?php require('header.php');?>
		<?php 
			//if user is logged in, get their user info
			if (isset($_GET['u'])) {
				$username = $_GET['u'];
				$username = htmlspecialchars($username);
				$raw_results = mysqli_query($conn,"SELECT * FROM users
						WHERE username='".$username."'");
				$results = mysqli_fetch_array($raw_results);
			}
		?> 
		
		
		<section class="logform">
		<div class="wrapper">
			<div class="profiles">
				<div class="backlinks">
					<div class="insidelinks">
					<!-- displays the user's info -->
						<img src="uploads/<?=$results['photo']?>" width="200" alt="Profile Picture!" />
						<h5> Name: <?=$results['first']?> <?=$results['last']?></h5>
						<h5> Occupation: <?=$results['occupation']?></h5>
						<h5><a href="profile.php?u=<?=$username?>"> Full Profile</a></h5>
						
						
					</div>
				</div>
				<div class="mainprof">
					<h2> 
					<?=$results['first']?>'s Friends
					</h2>
					<hr class="profbreak" />
					<?php
					//checks if the user is set
					if (isset($_GET['u'])) {
						$user = $_GET['u'];
						$user = htmlspecialchars($user);
						
						$friendresults = mysqli_query($conn,"SELECT * FROM friendswith
							WHERE username1='$user' OR username2 = '$user'");
						if(mysqli_num_rows($friendresults) > 0){ //checks if user has friends
							while($results = mysqli_fetch_array($friendresults)){
								//selects only friends
								if ($results['username1'] == $user){
									$friend = $results['username2'];
								}else{
									$friend = $results['username1'];
								}
								//retrieves friends' user info
								$ind = mysqli_query($conn,"SELECT * FROM users
									WHERE username= '$friend'");
								if(mysqli_num_rows($ind) > 0){
									$friendinfo = mysqli_fetch_array($ind);
									
									?>
									<h4><img style="vertical-align:middle" src="uploads/<?=$friendinfo['photo']?>" width="70" alt="Profile Picture!" />
									 <a href="profile.php?u=<?=$friend?>"><?=$friendinfo['first']?> <?=$friendinfo['last']?></a></h4>
									 <br>
								<?php

								}
							}							
						}else{ ?>
						<h4>User has no friends! :(</h4>
						<?php
							
						}
					}?>

				</div>
		</div>
	</section>	


<?php require('footer.html');?>
</body>	

</html>