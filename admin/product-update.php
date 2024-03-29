<?php include('partials/menu.php'); ?>


 <!-- Get Product Information in table_product -->
<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM table_products WHERE id=$id";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image=$row2['image_name'];
        $current_category=$row2['category_id'];
        $featured = $row2['featured'];
        $active_status = $row2['active_status'];
    }
    else
    {
        header('location'.SITEURL.'admin/config-product.php');
    }              
?>
 <!-- Get Product Information in table_product end -->

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Product</h1>

            <br><br />

             <!-- Update Product Information -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="admin">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image != "")
                                {
                                    ?>
                                        <img src="<?php echo SITEURL; ?>image/product-img/<?php echo $current_image; ?>" width="500px" height="300px">
                                    <?php
                                }
                                else
                                {
                                    echo "<div class='incorrect'>Pls insert image first.</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                <?php
                                    $sql= "SELECT * FROM table_grocery WHERE active_status='YES'";
                                    $res= mysqli_query($conn, $sql);
                                    $count= mysqli_num_rows($res);

                                    if($count>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res)) //Get only Grocery with active_status="YES"
                                        {
                                            $category_title = $row['title'];
                                            $category_id = $row['id']

                                            //echo "<option value='$category_id'>$category_title</option>";
                                            ?>
                                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php

                                        }
                                    }
                                    else
                                    {
                                        echo "<option value='0'>Category Not Available.</option";
                                    }
                                
                                ?>
                                <option value="0"></option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active_status=="Yes"){echo "checked";} ?> type="radio" name="active_status" value="Yes"> Yes
                            <input <?php if($active_status=="No"){echo "checked";} ?> type="radio" name="active_status" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Product Update" class="button">
                        </td>
                    </tr>

                </table>
            </form>
            <!-- Update Product Information end -->

            <!-- Passing Updated Product Information to table_product sql -->
            <?php
                if(isset($_POST['submit']))
                {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active_status = $_POST['active_status'];

                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];
                        if($image_name!="")
                        {
                            $ext=end(explode('.', $image_name));
                            $image_name = "product_name_".rand(000, 999).'.'.$ext;

                            $src_file = $_FILES['image']['tmp_name'];
                            $dest_file = "../image/product-img/".$image_name;

                            $upload = move_uploaded_file($src_file, $dest_file);

                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class ='error'>Failed to Upload new Image. </div>";
                                header('location:'.SITEURL.'admin/config-product.php');
                                die();
                            }

                            if($current_image!="")
                            {
                                $remove_path = "../image/product-img/".$current_image;
                                $remove=unlink($remove_path);
                                if($remove==false) 
                                {
                                    $_SESSION['remove-failed']= "<div class='error'>Failed to remove the current image. </div>";
                                    header('location:'.SITEURL.'admin/config-product.php');
                                    die();
                                }
                            }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                    $sql3 = "UPDATE table_products SET
                        title= '$title',
                        description='$description',
                        price =$price,
                        image_name ='$image_name',
                        category_id='$category',
                        featured='$featured',
                        active_status='$active_status'
                        WHERE id=$id";
                    
                    $res3 = mysqli_query($conn, $sql3);
                    if($res3==true)
                    {
                        $_SESSION['update']= "<div class='success'>Product Updated Successfully.</div>";
                        header('location:'.SITEURL.'admin/config-product.php');
                    }
                    else
                    {
                        $_SESSION['update']= "<div class='error'>Failed to Update Food.</div>";
                        header('location:'.SITEURL.'admin/config-product.php');
                    }

                    
                }
            ?>
            <!-- Passing Updated Product Information to table_product sql -->
            
            <div>
            </div>


 <?php include('partials/footer.php'); ?>