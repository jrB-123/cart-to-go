<?php include('partials/menu.php'); ?>

    <!-- Change Admin Password -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Password</h1>

            <br />

            <?php
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                } 
            ?>

            <form action="" method="POST">
                <table class="add-admin">
                    <tr>
                        <td>Old Password: </td>
                        <td>
                            <input type="password" name="old_pass" placeholder="Old Password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="password" name="new_pass" placeholder="New Password">
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="confirm_pass" placeholder="Confirm Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- Change Admin Password end -->
    
    <!-- Replace Admin Password from table_admin -->
    <?php
        if(isset($_POST['submit']))
        {
            $id=$_POST['id'];
            $old_pass = md5($_POST['old_pass']);
            $new_pass = md5($_POST['new_pass']);
            $confirm_pass = md5($_POST['confirm_pass']);

            $sql = "SELECT * FROM table_admin WHERE id=$id AND password='$old_pass'";
            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    if($new_pass==$confirm_pass)
                    {
                        $sql2 = "UPDATE table_admin SET password='$new_pass' WHERE id=$id";
                        $res2 = mysqli_query($conn, $sql2);
                        
                        if($res2==true)
                        {
                            $_SESSION['change-pass'] = "<div class='correct'>Password Updated Successfully.</div>";
                            header('location:'.SITEURL.'admin/config-admin.php');
                        }
                        else
                        {
                            $_SESSION['change-pass'] = "<div class='incorrect'>Password not Updated.</div>";
                            header('location:'.SITEURL.'admin/config-admin.php');
                        }
                    }
                    else
                    {
                        $_SESSION['pass-does-not-match'] = "<div class='incorrect'>Password does not match.</div>";
                        header('location:'.SITEURL.'admin/config-admin.php');
                    }
                }
                else
                {
                    $_SESSION['user-does-not-exist'] = "<div class='incorrect'>User does not exist.</div>";
                    header('location:'.SITEURL.'admin/config-admin.php');
                }
            }
        }
    ?>
    <!-- Replace Admin Password from table_admin end -->

<?php include('partials/footer.php'); ?>