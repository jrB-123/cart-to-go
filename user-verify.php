<?php include('partials-front/menu.php'); ?>

<html>
    <head>
        <title>Login - User</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>

            <br />

            <?php
                

                if(isset($_SESSION['no-authorize']))
                {
                    echo $_SESSION['no-authorize'];
                    unset($_SESSION['no-authorize']);
                }

                if(isset($_SESSION['inform']))
                {
                    echo $_SESSION['inform'];
                    unset($_SESSION['inform']);
                }

                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
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
                
                <input type="submit" name="logout" value="Logout" class="button-delete">
                <br />
                <br />
            </form>

            <p class="text-center">Cart-To-Go</p>
        </div>
    </body>
</html>

<?php

    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM table_user WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='correct text-center'>You can now access Cart!</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'');
        }
        else
        {
            $_SESSION['login'] = "<div class='incorrect text-center'>Login Not Successful.</div>";
            header('location:'.SITEURL.'user-verify.php');
        }
    }

    if(isset($_POST['logout']))
    {
        if(!isset($_SESSION['user']))
        {
            $_SESSION['inform'] = "<div class='incorrect text-center'>No user to logout.</div>";
            header('location:'.SITEURL.'user-verify.php');
        }
        else
        {
            $_SESSION['inform'] = "<div class='correct text-center'>You have logout your account!</div>";
            header('location:'.SITEURL.'user-logout.php');
        }
    }

?>