<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Configure Product</h1>

        <br />
                
                <!-- Displaying Product Notification -->
                <a href="<?php echo SITEURL; ?>admin/add-product.php" class="button">Add Product</a>

                <br />
                <br />

                <?php
                    if(isset($_SESSION['add'])) //Notifies Product is added
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])) //Notifies Product is deleted
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload'])) //Notifies Product image is uploaded
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorize'])) //Notifies if Product image cannot be accessed
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }
                    if(isset($_SESSION['update'])) //Notifies Product is updated
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload'])) //Notifies Product Image is uploaded
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

               

                ?>
                <!-- Displaying Product Notification end -->

                <!-- Displaying Product Information -->
                <table class="admin">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active_Status</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM table_products";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);

                        $sn=1;

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active_status = $row['active_status'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $title; ?></td>
                                        <td>$<?php echo $price; ?></td>
                                        <td>
                                            <?php 
                                                if($image_name=="")
                                                {
                                                    echo "<div class='incorrect'>Image does not exist.</div>";
                                                }
                                                else
                                                {
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>image/product-img/<?php echo $image_name; ?>" width="250px">
                                                    <?php
                                                } 
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active_status; ?></td> 
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/product-update.php?id=<?php echo $id; ?>" class="button-update">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="button-delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr> <td colspan='7' class='incorrect'>No Product Added.</td> </tr>";
                        }
                    ?>
                    

                </table>
                <!-- Displaying Product Information end -->
    </div>
</div>

<?php include('partials/footer.php'); ?>