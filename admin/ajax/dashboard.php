<?php

    require('inc/essential.php');
    require('inc/db_config.php');
    adminLogin();



    if(isset($_POST['booking_analytics']))
    {
        $frm_data = filteration($_POST);


        $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(booking_id) AS `total_bookings`,
        COUNT(trans_amt) AS `total_amt`,

        COUNT(CASE WHEN booking_status='success' AND arrival=1 THEN 1 END) AS `active_bookings`,
        SUM(CASE WHEN booking_status='success' AND arrival=1 THEN 1 `trans_amt` END) AS `active_amount`
        FROM `booking_order` "));

        $output = json_encode($result);

        echo $output;
    }

?>

