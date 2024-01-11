<?php

require('pay_config.php');

require('admin/inc/db_config.php');
require('admin/inc/essential.php');
require('admin/ajax/confirm_booking.php');


\Stripe\Stripe::setVerifySslCerts(false);
//echo '<pre>';
//print_r($_POST);

$token = $_POST['stripeToken'];

$data = \Stripe\Charge::create(array(

    "amount"=>$payment,
    "currency"=>"inr",
    "description"=>"Serenity Inn Desc",
    "source"=>$token,
));

echo "<pre>";

print_r($data);


?>
