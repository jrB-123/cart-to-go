<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br />

            <!-- Getting Admin Details from sql -->
            <?php 
                $id=$_GET['id'];
                $sql="SELECT * FROM table_admin WHERE id=$id";
                $res=mysqli_query($conn, $sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);
                    
                    if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $fullname = $row['fullname'];
                        $username = $row['username']; 
                    }
                    else
                    {
                        header('location'.SITEURL.'admin/config-admin.php');
                    }
                }
            ?>
            <!-- Getting Admin Details from sql end -->

            <!-- Updating Admin Details -->
            <form action="" method="POST">
                <table class="add-admin">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="fullname" value="<?php echo $fullname; ?>"></td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="button">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Updating Admin Details end -->
        </div>
    </div>  

    <!-- Passing Updated Admin Details to sql -->
    <?php
        if(isset($_POST['submit']))
        {
            echo $id = $_POST['id'];
            echo $fullname = $_POST['fullname'];
            echo $username = $_POST['username'];

            $sql = "UPDATE table_admin SET fullname = '$fullname', username = '$username' WHERE id='$id'";

            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                $_SESSION['update'] = "<div class='correct'>Successfully Updated.</div>"; //Admin is updated
                header('location:'.SITEURL.'admin/config-admin.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='incorrect'>Unable to Update.</div>"; //Admin is not updated
                header('location'.SITEURL.'admin/config-admin.php');
            }
        }
    ?>
    <!-- Passing Updated Admin Details to sql end-->

<?php include('partials/footer.php'); ?>