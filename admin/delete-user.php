<!-- Delete User Account -->
<?php 
    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM table_user WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='correct'>Successfully Deleted.</div>"; //User Deleted
        header('location:'.SITEURL.'admin/config-user.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='incorrect'>Error, Try Again.</div>"; //User not Deleted
        header('location:'.SITEURL.'admin/config-user.php');
    }
?>
<!-- Delete User Account end -->