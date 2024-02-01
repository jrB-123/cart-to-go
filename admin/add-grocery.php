<?php include('partials/menu.php'); ?>

    
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Grocery</h1>

            <br />

            <?php
                if(isset($_SESSION['add'])) //Notifies if grocery is added or not
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['file_upload'])) //Notifies if image is acceptable or not
                {
                    echo $_SESSION['file_upload'];
                    unset($_SESSION['file_upload']);
                }
            ?>

            <br />

            <!-- Adding Grocery Details -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="admin">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Add Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type='file' name='img'>
                        </td>
                    </tr>

                    <tr>
                        <td>Feature: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes 
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active Status: </td>
                        <td>
                            <input type="radio" name="active_status" value="Yes"> Yes
                            <input type="radio" name="active_status" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Grocery" class="button">    
                        </td>
                    </tr>

                </table>
            </form>
            <!-- Adding Grocery Details end -->

            <!-- Passing Grocery Details to sql -->
            <?php
                if(isset($_POST['submit']))
                {
                    $title = $_POST['title'];

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
                            $image_name = "grocery_name_".rand(000, 999).'.'.$ext;

                            $source_file = $_FILES['img']['tmp_name'];

                            $dest_file = "../image/grocery-img/".$image_name;
                            $file_upload = move_uploaded_file($source_file, $dest_file); //Image is created in image folder

                            if($file_upload==false)
                            {
                                $_SESSION['file_upload'] = "<div class='incorrect'>Error, cannot upload image.</div>"; //Image is not created
                                header('location:'.SITEURL.'admin/add-grocery.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name="";
                    }

                    $sql = "INSERT INTO table_grocery SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active_status='$active_status'
                    ";

                    $res = mysqli_query($conn, $sql);

                    if($res==true)
                    {
                        $_SESSION['add'] = "<div class='correct'>Added Successfully</div>"; //Grocery is added
                        header('location:'.SITEURL.'admin/config-grocery.php');
                    }
                    else
                    {
                        $_SESSION['add'] = "<div class='incorrect'>Error, cannot add grocery</div>"; //Grocery is not added
                        header('location:'.SITEURL.'admin/add-grocery.php');
                    }
                }
            ?>
            <!-- Passing Grocery Details end to sql -->
        </div>
    </div>
    
<?php include('partials/footer.php'); ?>