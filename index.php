<?php 
	include('partials-front/menu.php'); 
	
	if(isset($_SESSION['cart_order']))
	{
		echo $_SESSION['cart_order'];
		unset($_SESSION['cart_order']);
	}

	if(isset($_SESSION['contact']))
	{
		echo $_SESSION['contact'];
		unset($_SESSION['contact']);
	}
?>

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
			<h2 class="text-center"> Featured Groceries</h2>
			<?php
				if(isset($_SESSION['add']))
				{
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}
				
				$sql="SELECT * FROM table_grocery WHERE active_status='Yes' AND featured='Yes' Limit 3";
				$res= mysqli_query($conn,$sql);
				$count=mysqli_num_rows($res);
			
				if($count>0)
				{
					while($row=mysqli_fetch_assoc($res))
					{
						$id=$row['id'];
						$title=$row['title'];
						$image_name=$row['image_name'];

						if($title=="Meat")
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
						if($title=="Fish")
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
						if($title=="Alcohol & Beverages")
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
						if($title=="Essentials")
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
						if($title=="Health & Beauty")
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
					echo"<div class='error>Grocery not Added</div>";
				}
			?>
			

				




			
	</section>
	<section class="content">
		<div class="container">
			<h2 class="text-center"> Featured Products</h2>
			<?php
				$sql2="SELECT * FROM table_products WHERE active_status='Yes' AND featured='Yes' LIMIT 6";
				$res2= mysqli_query($conn,$sql2);
				$count2=mysqli_num_rows($res2);
			
				if($count2>0)
				{
					while($row=mysqli_fetch_assoc($res2))
					{
						$id=$row['id'];
						$title=$row['title'];
						$price=$row['price'];
						$description=$row['description'];
						$image_name=$row['image_name'];
						?>
				
					
						<div class="itembox">
							<div class="item-image">
								<?php
									if($image_name=="")
									{
										echo "<div class='error'>Image not Availabe</div>";
									}
									else
									{
										?>
											<img src="<?php echo SITEURL; ?>image/product-img/<?php echo $image_name; ?>" alt="tbone" class="img-resp img-curve" height="300">
										<?php
									}
								?>
							</div>

							<div class="item-desc">
								<h4><?php echo $title; ?></h4>
								<p class="price">$<?php echo $price;?></p>
								<p class="description"><?php echo $description;?></p>
								<br>
					
							</div>
						
							<div class="floatfix"></div>	
						</div>
						
						<?php
					}

				}
				else
				{
					echo"<div class='error>Grocery not Added</div>";
				}

				
			?>

		
		<div class="floatfix"></div>
	</section>
	
	<!--content end-->
	
	
	<?php include('partials-front/footer.php');?>