<?php include('../config/constants.php'); ?>

<!--  Admin sign-in -->
<html>
    <head>
        <title>Login - Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>

            <br />

            <?php
                if(isset($_SESSION['login'])) //
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-authorize']))
                {
                    echo $_SESSION['no-authorize'];
                    unset($_SESSION['no-authorize']);
                }
            ?>

            <br />

            <form action="" method="POST" class="text-center">
                <br />
                Username:
                <input type="text" name="username" placeholder="Enter Username">
                <br />
                <br />
                Password:
                <input type="password" name="password" placeholder="Enter Password">
                <br />
                <br />

                <input type="submit" name="submit" value="Login" class="button">
                <br />
                <br />
            </form>

            <p class="text-center">Cart-To-Go</p>
        </div>
    </body>
</html>
<!-- Admin sign-in end -->

<!-- Checking sql if information matches in table_admin -->
<?php

    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM table_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='correct'>Login Successful.</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='incorrect text-center'>Login Not Successful.</div>";
            header('location:'.SITEURL.'admin/admin-verify.php');
        }
    }

?>
<!-- Checking sql if information matches in table_admin end-->