<?php
require('connect.php');
session_start();

//accept applicant
if (isset($_POST['accept'])) {
	$sid = $_POST['sid'];
	$username = $_POST['username'];

	$sid = htmlspecialchars($sid);
	$username = htmlspecialchars($username);

	//add applicant to members table with this space
	$sql = "INSERT INTO members (username, sid) VALUES ('$username', '$sid')";
	$retval = mysqli_query($conn, $sql);
	if (!$retval) { //error handling
		die('There was an error: ' . mysqli_error($conn));
	} else {
		//remove user from interestedin table
		$sql = "DELETE FROM interestedin where `username`='$username' AND `sid`='$sid'";
		$retval = mysqli_query($conn, $sql);
		if (!$retval) { //error handling
			die('There was an error: ' . mysqli_error($conn));
		} else {
			//get username of users in space
			//get username of users in space
			$raw_results = mysqli_query($conn, "SELECT * FROM members WHERE sid='$sid'");

			//add all members of the space to be friends with the user
			if (mysqli_num_rows($raw_results) > 0) {
				while ($results = mysqli_fetch_array($raw_results)) {
					if ($results['username'] != $username) {
						$friend = $results['username'];
						$check_friend = mysqli_query($conn, "SELECT * FROM friendswith WHERE (username1 = '$username' AND username2 = '$friend')
            OR (username1 = '$friend' AND username2 = '$username')");
						if (mysqli_num_rows($check_friend) == 0) { //No results means they're not already friends
							$addfriend = mysqli_query($conn, "INSERT INTO friendswith (username1, username2, sid)
                VALUES('$username', '$friend', '$sid')");
						}
					}
				}
			}
			//add owner as well
			$self = $_SESSION['username'];
			$addfriend = mysqli_query($conn, "INSERT INTO friendswith (username1, username2, sid)
                VALUES('$username', '$self', '$sid')");

			header('Location: ../applicants.php?sid=' . $sid);
		}
	}
}
//decline applicant
else if (isset($_POST['decline'])) {
	$username = $_POST['username'];

	$sid = htmlspecialchars($sid);
	$username = htmlspecialchars($username);

	//remove user from interestedin table
	$sql = "DELETE FROM interestedin where `username`='$username' AND `sid`='$sid'";
	$retval = mysqli_query($conn, $sql);
	if (!$retval) { //error handling
		die('There was an error: ' . mysqli_error($conn));
	} else {
		header('Location: ../applicants.php?sid=' . $sid);
	}
}
