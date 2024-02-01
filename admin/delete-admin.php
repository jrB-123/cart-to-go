<!-- Delete Admin -->
<?php 
    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM table_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='correct'>Successfully Deleted.</div>"; //Admin is deleted
        header('location:'.SITEURL.'admin/config-admin.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='incorrect'>Error, Try Again.</div>"; //Admin is not deleted
        header('location:'.SITEURL.'admin/config-admin.php');
    }
?>
<!-- Delete Admin end -->