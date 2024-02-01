<?php include('partials-front/menu.php');?>
	
	<!--searchbar-->
	<section class = "searchtext searchbar">
		<div class = "container">
			<!--Logo-->
			<section class = "logo logoalign">
				<div class = "container">
				</div>
			</section>
			<!--Logo-->

			<br />

			<h2 class="text-center"> Cart-to-Go </h2>
			<form action = "<?php echo SITEURL; ?>search.php" method="POST">
				<input type ="search" name="search" placeholder="search for item..." required> 
				<input type ="submit" name="submit" value="Search" class="btn btn-primary">
			</form>
		</div>
	</section>
	<!--searchbar end-->
	
	
	<!--content-->
	<section class="content">
		<div class="container">
			<div class="aboutus">
			<h2>About us</h2>

			<p>During the year 2020, COVID-19 was rapidly spreading around the world. With the rapid increase of the cases of coronavirus here in the Philippines,<br>
			the government had to impose a strict community quarantine, especially those areas with high cases. The imposition of quarantine resulted to alternative<br>
			methods with regards to the daily and regular activities people do.<br><br>
			Living in the age of technology and social media, Cart-to-Go is an online grocery store designed to make the process of grocery shopping easier for the<br>
			 people staying at home. Just like your typical grocery, Cart-to-Go also offers loads of products that are segregated into different departments. Through <br>
			 this process, one can have an easier time in looking for their desired item with just a push of a button.
		
			</p>
			
			</div>
		</div>
	</section>
	<!--content end-->
	
	<?php include('partials-front/footer.php');?>