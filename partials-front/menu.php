<?php 
	include('config/constants.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cart-to-Go</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<!--navbar-->
	<section class="container">
		<div class="navbar">
			<div class="menu">
				<ul>
					<li>
						<a href="<?php echo SITEURL; ?>">Home</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>aboutus.php">About</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>grocery.php">Groceries</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>products.php">Products</a>
					</li>
					<li>
						<a href="<?php echo SITEURL; ?>contactus.php">Contact Us</a>
					</li>
					<li>
					</li>
					<li>
					</li>
					<li>
					</li>
					
					<li>
						<a href="add-user.php">Signup</a>
					</li>
					<li>
						<a href="user-verify.php">Login/Logout</a>
					</li>

			
				</ul>
			</div>
		</div>
		<?php
			if(isset($_SESSION['no-authorize']))
			{
				echo $_SESSION['no-authorize'];
				unset($_SESSION['no-authorize']);
			}

			if(isset($_SESSION['login']))
			{
				echo $_SESSION['login'];
				unset($_SESSION['login']);
			}

			if(isset($_SESSION['inform']))
			{
				echo $_SESSION['inform'];
				unset($_SESSION['inform']);
			}

			
		?>
	</section>
	

	<!--navbar end-->