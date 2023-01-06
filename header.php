<!DOCTYPE html>
<html lang="en">
	<header>
		<div class="wrapper">
			<a href="#" class="hamburger"></a>
			<nav>
				<ul>
				<?php
				if (isset($_SESSION['username'])){ //displays profile options only if user is logged in
				?>
					<li><a href="profile.php?u=<?=$_SESSION['username']?>">Profile</a></li>
				<?php } ?>
					<li><a href="listings.php">Search Spaces</a></li>
				<?php
				if (isset($_SESSION['username'])){ //displays list a space option only if user is logged in?>
					<li><a href="createspace.php">List a Space</a></li>
				<?php } ?>
				</ul>
				
				<?php

				if (isset($_SESSION['username'])){ ?> <!-- if the user is logged in 'Logout' appear in the header-->
					<a href="controller/logout.php" class="login_btn">Logout</a>
				<?php }else{ ?> <!-- if the user is logged out or doesn't have an account 'Login' and 'Register' appear in the header -->
					<a href="login.php" class="login_btn">Login</a>
					<a href ="signup.php" class = "login_btn"> Register </a>
				<?php } ?>
			</nav>
		</div>
	</header><!--  end header section  -->
</html>
