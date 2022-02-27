<?php
include('config/dbconfig.php');
if (!isset($_SESSION['id'])) {
   header("location:login.php");
} else {
   if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
      $uid = $_SESSION['id'];
      $productsid = $_POST['productsid'];
      $allproductname = $_POST['allproductname'];
      $allproductqntty = $_POST['allproductqntty'];
      $allproducytype = $_POST['allproducytype'];
      $allproductprice = $_POST['allproductprice'];
      $finalTotal = $_POST['finalTotal'];
      $p_method = $_POST['p_method'];
      $tax = $_POST['tax'];
      $timeslot = $_POST['timeslot'];

      function random_strings($length_of_string)
      {
         // sha1 the timstamps and returns substring 
         // of specified length 
         return substr(sha1(time()), 0, $length_of_string);
      }

      $orderrandomno = random_strings(10);

      $query = "SELECT address.id,address.uid,cart_table.uid FROM address,cart_table WHERE address.uid = cart_table.uid AND address.uid = '$uid'";
      $data = mysqli_query($con, $query);
      $total = mysqli_num_rows($data);
      $adress_id = "";
      if ($total != 0) {
         while ($result = mysqli_fetch_assoc($data)) {
            $adress_id = $result['id'];
         }
      } else {
         "No Records Found!!!";
      }

      $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
      $current_date = $dt->format('Y-m-d');

      $query = "INSERT INTO `orders` (`oid`, `uid`, `pname`, `pid`, `ptype`, `pprice`, `ddate`,`timesloat`,`order_date`,`status`,`qty`,`total`,`p_method`,`tax`,`address_id`) VALUES ('$orderrandomno', '$uid ', '$allproductname', '$productsid', '$allproducytype', '$allproductprice', '$current_date','$timeslot', '$current_date', 'pending', '$allproductqntty','$finalTotal','$p_method','$tax','$adress_id')";
      $result = mysqli_query($con, $query);
      if ($result == TRUE) {
         $delete_from_cart = "DELETE FROM cart_table WHERE uid = '$uid'";
         $result1 = mysqli_query($con, $delete_from_cart);
         if ($result1 == TRUE) {
            echo '<script type="text/javascript">';
            echo "setTimeout(function () { swal.fire({title: 'Order Placed!', text: 'Order Placed Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'Checkout';});";
            echo '}, 1000);</script>';
         } else {
            echo '<script type="text/javascript">';
            echo "setTimeout(function () { swal.fire({title: 'Sorry!', text: 'Something Went Wrong! Try Agin Later!', type: 'error', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'Checkout';});";
            echo '}, 1000);</script>';
         }
      }
   }
}
