<?php include('partials/menu.php'); ?>

    <!-- Adding Admin Details -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>

            <br />

            <?php 
                if(isset($_SESSION['add'])) //Notifies if admin is added or not
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>

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
                            <input type="submit" name="h" value="Add Admin" class="button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- Adding Admin Details end -->

<?php include('partials/footer.php'); ?>

<!-- Passing Admin Details to sql-->
<?php
    if(isset($_POST["h"]))
    {
       $full_name = $_POST['fullname'];
       $username = $_POST['username'];
       $password = md5($_POST['password']);
       
       $sql = "INSERT INTO table_admin SET 
        fullname='$full_name',
        username='$username',
        password='$password'
       ";

       $res = mysqli_query($conn, $sql) or die(mysqli_error());

       if($res==TRUE)
       {
           $_SESSION['add'] = "Admin Added"; //Admin is added
           header("location:".SITEURL.'admin/config-admin.php'); 
       }
       else
       {
           $_SESSION['add'] = "Add Admin Failed"; //Admin is not added
           header("location:".SITEURL.'admin/add-admin.php');
       }
    }
?>
<!-- Passing Admin Details to sql end -->