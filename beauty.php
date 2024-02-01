<?php include('partials-front/menu.php');?>
<?php
        if(!isset($_SESSION['user']))
        {
            $_SESSION['no-authorize'] = "<div class='incorrect text-center'>Pls login to make delivery.</div>";
            header('location:'.SITEURL.'');
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
	<br><br>
	<section class="items">
	<div class="container">
	<h2 class="text-center">Health & Beauty Products</h2>
	<div class="navbar">
				<div class="menu">
					<ul>
						<li>
							<a href="meat.php">Meat</a>
						</li>
						<li>
							<a href="seafood.php">Seafood</a>
						</li>
						<li>
							<a href="bevs.php">Alcohol & Beverages</a>
						</li>
						<li>
							<a href="essentials.php">Essentials</a>
						</li>
						<li>
							<a href="beauty.php">Health & Beauty</a>
						</li>
					</ul>
				</div>
		</div>
		</section>

		<!-- Add to Cart -->		
		<?php 

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="beauty.php"</script>';
			}
		}
	}
}

?>
<!-- Add to Cart end -->

	<body>
		<br />
		<div class="container">
			<br />
			<br />
			<br />

			<br /><br />

			<!-- Display Products -->
			<?php
				$query = "SELECT * FROM table_products WHERE active_status='Yes' AND description='Health & Beauty' ";
				$result= mysqli_query($conn,$query);
				$count2=mysqli_num_rows($result);
				
				if($count2>0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="beauty.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="image/product-img/<?php echo $row["image_name"]; ?>" height="300" width="300"/><br />

						<h4 class="text-info"><?php echo $row["title"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["title"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="beauty.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
					<form action = "" method="POST" class="order">
					<fieldset>
					<div class="cart-label">Fullname</div>
                    <input type="text" name="fullname" placeholder="E.g. Last name, First Name" class="input-qty" required>

                    <div class="cart-label">Phone No.</div>
                    <input type="tel" name="contact" placeholder="+63...." class="input-qty" required>

                    <div class="cart-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. ....@gmail.com" class="input-qty" required>

                    <div class="cart-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street No., City/Province" class="input-qty" required></textarea>

                    <input type="submit" name="submit" value="Order" class="button">
                </fieldset>
			</form>
			<!-- Display Products -->

			<br>
			<br>
			<br>
			<h1>Cart (Cash on Delivery Only):</h1>

				</table>
				<?php echo '<a href="products.php?action=empty"><button class="btn btn-danger"><span class="glyphicon glyphi
				con-trash"></span> Empty Cart</button>'; ?>

				<!-- Create Order -->
				<?php
				if(isset($_GET["action"]))
				{
					if($_GET["action"] == "empty")
					{
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
						unset($_SESSION["shopping_cart"]);
						echo '<script>alert("Cart is made empty!")</script>';
						echo '<script>window.location="bevs.php"</script>';
						}
					}
				}
				?>
				<?php
                if(isset($_POST['submit']))
                {
                    $product = $values["item_name"];
                    $price = $values["item_price"];
                    $quantity = $values["item_quantity"];
                    $total = $price * $quantity;
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "Ordered";
                    $customer_name = $_POST['fullname'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
					$ordernum=rand(10000,99999);
					

                    $sql2 = "INSERT INTO table_order SET
                        product = '$product',
                        price = '$price',
                        quantity = '$quantity',
                        total = '$total',
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
						ordernum = '$ordernum'
                    ";

					$res2 = mysqli_query($conn, $sql2);
					echo '<script>alert("Food has been ordered")</script>';
					echo "<script type='text/javascript'>alert('Order Transaction Number: $ordernum');</script>";
					echo '<script>window.location="beauty.php"</script>';
					
                }
                ?>
				<!-- Create Order end -->
					
					
			</div>
		</div>
	</div>
	<br />
	</body>

<?php

?>
	
	<?php include('partials-front/footer.php');?>