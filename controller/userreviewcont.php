<?php 		
require('connect.php');
session_start();	
if (isset ($_POST['add_review'])){
    if (isset($_SESSION['username'])){
        $user = $_GET['u'];
        $reviewer = $_SESSION['username'];
        $score = $_POST['rating'];
        $description = $_POST['review'];
    
        $user = htmlspecialchars($user);
        $reviewer = htmlspecialchars($reviewer);
        $score = htmlspecialchars($score);
        $description = htmlspecialchars($description);
    
        $user = mysqli_real_escape_string($conn, $user);
        $reviewer = mysqli_real_escape_string($conn, $reviewer);
        $score = mysqli_real_escape_string($conn, $score);
        $description = mysqli_real_escape_string($conn, $description);
        
        $check_friend = mysqli_query($conn, "SELECT * FROM friendswith WHERE (username1 = '$user' AND username2 = '$reviewer')
        OR (username1 = '$reviewer' AND username2 = '$user')");
			
			if(mysqli_num_rows($check_friend) == 0){//Checks if users are friends
				echo "You can only review your friends!";
			}else{ //users are friends
				
				if ($user == $reviewer){ //checks if user is reviewing their own profile
					echo "You can't review yourself!";
				}else{
					$dup_results = mysqli_query($conn,"SELECT * FROM userreview WHERE reviewerusername='$reviewer' AND reviewedusername = '$user'");
					
					if(mysqli_num_rows($dup_results) > 0){ //checks if current user has already reviewed this user
						echo "You've already reviewed this user!";
					}else{ //adds review
						$sql = "INSERT INTO userreview (urid, reviewerusername, reviewedusername, description, score) VALUES (NULL, '$reviewer', '$user', '$description', '$score')";	
						$retval = mysqli_query($conn,$sql);
						
						if(!$retval ){//error handling
							die('Could not enter data: ' . mysqli_error($conn));
						}else{ //updates user's average score
							$score_results = mysqli_query($conn,"SELECT AVG(score) AS average FROM userreview WHERE reviewedusername='$user'");
							
							if(mysqli_num_rows($score_results) == 1){
								$averesults = mysqli_fetch_array($score_results);
								$avescore = $averesults['average'];
								$updatescores = mysqli_query($conn,"UPDATE users SET avescore = '$avescore' WHERE username= '$user'");
								
								if(!$updatescores ){//error handling
									die('Could not enter data: ' . mysqli_error($conn));
								}else{
									header('Location: ../userreviews.php?u='.$user);
								}
							}
						}
					}
				}
			}
				

		}else{
			echo "You're not logged in!";
		}
	}
		?>