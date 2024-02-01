<?php include('partials-front/menu.php'); ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Add User</h1>

            <br />

            <!-- Sign-up Notification -->
            <?php 
                if(isset($_SESSION['add'])) //Notifies if user has sign-up
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <!-- Sign-up Notification end -->

            <!-- Input Sign-up Information -->
            <form action="" method="POST">
                <table class="add-admin">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="fullname" placeholder="Enter Fullname"> </td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Enter Username"> </td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Enter Password"> </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add User" class="button">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Input Sign-up Information end -->
        </div>
    </div>

<?php include('partials-front/footer.php'); ?>

<!-- Pass sign-up Information to table_user -->
<?php
    if(isset($_POST["submit"]))
    {
       $full_name = $_POST['fullname'];
       $username = $_POST['username'];
       $password = md5($_POST['password']);
       
       $sql = "INSERT INTO table_user SET
        fullname='$full_name',
        username='$username',
        password='$password'
       ";

       $res = mysqli_query($conn, $sql) or die(mysqli_error());

       if($res==TRUE)
       {
           $_SESSION['add'] = "Admin Added";
           header("location:".SITEURL.'');
       }
       else
       {
           $_SESSION['add'] = "Add Admin Failed";
           header("location:".SITEURL.'add-user.php');
       }
    }
?>
<!-- Pass sign-up Information to table_user end -->

