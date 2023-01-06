<?php 		
	require('connect.php');
	session_start();	

	if (isset($_SESSION['username'])) {
		$sid = $_GET['sid'];
		$user = $_SESSION['username'];

	
		$sid = htmlspecialchars($sid);
		$user = htmlspecialchars($user);

	
		$sid = mysqli_real_escape_string($conn, $sid);
		$user = mysqli_real_escape_string($conn, $user);
		
		//get username of space owner
		$raw_results = mysqli_query($conn, "SELECT * FROM members WHERE sid='$sid'");
		
		if(mysqli_num_rows($raw_results) > 0){
			while($results = mysqli_fetch_array($raw_results)){
				if ($results['username'] != $user){
					$friend = $results['username'];
					$check_friend = mysqli_query($conn, "SELECT * FROM friendswith WHERE (username1 = '$user' AND username2 = '$friend')
					OR (username1 = '$friend' AND username2 = '$user')");
					if(mysqli_num_rows($check_friend) == 0){//No results means they're already friends
						$addfriend = mysqli_query($conn, "INSERT INTO friendswith (username1, username2, sid)
						VALUES('$user', '$friend', '$sid')");
						}
						}
						}
					} //if rows == 0 then there are no members for this space, redirect anyways
					header('Location: ../index.php');
			
			
			}else{
				echo "You're not logged in!";
			}
				?>