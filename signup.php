<!DOCTYPE html>
<html lang="en">
<head>
	<title>SynergySpace</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/formpages.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	
</head>
<body>

	<section class="topper">
		<?php require('header.php');?>
		<section class="logform">
			<div class="wrapper">
				<h1>Signup</h1>
				<form action="controller/makeaccount.php" method="post">
					<div class="search_fields">
						<hr class="form_horiz"/>
						<input type="text" class="float" id="logform" name="email" placeholder="Email"  autocomplete="off" required>
						<hr class="form_vert"/>
						<input type="text" class="float" id="logform" name="username" placeholder="Username"  autocomplete="off" required>
						<hr class="form_horiz"/>
						<input type="password" class="float" id="logform" name="password" placeholder="Password"  autocomplete="off" required>
						<hr class="form_vert"/>
						<input type="password" class="float" id="logform" name="repassword" placeholder="Retype Password"  autocomplete="off" required>					
						<hr class="form_horiz"/>
						<input type="text" class="float" id="logform" name="fname" placeholder="First Name"  autocomplete="off" required>
						<hr class="form_vert"/>
						<input type="text" class="float" id="logform" name="lname" placeholder="Last Name"  autocomplete="off" required>									
					</div>
					<hr class="form_horiz"/>					
					<input type="submit" id="submit_search" class="form_button" name="submit_search" value="submit"/>
				</form>	
			</div>
		</section>	
<?php require('footer.html');?>
</body>	

</html>