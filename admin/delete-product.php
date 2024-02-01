<!-- Delete Product -->
<?php
    include('../config/constants.php');
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $GET['image_name'];

        if($image_name != "")
        {
            $path = "../image/product-img/".$iamge_name;

            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Product</div>";
                header('location:'.SITEURL.'admin/config-product.php');
                die();
            }

        }
        $sql = "DELETE FROM table_products WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete']="<div class='success'>Product Deleted Successfully</div>"; //Product Deleted
            header('location:'.SITEURL.'admin/config-product.php');
        }
        else
        {
            $_SESSION['delete']="<div class='error'>Failed to Delete Product</div>"; //Product not Deleted
            header('location:'.SITEURL.'admin/config-product.php');
        }
    }
    else
    {
        $_SESSION['unauthorize'] = "<div class='error> Unauthorized Access.</div>"; //Product image does not exist
        header('location'.SITEURL.'admin/config-product.php');
    }
?>
<!-- Delete Product end -->