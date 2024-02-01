<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Configure Grocery</h1>

        <br />

            <!-- Grocery Notification changes -->
            <?php
                if(isset($_SESSION['add'])) //Notifies if grocery is added
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['remove'])) //Notifies if grocery image is unavailable
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['delete'])) //Notifies if grocery is deleted
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['error-grocery'])) //Notifies if grocery image is unavailable
                {
                    echo $_SESSION['error-grocery'];
                    unset($_SESSION['error-grocery']);
                }

                if(isset($_SESSION['update'])) //Notifies if grocery is updated
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['file_upload'])) //Notifies if image is uploaded or not 
                {
                    echo $_SESSION['file_upload'];
                    unset($_SESSION['file_upload']);
                }

                if(isset($_SESSION['error-img-update'])) //Notifies if grocery image is unavailable
                {
                    echo $_SESSION['error-img-update'];
                    unset($_SESSION['error-img-update']);
                }
            ?> 
            <!-- Grocery Notification changes end -->

            <br />
                
                <!-- Displaying Grocery Information -->
                <a href="<?php echo SITEURL; ?>admin/add-grocery.php" class="button">Add Grocery</a>

                <br />
                <br />

                <table class="admin">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image/Name</th>
                        <th>Feature</th>
                        <th>Active Status</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM table_grocery";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active_status = $row['active_status'];

                                ?>
                                     <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>

                                        <td>
                                            <?php
                                                if($image_name!="")
                                                {
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>image/grocery-img/<?php echo $image_name; ?>" width="500px" height="300px">
                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "<div class='incorrect'>Pls insert image.</div>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active_status; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/grocery-update.php?id=<?php echo $id; ?>" class="button-update">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-grocery.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="button-delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td colspan="2">
                                        <div class="incorrect">Empty Category.</div>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>

                </table>
                <!-- Displaying Grocery Information end -->
    </div>
</div>

<?php include('partials/footer.php'); ?>