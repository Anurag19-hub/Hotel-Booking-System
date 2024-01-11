<?php

    require('inc/essential.php');
    require('inc/db_config.php');
    adminLogin();  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bookings </title>

    <?php  
    
        require('inc/links.php');    
    ?>

</head>

<body class='bg-light'>

    <?php
    require("inc/header.php");
    $fea_q = mysqli_query($con,"SELECT * FROM `booking_order` as bo 
    INNER JOIN `user_cred` as users ON bo.user_id = users.id INNER JOIN `rooms` ON rooms.id = bo.room_id");
   ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 h-font"> Bookings </h3>

                <!-- Add Room SECTION -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th>Booking Id</th>
                                        <th>Order ID</th>
                                        <th>Transaction ID</th>
                                        <th>Room Name</th>
                                        <th>Total Price</th>
                                        <th>Check In Date</th>
                                        <th>Check Out Date</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                        <th>Create Date</th>
                                    </tr>
                                </thead>
                                <tbody id="booking_data">
                                    <?php while($fea_row =mysqli_fetch_assoc($fea_q)) { ?>
                                    <tr>
                                        <td><?php echo $fea_row['booking_id']; ?></td>
                                        <td><?php echo $fea_row['order_id']; ?></td>
                                        <td><?php echo $fea_row['trans_id']; ?></td>
                                        <td><?php echo $fea_row['name']; ?></td>
                                        <td>₹<?php echo $fea_row['trans_amt']; ?></td>
                                        <td><?php echo $fea_row['check_in']; ?></td>
                                        <td><?php echo $fea_row['check_out']; ?></td>
                                        <td><?php echo $fea_row['booking_status']; ?></td>
                                        <td><?php echo $fea_row['trans_status']; ?></td>
                                        <td><?php echo $fea_row['datentime']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>

</body>

</html>