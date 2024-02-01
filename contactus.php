<?php include('partials-front/menu.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cart-to-Go about</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.contactus{
	justify-content: center;
	width: 90%;
	max-width: 500px;
	margin: 0 auto;
	padding: 20px;
	background-color: white;
	border-radius: 8px;
	margin-bottom: 20px;
}
.contactus textarea, .contactus input, .contactus label{
	font-family: 'Century Gothic';
	width: 100%;
	padding: 10px;
	font-size: 18px;
}
button[type="Submit"]{
	width: 100%;
	border: none;
	outline: none;
	padding: 20px;
	font-size: 24px;
	border-radius: 8px;
	margin-top: 10px;
	cursor: pointer;
}
</style>
</head>

<body>	
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
				<div class="navbar">
			<h1 style="font-size:3vw" class="text-center">Contact us</h1>
				<br>
				<p style="font: size 7px" class="text-center">Email us at Cart-to-Go@gmail.com for further inquiries and questions. <br>
					We are more than happy to receive your feedback and answer your questions.<br>
					Follow us on instagram @Cart-to-Go.ph and like us on facebook @Cart-to-Go.ph
				</p>
				<br><br>

				<div class="contactus">
					<div class = "contactus textarea">
				
					<label for="Name">Name:</label>
					<input type="text" id="Name" name="Name">
				<br>
				<br>

				
				<label for="email">Email:</label>
				<input type="email" id="email" name="email">
				
				<br>
				<br>
					<label for="Feedback">Feedback:</label>
					<textarea name="Feedback" id="Feedback" cols="30" rows="10"></textarea>
				<br>
				<br>
			

				<form action="" method="POST" class="text-center">
				
					<input type="submit" name="submit" value="Login" class="button">
						
				</form>

				<?php
					if(isset($_POST['submit']))
					{
						$_SESSION['contact'] = "<div class='correct text-center'>Name and Email received!</div>";
						header('location:'.SITEURL);
					}
				?>

				</div>

				</div>


			</div>
			
			
				</div>
			<div class="floatfix"></div>
		</div>
		</div>
	</section>
	<!--content end-->
	
	<!--footer-->
	<?php include('partials-front/footer.php'); ?>
	<!--footer end-->
		
</body>
</html>