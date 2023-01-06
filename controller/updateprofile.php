<?php
require('connect.php');
session_start();

if (isset($_POST['edit_profile'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$location = $_POST['location'];
	$occupation = $_POST['occupation'];
	$age = $_POST['age'];
	$email = $_POST['email'];
	$description = $_POST['description'];
	$username = $_SESSION['username'];

	$location = htmlspecialchars($location); // changes characters used in html to their equivalents,ex. < to &gt;
	$occupation = htmlspecialchars($occupation);
	$age = htmlspecialchars($age);
	$email = htmlspecialchars($email);
	$fname = htmlspecialchars($fname);
	$lname = htmlspecialchars($lname);
	$description = htmlspecialchars($description);
	$username = htmlspecialchars($username);

	$location = mysqli_real_escape_string($conn, $location); // makes sure nobody uses SQL injection
	$occupation = mysqli_real_escape_string($conn, $occupation);
	$age = mysqli_real_escape_string($conn, $age);
	$email = mysqli_real_escape_string($conn, $email);
	$fname = mysqli_real_escape_string($conn, $fname);
	$lname = mysqli_real_escape_string($conn, $lname);
	$description = mysqli_real_escape_string($conn, $description);

	//checks if all fields have been filled in (other than photo)
	if ($location and $occupation and $age and $email and $fname and $lname and $description) {
		//update the user table with the new information
		$sql = "UPDATE users SET `first`='$fname', `last`='$lname', `description`='$description', `email`='$email',`age`='$age', `occupation`='$occupation',`location`='$location' WHERE `username`='$username'";
		$retval = mysqli_query($conn, $sql);
		if (!$retval) {
			die('Could not update data: ' . mysqli_error($conn));
		} else {
			if ($_FILES["photo"]["name"]) {
				//upload the photo
				$target_dir = "../uploads/";
				$target_file = $target_dir . basename($_FILES["photo"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["photo"]["tmp_name"]);
				if ($check !== false) {
					//echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["photo"]["size"] > 2000000) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if (
					$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif"
				) {
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
						$file = basename($_FILES["photo"]["name"]);
						//echo "The file ". $file. " has been uploaded.";
						$sql = "UPDATE users SET `photo`='$file' WHERE `username`='$username'";
						$retval = mysqli_query($conn, $sql);
						if (!$retval) {
							$error = 'Could not update data: ' . mysqli_error($conn);
							// Log the error to a file
							error_log($error, 3, "logs/mysql_errors.log");
							// Print the error message to the screen
							echo $error;
						} else {
							header('Location: ../profile.php?u=' . $_SESSION['username']);
						}
					} else {
						// There was an error moving the file
						$error_code = $_FILES["photo"]["error"];
						$error_message = "";
						switch ($error_code) {
							case UPLOAD_ERR_INI_SIZE:
								$error_message = "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
								break;
							case UPLOAD_ERR_FORM_SIZE:
								$error_message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
								break;
							case UPLOAD_ERR_PARTIAL:
								$error_message = "The uploaded file was only partially uploaded.";
								break;
							case UPLOAD_ERR_NO_FILE:
								$error_message = "No file was uploaded.";
								break;
							case UPLOAD_ERR_NO_TMP_DIR:
								$error_message = "Missing a temporary folder.";
								break;
							case UPLOAD_ERR_CANT_WRITE:
								$error_message = "Failed to write file to disk.";
								break;
							case UPLOAD_ERR_EXTENSION:
								$error_message = "A PHP extension stopped the file upload.";
								break;
							default:
								$error_message = "Unknown error occurred while uploading the file. Error code: " . $error_code;
								break;
						}
						echo "Sorry, there was an error uploading your file: " . $error_message;
					}
				}
			} else {
				header('Location: ../profile.php?u=' . $_SESSION['username']);
			}
		}
	} else {
		echo "Missing fields";
	}
}
