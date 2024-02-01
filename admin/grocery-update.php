<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Grocery</h1>

            <br />

            <!-- Retrieve Grocery Information from table_grocery sql -->
            <?php
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM table_grocery WHERE id=$id";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $prev_img = $row['image_name'];
                        $featured = $row['featured'];
                        $active_status = $row['active_status'];
                    }
                    else
                    {
                        $_SESSION['error-grocery'] = "<div class='incorrect'>Grocery does not exist.</div>";
                        header('location:'.SITEURL.'admin/config-grocery.php');
                    }


                }
                else
                {
                    header('location:'.SITEURL.'admin/config-grocery.php');
                }
            ?>
            <!-- Retrieve Grocery Information from table_grocery sql end -->

            <!-- Update Grocery Information -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="admin">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Previous Image: </td>
                        <td>
                            <?php
                                if($prev_img != "")
                                {
                                    ?>
                                        <img src="<?php echo SITEURL; ?>image/grocery-img/<?php echo $prev_img; ?>" width="500px" height="300px">
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
                            <input type="file" name="img">
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
                        <td>Active Status: </td>
                        <td>
                            <input <?php if($active_status=="Yes"){echo "checked";} ?> type="radio" name="active_status" value="Yes"> Yes
                            <input <?php if($active_status=="No"){echo "checked";} ?> type="radio" name="active_status" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="prev_img" value="<?php echo $prev_img; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Grocery" class="button">    
                        </td>
                    </tr>

                </table>
            </form>
            <!-- Update Grocery Information end -->

            <!-- Passing Updated Grocery Information to table_grocery sql -->
            <?php
                if(isset($_POST['submit']))
                {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $prev_img = $_POST['prev_img'];
                    $featured = $_POST['featured'];
                    $active_status = $_POST['active_status'];

                    if(isset($_FILES['img']['name']))
                    {
                        $image_name = $_FILES['img']['name'];

                        if($image_name != "")
                        {
                            $ext = end(explode('.', $image_name));
                            $image_name = "grocery_name_".rand(000, 999).'.'.$ext;

                            $source_file = $_FILES['img']['tmp_name']; 

                            $dest_file = "../image/grocery-img/".$image_name;
                            $file_upload = move_uploaded_file($source_file, $dest_file); //Upload Image to image folder

                            if($file_upload==false)
                            {
                                $_SESSION['file_upload'] = "<div class='incorrect'>Error, cannot upload image.</div>"; //Image does not exist
                                header('location:'.SITEURL.'admin/config-grocery.php');
                                die();
                            }

                            if($prev_img != "")
                            {
                                $rem_path = "../image/grocery-img/".$prev_img;
                                $remove = unlink($rem_path);

                                if($remove==false)
                                {
                                    $_SESSION['error-img-update'] = "<div class='incorrect'>Error, Try Again.</div>"; //Previous Image does not exist
                                    header('location:'.SITEURL.'admin/config-grocery.php');
                                    die();
                                }
                            }

                        }
                        else
                        {
                            $image_name = $prev_img;
                        }
                    }
                    else
                    {
                        $image_name = $prev_img;
                    }

                    $sql2 = "UPDATE table_grocery SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active_status = '$active_status'
                        WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        $_SESSION['update'] = "<div class='correct'>Grocery Updated Successfully</div>"; //Grocery Updated
                        header('location:'.SITEURL.'admin/config-grocery.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='incorrect'>Grocery Failed To Update.</div>"; //Grocery not Updated
                        header('location:'.SITEURL.'admin/config-grocery.php');
                    }
                }
            ?>
            <!-- Passing Updated Grocery Information to table_grocery sql end -->

        </div>
    </div>

<?php include('partials/footer.php'); ?>