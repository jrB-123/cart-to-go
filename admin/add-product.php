<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Products</h1>

            <br />

            <?php
                if(isset($_SESSION['add'])) //Notifies if product is added
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload'])) //Notifies if image is acceptable or not
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <br />

            <!-- Adding Product Details  -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="admin">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Input Product Name">
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="50" rows="10" placeholder="Input Description Of Product"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" placeholder="Input Product Price">
                        </td>
                    </tr>

                    <tr>
                        <td>Image: </td>
                        <td>
                            <input type="file" name="img">
                        </td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category_id">
                                <?php
                                    $sql = "SELECT * FROM table_grocery WHERE active_status='Yes'";
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);

                                    if($count>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res)) //Fetch a category in table_grocery
                                        {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <option value="0">No Category Identified</option>
                                        <?php
                                    }
                                ?>
                                
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                            <td>
                                <input type="radio" name="featured" value="Yes"> Yes
                                <input type="radio" name="featured" value="No"> No
                            </td>
                        </td>
                    </tr>

                    <tr>
                        <td>Active Status: </td>
                            <td>
                                <input type="radio" name="active_status" value="Yes"> Yes
                                <input type="radio" name="active_status" value="No"> No
                            </td>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Product" class="button">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Adding Product Details end -->
            
            <!-- Passing Product Details to sql -->
            <?php
                if(isset($_POST['submit']))
                {
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category_id = $_POST['category_id'];

                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";
                    }

                    if(isset($_POST['active_status']))
                    {
                        $active_status = $_POST['active_status'];
                    }
                    else
                    {
                        $active_status = "No";
                    }

                    if(isset($_FILES['img']['name']))
                    {
                        $image_name = $_FILES['img']['name'];
                        
                        if($image_name != "")
                        {
                            $ext = end(explode('.', $image_name));
                            $image_name = "product_name_".rand(000, 999).'.'.$ext;

                            $source_file = $_FILES['img']['tmp_name'];

                            $dest_file = "../image/product-img/".$image_name;
                            $upload = move_uploaded_file($source_file, $dest_file); //Image is created in images folder

                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='incorrect'>Upload Failed.</div>"; //Image is not created
                                header('location:'.SITEURL.'admin/add-product.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name="";
                    }

                    $sql2 = "INSERT INTO table_products SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category_id,
                        featured = '$featured',
                        active_status = '$active_status'
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true)
                    {
                        $_SESSION['add'] = "<div class='correct'>Product Successfully Added.</div>"; //Product is added
                        header('location:'.SITEURL.'admin/config-product.php');
                    }
                    else
                    {
                        $_SESSION['add'] = "<div class='incorrect'>Product Failed to Add.</div>"; //Product is not added
                        header('location:'.SITEURL.'admin/config-product.php');
                    }
                }
                
            ?>
            <!-- Passing Product Details end to sql -->

        </div>
    </div>

<?php include('partials/footer.php'); ?>