<?php
  require('connect.php');
  
  if (isset($_POST['submit_search'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    
    if ($username and $password and $repassword and $email and $fname and $lname) {
      if ($password == $repassword) {
        $raw_results = mysqli_query($conn,"SELECT username, email FROM users
                        WHERE username='".$username."' OR email='".$email."'");
        
        if (mysqli_num_rows($raw_results) == 0) {
          $sql = "INSERT INTO users (username, password, first, last, age, occupation, 
          photo, description, email, location, avescore) VALUES ('$username', '$password', 
          '$fname', '$lname', NULL, NULL, NULL, NULL, '$email', NULL, 0)";
          $retval = mysqli_query($conn, $sql);
          if (!$retval) {
            die('Could not enter data: ' . mysqli_error($conn));
          } else {
            header('Location: ../login.php');
            exit;
          }
        } else {
          echo "Username or email already exist";
        }
      } else {
        echo "Passwords don't match";
      }
    } else {
      echo "Missing fields";
    }
  }
?>




