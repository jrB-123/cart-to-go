<!-- Sends user to sign-in page when logout -->
<?php
    include('../config/constants.php');
    session_destroy();

    header('location:'.SITEURL.'admin/admin-verify.php');
?>
<!-- Sends user to sign-in page when logout end -->