<?php
    if(!isset($_SESSION['user'])) //If admin account has not sign-in
    {
        $_SESSION['no-authorize'] = "<div class='incorrect text-center'>Authorized Access Admin user is required.</div>";
        header('location:'.SITEURL.'admin/admin-verify.php'); //Sends user to admin sign-in
    }
?>