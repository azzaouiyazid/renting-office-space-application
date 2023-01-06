<!-- Search bar -->
	<section class="search">
		<div class="wrapper">
			<form action="searchresults.php" method="post">
				<input type="text" id="search" name="search" placeholder="What are you looking for?" autocomplete="off"/>
				<input type="submit" id="submit_search" name="submit_search" class="submit_" value="go"/>
			</form>
			<a href="#" class="advanced_search_icon" id="advanced_search_btn"></a>
			
		</div>
		<div class="advanced_search">
			<div class="wrapper">
				<span class="arrow"></span>
				<form action="advancedsearchresults.php" method="post">		
					<div class="search_fields">
						<input type="text" id="keywords" name="city" placeholder="City" autocomplete="off"/>
						<hr class="field_sep float"/>
						<input type="number" min="0" class="float" id="min_price" name="min_price" placeholder="Min. Price"  autocomplete="off">
						<hr class="field_sep float"/>
						<input type="number" min="0" class="float" id="max_price" name="max_price" placeholder="Max. price"  autocomplete="off">
					</div>
					<input type="number" min="0" max="10" id="keywords" name="rating" placeholder="Min. Rating"  autocomplete="off">
					<input type="submit" id="submit_search" name="submit_search"/>
				</form>
			</div>
		</div>
	</section>

