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
			<h2 class="text-center"> Groceries</h2>
			<?php
				$sql="SELECT * FROM table_grocery WHERE active_status='Yes'";
				$res= mysqli_query($conn,$sql);
				$count=mysqli_num_rows($res);
			
				if($count>0)
				{
					while($row=mysqli_fetch_assoc($res))
					{
						$id=$row['id'];
						$title=$row['title'];
						$image_name=$row['image_name'];

						if($title=="Meat") //Meat Products
						{
							?>
							<a href="meat.php">
								<div class="box-3 float-container">
									<?php
										if($image_name=="")
										{
											echo "<div class='error'>Image not Availabe</div>";
										}
										else
										{
											?>
												<img src="<?php echo SITEURL; ?>image/grocery-img/<?php echo $image_name; ?>" alt="tbone" class="img-resp img-curve" height="300">
											<?php
										}
									?>
									<h3 class="text-center"><?php echo $title; ?></h3>	
								</div>
							</a>
							<?php
						}
						if($title=="Fish") //Fish Products
						{
							?>
							<a href="seafood.php">
								<div class="box-3 float-container">
									<?php
										if($image_name=="")
										{
											echo "<div class='error'>Image not Availabe</div>";
										}
										else
										{
											?>
												<img src="<?php echo SITEURL; ?>image/grocery-img/<?php echo $image_name; ?>" alt="tbone" class="img-resp img-curve" height="300">
											<?php
										}
									?>
									<h3 class="text-center"><?php echo $title; ?></h3>
								</div>
							</a>
							<?php
						}
						if($title=="Alcohol & Beverages") //Alcohol & Beverages Products
						{
							?>
							<a href="bevs.php">
								<div class="box-3 float-container">
									<?php
										if($image_name=="")
										{
											echo "<div class='error'>Image not Availabe</div>";
										}
										else
										{
											?>
												<img src="<?php echo SITEURL; ?>image/grocery-img/<?php echo $image_name; ?>" alt="tbone" class="img-resp img-curve" height="300">
											<?php
										}
									?>
									<h3 class="text-center"><?php echo $title; ?></h3>
								</div>
							</a>
							<?php
						}
						if($title=="Essentials") // Essentials Products
						{
							?>
							<a href="essentials.php">
								<div class="box-3 float-container">
									<?php
										if($image_name=="")
										{
											echo "<div class='error'>Image not Availabe</div>";
										}
										else
										{
											?>
												<img src="<?php echo SITEURL; ?>image/grocery-img/<?php echo $image_name; ?>" alt="tbone" class="img-resp img-curve" height="300">
											<?php
										}
									?>
									<h3 class="text-center"><?php echo $title; ?></h3>
								</div>
							</a>
							<?php
						}
						if($title=="Health & Beauty") //Health & Beauty Products
						{
							?>
							<a href="beauty.php">
								<div class="box-3 float-container">
									<?php
										if($image_name=="")
										{
											echo "<div class='error'>Image not Availabe</div>";
										}
										else
										{
											?>
												<img src="<?php echo SITEURL; ?>image/grocery-img/<?php echo $image_name; ?>" alt="tbone" class="img-resp img-curve" height="300">
											<?php
										}
									?>
									<h3 class="text-center"><?php echo $title; ?></h3>
								</div>
							</a>
							<?php
						}
						
					}

				}
				else
				{
					echo"<div class='error>Grocery not Added</div>"; //Grocery is empty/No image
				}
			?>
			
			
	</section>
	<!--content end-->
	
	
	<?php include('partials-front/footer.php');?>