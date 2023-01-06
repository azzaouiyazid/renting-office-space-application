<?php 
include('controller/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SynergySpace</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>

<body>
	<section class="topper">
		<?php session_start(); ?>
		<?php require('header.php');?>
		<?php require('searchbar.php');?>
	</section>
	<!--example listings of places when you search for spaces --> 
	<section class="listings"> 
		<div class="wrapper">
			<ul class="properties_list">
			<?php
				

				$raw_results = mysqli_query($conn,"SELECT * FROM space LIMIT 30") or die(mysqli_error($conn));
						
				if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
				// return up to 30 random spaces
					while($results = mysqli_fetch_array($raw_results)){ 
						//output formatted results
						?>
						<li>
						<form action="spaceprofile.php" method="get">
						<button type="submit" name="sid" value="<?=$results['sid']?>">
							<img src="uploads/<?=$results['photo']?>" class="property_img"/>
							<span class='price'><?=$results['price']?></span>
							<div class='property_details'>
								<h1>
									<?=$results['name']?>
								</h1>
								<h3>
									Score: <?=$results['score']?>
								</h3>
							</div> 
						</button>
						</form>
						</li>
						<?php }			 
					}
				else{ // if there is no spaces
					echo "No results";
				}	
			?>
			</ul>
		</div>
	</section>	<!--  end listing section  -->

	<?php require('footer.html');?>
</body>
</html>