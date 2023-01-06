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
		<?php include('header.php');?>
		<?php 
			//if user is logged in, get their user info
			if (isset($_GET['u'])) {
				$username = $_GET['u'];
				$username = htmlspecialchars($username);
				$raw_results = mysqli_query($conn,"SELECT * FROM users
						WHERE username='".$username."'");
				$results = mysqli_fetch_array($raw_results);
				
				//get spaces user owns
				$raw_ownspaces = mysqli_query($conn,"SELECT * FROM space
						WHERE ownerusername='".$username."'");
						
				//get info on where user works
				$raw_w = mysqli_query($conn,"SELECT * FROM members
						WHERE username='".$username."'");
				$w = mysqli_fetch_array($raw_w);	
				$w_sid = $w['sid'];
				$w_sid = htmlspecialchars($w_sid);
				$raw_works = mysqli_query($conn,"SELECT * FROM space WHERE sid='".$w_sid."'");
				$works = mysqli_fetch_array($raw_works);	
			}
		?> 
		
		
		<section class="logform">
		<div class="wrapper">
			<div class="profiles">
				<div class="backlinks">
					<div class="insidelinks">
						<img src="uploads/<?=$results['photo']?>" width="200" alt="Profile Picture" />
						<h5> Age: <?php echo "".$results['age']."";?></h5>
						<h5> Location: <?php echo "".$results['location']."";?></h5>
						<h5> Works at: <a href="spaceprofile.php?sid=<?=$works['sid']?>"><?=$works['name']?></a></h5>
						<h5> Score: <?php echo "".$results['avescore']."";?> </h5>
						
						<?php
						if (isset($_SESSION['username']) and $username == $_SESSION['username']){ ?>
							
							<form action="editprofile.php" method="post">				
								<input type="submit" id="edit_profile" class="form_button" name="edit_profile" value="Edit"/>
							</form>
							<br><br>
						<?php } ?>
						
					</div>
				</div>
				<div class="mainprof">
					<h2> 
					<?php 
						//if user is logged in, print their username
						echo "".$results['first']." ".$results['last']."";				
					?> 
					</h2>
					<h3>Occupation: <?php echo "".$results['occupation']."";?></h3>
					<p>Email: <?php echo "".$results['email']."";?></p>
					<hr class="profbreak" />				
					<p><?php echo "".$results['description']."";?></p>
				</div>
			
				<br>
				<div class="mainprof">
					<h3> Spaces </h3>
					<hr class="profbreak" />
					<?php
					if (mysqli_num_rows($raw_ownspaces) > 0){ // if one or more rows are returned do following
						// $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it prints the formatted data in the loop
						while($ownspaces = mysqli_fetch_array($raw_ownspaces)){ 
							//output formatted results
							?>
							<a href="spaceprofile.php?sid=<?=$ownspaces['sid']?>"><h4><?=$ownspaces['name']?></h4></a>
							<br>
							<?php 
						}			 
					}
					else{ // if there is no matching rows do following
						echo "No results";
					}	
					?>
				</div>
				
				<br>
				<div class="mainprof">
					<h3> Friends </h3>
					<hr class="profbreak" />
					
					<?php
					if (isset($_GET['u'])) {
						$user = $_GET['u'];
						$user = htmlspecialchars($user);
						$i = 0;
						
						//used for listing friends
						$friendresults = mysqli_query($conn,"SELECT * FROM friendswith
							WHERE username1='$user' OR username2 = '$user'");
						if(mysqli_num_rows($friendresults) > 0){ //checks if user has friends
							while($results = mysqli_fetch_array($friendresults) and $i < 4){
								//only displays a few friends
								//checks for different users
								if ($results['username1'] == $user){
									$friend = $results['username2'];
								}else{
									$friend = $results['username1'];
								}
								//retrieves info for each friend
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
								$i++;
							}
						?>
						<p><a href="friends.php?u=<?=$username?>">View All</a></p>
						<?php
						}else{ ?>
						<h5>No results.</h5>
						<?php
							
						}
					}?>
	
				</div>
				<br>
				<div class="mainprof">
					<h3> Reviews </h3>
					<hr class="profbreak" />
					<?php
					if (isset($_GET['u'])) {
						$user = $_GET['u'];
						$user = htmlspecialchars($user);
						$reviewresults = mysqli_query($conn,"SELECT * FROM userreview
								WHERE reviewedusername='".$user."'");
						if(mysqli_num_rows($reviewresults) > 0){ //checks if there are reviews for this space
							$review = mysqli_fetch_array($reviewresults)?>
							
							<h4>Rating: <?=$review['score']?>/10</h4>
							<h5><a href="profile.php?u=<?=$review['reviewerusername']?>"><?=$review['reviewerusername']?></a></h5>
							<p><?=$review['description']?></p>
							<br>
							<p><a href="userreviews.php?u=<?=$user?>">View All</a></p>
						<?php
						
						}else{ //there are no reviews ?>
							<h5>No results</h5>
							
							<?php
							if (isset($_SESSION['username'])){
								$current = $_SESSION['username'];
								
								//checks if these users are friends
								$check_friend = mysqli_query($conn,"SELECT * FROM friendswith WHERE (username1 = '$user' AND username2 = '$current')
									OR (username1 = '$current' AND username2 = '$user')");
								
								if(mysqli_num_rows($check_friend) > 0){//current user is a friend and can write a review
									?>
									<p><a href="adduserreview.php?u=<?=$user?>">Write a Review?</a></p>
								<?php
								}
							}?>
							<br>
						<?php 
						}
					} ?>
					
			
				</div>
			<br>	
			</div>
		</section>	



</body>	

</html>