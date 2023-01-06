<?php
require('connect.php');
session_start();


if (isset($_POST['interest'])) {
	$sid = $_POST['sid'];
	$username = $_SESSION['username'];

	$sid = htmlspecialchars($sid);
	$username = htmlspecialchars($username);

	//check if user has already expressed interest in any space
	$raw_results = mysqli_query($conn, "SELECT * FROM interestedin WHERE username='" . $username . "'");

	//only let them express interest if they haven't already
	if (mysqli_num_rows($raw_results) == 0) {
		$sql = "INSERT INTO interestedin (username, sid) VALUES ('$username', '$sid')";
		$retval = mysqli_query($conn, $sql);
		if (!$retval) { //error handling
			die('Could not enter data: ' . mysqli_error($conn));
		} else {
			header('Location: ../spaceprofile.php?sid=' . $sid);
		}
	} else {
		echo "You already expressed your interest in a space! Wait until you get a response to ask anyone else.";
	}
}
?>