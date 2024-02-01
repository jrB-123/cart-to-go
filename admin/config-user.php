<?php include('partials/menu.php'); ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Config User</h1>  
                <br />

                <?php
                    if(isset($_SESSION['add'])) 
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-does-not-exist']))
                    {
                        echo $_SESSION['user-does-not-exist'];
                        unset($_SESSION['user-does-not-exist']);
                    }

                    if(isset($_SESSION['pass-does-not-match']))
                    {
                        echo $_SESSION['pass-does-not-match'];
                        unset($_SESSION['pass-does-not-match']);
                    }

                    if(isset($_SESSION['change-pass']))
                    {
                        echo $_SESSION['change-pass'];
                        unset($_SESSION['change-pass']);
                    }
                ?>

                <br>

                <table class="admin">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM table_user";
                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE)
                        {
                            $count = mysqli_num_rows($res);
                            $sn=1;

                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $fullname=$rows['fullname'];
                                    $username=$rows['username'];

                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $fullname; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/delete-user.php?id=<?php echo $id; ?>" class="button-delete">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {

                            }
                        }
                    ?>

                </table>
            </div>
        </div>
        <!-- End Main Content -->

<?php include('partials/footer.php'); ?>