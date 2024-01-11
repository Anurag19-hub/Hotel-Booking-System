<?php
session_start();
// $customerAddress = $_POST['customerAddress'];
// $customerCity = $_POST['customerCity'];
// $customerZipcode = $_POST['customerZipcode'];
// $customerState = $_POST['customerState'];
// $customerCountry = $_POST['customerCountry'];
include_once("admin/inc/db_config.php");


//   $itemName = $_POST['item_details'];
// 	$itemNumber = $_POST['item_number'];
// 	$itemPrice = $_POST['price'];
// 	$totalAmount = $_POST['total_amount'];
// 	$currency = $_POST['currency_code'];
// 	$orderNumber = $_POST['order_number'];
$user_id = $_SESSION['uId'];
$room_id = $_SESSION['room']['id'];
$check_out = $_GET['checkout'];
$check_in = $_GET['checkin'];
$room = $_SESSION['room'];
$arrival = 0;
$trans_amt = $_SESSION['room']['payment'];
$booking_status = "Success";
$trans_status = "Pending";
$order_id = rand(11111,99999);
$trans_id = rand(111111,999999);

// echo "<pre>"; print_r($_SESSION);exit;

   $insertOrderSQL = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`) VALUES ('".$user_id."','".$room_id."','".$check_in."','".$check_out."','".$arrival."','".$booking_status."','".$order_id."','".$trans_id."','".$trans_amt."','".$trans_status."')";     
  
  
  mysqli_query($con, $insertOrderSQL) or die("database error: ". mysqli_error($con));
     
   $lastInsertId = mysqli_insert_id($con); 

  header("Location: http://localhost/serenity/bookings.php", true, 301);

    //require('pay_config.php');

        // session_start();


        // if(isset($_POST['pay_now']))
        // {
            
        // }

    
    
?>
<!-- <style>
    .row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>


<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/action_page.php">

       
          <div class="col-50">
            <h3>Confirm Booking</h3>

            <h3>Payment</h4>
            <div class="row">
              <div class="col-50">
                <input type="text" id="cash_pay" name="cash">
              </div>
            </div>
          </div>

        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Confirm booking" class="btn">
      </form>
    </div>
  </div>

  <div class="col-25">
    <div class="container">
      <h4>Room
        <span class="price" style="color:black">
          <i class="fa fa-shopping-cart"></i>
          <b>1</b>
        </span>
      </h4>
      <p><a href="#">Product 1</a> <span class="price"></span></p>
      <p><a href="#">Product 2</a> <span class="price">$5</span></p>
      <p><a href="#">Product 3</a> <span class="price">$8</span></p>
      <p><a href="#">Product 4</a> <span class="price">$2</span></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b>$30</b></span></p>
    </div>
  </div>
</div> -->

<!-- <form action="">

    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key = "<?php echo $publishablekey ?>"
        data-amount = "<?php echo $result ?>"
        data-name = "Serenity-Inn"
        data-description = "Serenity Inn Desc"
        data-image = ""
        data-currency = "inr"
    >
    </script>

</form> -->
