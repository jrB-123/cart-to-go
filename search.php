<?php include('partials-front/menu.php'); ?>

    <section class="searchtext searchbar">
        <div class="container">

            <?php
                $search = $_POST['search'];
            ?>
            <!--Logo-->
			<section class = "logo logoalign">
				<div class = "container">
				</div>
			</section>
			<!--Logo-->
            <h2>Searching: <a href="#">"<?php echo $search; ?>"</a></h2>

        </div>  
    </section>

    <section class="content">
		<div class="container">
			<h2 class="text-center"> Search Results</h2>

            <?php
                $sql = "SELECT * FROM table_products WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        
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
                        
                                    <?php
                                        if($description=='Meat')
                                        {
                                            ?>
                                                <a href="<?php echo SITEURL; ?>meat.php" class="btn btn-primary">Meat Grocery</a>
                                            <?php
                                        }

                                        if($description=='Fish')
                                        {
                                            ?>
                                                <a href="<?php echo SITEURL; ?>seafood.php" class="btn btn-primary">Fish Grocery</a>
                                            <?php
                                        }

                                        if($description=='Alcohol & Beverages')
                                        {
                                            ?>
                                                <a href="<?php echo SITEURL; ?>bevs.php" class="btn btn-primary">Alcohol & Beverages Grocery</a>
                                            <?php
                                        }

                                        if($description=='Essentials')
                                        {
                                            ?>
                                                <a href="<?php echo SITEURL; ?>essentials.php" class="btn btn-primary">Essentials Grocery</a>
                                            <?php
                                        }

                                        if($description=='Health & Beauty')
                                        {
                                            ?>
                                                <a href="<?php echo SITEURL; ?>beauty.php" class="btn btn-primary">Health & Beauty Grocery</a>
                                            <?php
                                        }
                                        
                                    ?>

                                </div>
						
							    <div class="floatfix"></div>	
						    </div>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='incorrect'>Product not found.</div>";
                }
            ?>
            <div class="floatfix"></div>

        </div>
    </section>

<?php include('partials-front/footer.php'); ?>