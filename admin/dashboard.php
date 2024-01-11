
<?php

    require('inc/essential.php');
    require('inc/db_config.php');
    adminLogin();

//     session_regenerate_id(true);  // it is use to remove past session but will save past data and
//                                   // create new session id 
//         // IF WE WANT TO SEE REGENERATED ID THEN GOTO inspectadminpage ->Application -> cookies ->http://localhost
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> dashboard </title>

    <?php  require('inc/links.php'); ?>

</head>
<body class='bg-light'>

   <?php 
        require("inc/header.php");

        $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings` "));

        $current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(CASE WHEN booking_status='success' THEN 1 END) AS `new_bookings`
        FROM `booking_order` "));


        $unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count` 
            FROM `user_queries` WHERE `seen`=0 "));

        $verified_query = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(id) AS `verify_query` FROM `user_cred` WHERE `is_verified` = 1"));



        // $unread_reviews = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count` 
        //     FROM `rating_review` WHERE `seen`=0 "));

        $total_amt =  mysqli_fetch_assoc(mysqli_query($con,'SELECT SUM(trans_amt) AS t_amt FROM `booking_order` '));

        $total_book = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(booking_id) AS booking FROM `booking_order`"));


        $total_userquery = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS t_query FROM `user_queries`"));


        $current_users = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(id) AS `total`,
        COUNT(CASE WHEN `is_verified` = 0 THEN 1 END) AS `active`
        FROM `user_cred` "));


    ?>


    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3> DASHBOARD </h3>

                    <?php 
                        if($is_shutdown['shutdown'])
                        {
                            echo<<<data
                                <h6 class="badge bg-danger py-2 px-3 rounded">Shutdown Mode is Active!</h6>
                            data;
                        }
                    ?>
                </div>
               
                <div class="row mb-4">
                    <div class="col-md-3 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center text-success p-3">
                                <h6>New Bookings</h6>
                                <h1 class="mt-2 mb-0"><?php echo $current_bookings['new_bookings'] ?></h1>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="user_queries.php" class="text-decoration-none">
                            <div class="card text-center text-info p-3">
                                <h6>User Queries</h6>
                                <h1 class="mt-2 mb-0"><?php echo $unread_queries['count'] ?></h1>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="user_queries.php" class="text-decoration-none">
                            <div class="card text-center text-info p-3">
                                <h6>Rating & Reviews</h6>
                                <h1 class="mt-2 mb-0">5</h1>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5> Total </h5>
                </div>


                <div class="row mb-4">
                    <div class="col-md-3 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center text-success p-3">
                                <h6>Total Booking</h6>
                                <h1 class="mt-2 mb-0"><?php echo $total_book['booking'] ?></h1>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card text-center text-info p-3">
                                <h6>Total Amount</h6>
                                <h1 class="mt-2 mb-0"><?php echo $total_amt['t_amt'] ?></h1>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="user_queries.php" class="text-decoration-none">
                            <div class="card text-center text-info p-3">
                                <h6>Total Queries</h6>
                                <h1 class="mt-2 mb-0"><?php echo $total_userquery['t_query'] ?></h1>
                            </div>
                        </a>
                    </div>
                </div>



                
                <h5> Users </h5>
                <div class="row mb-3">
                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-info p-3">
                            <h6> Total Users </h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_users['total'] ?></h1>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-success p-3">
                            <h6> Active Users </h6>
                            <h1 class="mt-2 mb-0"><?php echo $verified_query['verify_query']  ?></h1>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card text-center text-danger p-3">
                            <h6> Unverified Users </h6>
                            <h1 class="mt-2 mb-0"><?php echo  $current_users['active'] ?></h1>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <?php 

        require('inc/scripts.php');
    ?>

    <!-- <script src="scripts/dashboard.js"></script> -->
</body>
</html>