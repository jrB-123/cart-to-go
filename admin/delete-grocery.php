<!-- Delete Grocery -->
<?php
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../image/grocery-img/".$image_name;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='incorrect'>Error, image file does not exist.</div>";
                header('location:'.SITEURL.'admin/config-grocery.php');
                die();
            }
        }

        $sql = "DELETE FROM table_grocery WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='correct'>Grocery Successfully Removed.</div>"; //Grocery Deleted
            header('location:'.SITEURL.'admin/config-grocery.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='incorrect'>Grocery Cannot Be Removed.</div>"; //Grocery not Deleted
            header('location:'.SITEURL.'admin/config-grocery.php');
        }

    }
    else
    {
        header('location:'.SITEURL.'admin/config-grocery.php'); //Grocery Image does not exist
    }
?>
<!-- Delete Grocery end -->