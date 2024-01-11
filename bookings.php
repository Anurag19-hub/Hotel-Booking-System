<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Bookings </title>


    <?php require('main/links.php') ?>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- SWIPERJS library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />


</head>

<body class="bg-light">
    <!-- This file contains header or navigation -->
    <?php
        require('main/header.php');  
    
        $user_id = $_SESSION['uId'];

        // echo "SELECT * FROM `booking_order` as bo 
        // INNER JOIN `user_cred` as users ON bo.user_id = users.id INNER JOIN `rooms` ON rooms.id = bo.room_id WHERE bo.user_id = '$user_id'";exit;
         $fea_q = mysqli_query($con,"SELECT * FROM `booking_order` as bo 
        INNER JOIN `user_cred` as users ON bo.user_id = users.id INNER JOIN `rooms` ON rooms.id = bo.room_id WHERE bo.user_id = '$user_id'");
        // $guests_res = mysqli_fetch_assoc($fea_q);
    
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center"> My Bookings </h2>
        <div class="h-line bg-dark"></div>

    </div>

    <div class="container-fluid">

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
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
            <tbody>
                <?php while($fea_row =mysqli_fetch_assoc($fea_q))
                { ?>
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

    <script>
        $('#example').DataTable();
    </script>
    <!-- This file contains Footer-->
    <?php require('main/footer.php') ?>

</body>

</html>