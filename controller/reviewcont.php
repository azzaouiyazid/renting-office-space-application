<?php
require('connect.php');
session_start();
if (isset($_POST['add_review'])) {
	if (isset($_SESSION['username'])) {
		$sid = $_GET['sid'];
		$reviewer = $_SESSION['username'];
		$score = $_POST['rating'];
		$description = $_POST['review'];

		$sid = htmlspecialchars($sid);
		$reviewer = htmlspecialchars($reviewer);
		$score = htmlspecialchars($score);
		$description = htmlspecialchars($description);

		$sid = mysqli_real_escape_string($conn, $sid);
		$reviewer = mysqli_real_escape_string($conn, $reviewer);
		$score = mysqli_real_escape_string($conn, $score);
		$description = mysqli_real_escape_string($conn, $description);

		//get username of space owner
		$raw_results = mysqli_query($conn, "SELECT sid, ownerusername FROM space WHERE sid='$sid'");

		if (mysqli_num_rows($raw_results) == 1) {
			$results = mysqli_fetch_array($raw_results);
			$ownerusername = $results['ownerusername'];

			if ($reviewer == $ownerusername) { //checks if current user owns the space
				echo "You can't review your own space!";
			} else {
				$dup_results = mysqli_query($conn, "SELECT * FROM review WHERE sid='$sid' AND reviewerusername = '$reviewer'");

				if (mysqli_num_rows($dup_results) > 0) { //checks if user has already reviewed this space
					echo "You've already reviewed this space!";
				} else { //adds review
					$sql = "INSERT INTO review (rid, reviewerusername, ownerusername, description, score, sid) VALUES (NULL, '$reviewer', '$ownerusername', '$description', '$score', $sid)";
					$retval = mysqli_query($conn, $sql);

					if (!$retval) { //error handling
						die('Could not enter data: ' . mysqli_error($conn));
					} else { //checks for existing scores
						$score_results = mysqli_query($conn, "SELECT AVG(score) AS average FROM review WHERE sid='$sid'");

						if (mysqli_num_rows($score_results) == 1) {
							$averesults = mysqli_fetch_array($score_results);
							$avescore = $averesults['average'];
							//adds average review scores to space
							$updatescores = mysqli_query($conn, "UPDATE space SET score = '$avescore' WHERE sid= '$sid'");

							if (!$updatescores) { //error handling
								die('Could not enter data: ' . mysqli_error($conn));
							} else {
								header('Location: ../reviews.php?sid=' . $sid);
							}
						}
					}
				}
			}
		} else {

			header('Location: ../reviews.php?sid=' . $sid);
		}
	} else {
		echo "You're not logged in!";
	}
}
