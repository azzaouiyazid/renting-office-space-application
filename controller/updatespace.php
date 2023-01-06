<?php			
		require('connect.php');
		session_start();
		
		
		if (isset($_POST['edit_space'])){  
			$sid = $_POST['sid'];
			$location = $_POST['location'];
			$price = $_POST['price'];
			$description = $_POST['description'];
			$name = $_POST['name'];
			
			$sid = htmlspecialchars($sid);
			$location = htmlspecialchars($location);
			$price = htmlspecialchars($price);
			$description = htmlspecialchars($description);
			$name = htmlspecialchars($name);
			
			$location = mysqli_real_escape_string($conn,$location);// makes sure nobody uses SQL injection
			$price = mysqli_real_escape_string($conn,$price);
			$description = mysqli_real_escape_string($conn,$description);
			$name = mysqli_real_escape_string($conn,$name);
			

			//checks if all fields have been filled in (other than photo)
			if($location and $price and $description and $name and $sid){
				//update the space table with the new information
				$sql = "UPDATE space SET `location`='$location', `price`='$price', `description`='$description', `name`='$name' WHERE `sid`='$sid'";	
				$retval = mysqli_query($conn,$sql);
				if(!$retval ){
					die('Could not update data: ' . mysqli_error($conn));
				}
				else{
					if($_FILES["photo"]["name"]){
						//upload the photo
						$target_dir = "../uploads/";
						$target_file = $target_dir . basename($_FILES["photo"]["name"]);
						$uploadOk = 1;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						// Check if image file is a actual image or fake image
							$check = getimagesize($_FILES["photo"]["tmp_name"]);
							if($check !== false) {
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
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" ) {
							echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
							$uploadOk = 0;
						}
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
							echo "Sorry, your file was not uploaded.";
						// if everything is ok, try to upload file
						} 
						else {
							if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
								$file = basename( $_FILES["photo"]["name"]);
								//echo "The file ". $file. " has been uploaded.";
								$sql = "UPDATE space SET `photo`='$file' WHERE `sid`='$sid'";
								$retval = mysqli_query($conn,$sql);
								if(!$retval ){
									die('Could not update data: ' . mysqli_error($conn));
								}
								else{
									header('Location: ../spaceprofile.php?sid='.$sid);
								}
							} else {
								echo "Sorry, there was an error uploading your file.";
							}
						}
					}
					else{
						header('Location: ../spaceprofile.php?sid='.$sid);
					}
				}
			}else{
				echo "Missing fields";
			}
			
		}			
?>