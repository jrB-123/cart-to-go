<?php include('partials/menu.php'); ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Summary</h1>   

                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    ?>      

                <br />

                <div class="column text-center">
                    
                    <?php
                        $sql = "SELECT * FROM table_grocery";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Groceries
                </div>

                <div class="column text-center">

                    <?php
                        $sql2 = "SELECT * FROM table_products";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Products
                </div>

                <div class="column text-center">
                    
                    <?php
                        $sql3 = "SELECT * FROM table_order";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Orders
                </div>

                <div class="column2 text-center">
                    
                    <?php
                        $sql4 = "SELECT * FROM table_admin";
                        $res4 = mysqli_query($conn, $sql4);
                        $count4 = mysqli_num_rows($res4);
                    ?>

                    <h1><?php echo $count4; ?></h1>
                    <br />
                    Admin
                </div>

                <div class="column2 text-center">
                    
                    <?php
                        $sql5 = "SELECT * FROM table_user";
                        $res5 = mysqli_query($conn, $sql5);
                        $count5 = mysqli_num_rows($res5);
                    ?>

                    <h1><?php echo $count5; ?></h1>
                    <br />
                    User
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- End Main Content -->

<?php include('partials/footer.php'); ?>