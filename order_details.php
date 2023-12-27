<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];


$points = $_SESSION['point']; 
 


if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $user_name =  $_SESSION['user_name'];
   $phone_number = $_SESSION['phone_no'];
   $email =  $_SESSION['email'];
   $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
   $address = mysqli_real_escape_string($conn,$_POST['address']);

    // $placed_on = date('d-M-Y');
    $placed_on = date('Y-m-d H:i:s');
    if(!empty($_POST['date']) && !empty($_POST['time'])){
      $dt=$_POST['date']; 
      $tm=$_POST['time']; 
      $placed_on=$dt.' '.$tm.':00';
   }


   $cart_total = 0;
   $cart_fooditems[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart_tbl` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_fooditems[]  = $cart_item['food_name'].'('.$cart_item['quantity'].') ';
         $sub_total = (($cart_item['p_price']+ $cart_item['t_price'])* $cart_item['quantity']);
         $cart_total += $sub_total;
         $toppings=$cart_item['toppings'];
         $t_price=$cart_item['t_price'];
         $size=$cart_item['size'];
         $s_price=$cart_item['p_price'];
      }
   }
       
            

      $net_pay =  $cart_total-$points;
      ?>
         <p  class="cart-total">Final total amount : <span>Rs<?php echo $net_pay; ?>/-</span></p>
      <?php
      if($points>0){
         mysqli_query($conn, "UPDATE `user_tbl` SET star_points = 0  WHERE user_id = '$user_id'") ;
      }



   $total_fooditems = implode('  ',$cart_fooditems);
   
         // if($placed_on<)

         mysqli_query($conn, "INSERT INTO `order_tbl`(user_id, user_name,phone_no, email, payment_method, address, total_items,topping,t_price,size,s_price, total_price, order_date) VALUES('$user_id', '$user_name', '$phone_number', '$email', '$payment_method', '$address', '$total_fooditems','$toppings','$t_price','$size','$s_price','$net_pay', '$placed_on')") or die('query failed');
         if($payment_method=="cash on delivery"){
            echo '<script type="text/javascript">';
            echo ' alert("Your cash on delivery order hass been proceeded")';  
            echo '</script>';
            // header('location:orders2.php');
         }
         mysqli_query($conn, "DELETE FROM `cart_tbl` WHERE user_id = '$user_id'") or die('query failed');
         if($payment_method=="paypal"){
            header('location:payment.php');
            $_SESSION['total'] = $net_pay ;
         }
         

}  


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>OrderNow</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style14.css">

</head>
<body>
 
<?php include 'header.php'; ?>
<div class="heading">
   
</div>

<section class="order">

   <!-- <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart_tbl` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = (($fetch_cart['p_price']+$fetch_cart['t_price']) * $fetch_cart['quantity']);
            $grand_total += $total_price;
            $final_total =  $grand_total-$fetch_points['star_points'];
   ?>
   <p> <?php echo $fetch_cart['food_name']; ?> <span>(<?php echo 'Rs'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="none">No food items are selected from the menu</p>';
   }
   ?>
   <div class="grand-total">Final total : <span>Rs<?php echo $grand_total; ?>/-</span> </div> -->

</section>

<section class="order-details">

   <form action="" method="post">
      <h3>Place your order   <?php echo $_SESSION['user_name']; ?></h3>
      <div class="flex">
         
         <div class="inputBox">
            <span>Payment method :</span>
            <select name="payment_method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Delivered to :</span>
            <input type="text"  name="address" required placeholder="e.g. jaffna">
         </div>

         <div class="inputBox">
            <p>If you want to make pre-orders please click the check box below</p>
            <input type="checkbox" class="check" id="myCheck" name="check" onclick="dateShow()">
            <input id="show"  style="display:none" type="date" min="<?php echo date('Y-m-d'); ?>" name="date" >
            <input id="show"  style="display:none" type="time" min="08:00:00" max="23:00:00" name="time" >
         </div>
        </div>
        
      <input type="submit" value="order now" class="option-btn" name="order_btn">
   </form>

</section>


<?php include 'footer.php'; ?>
<script src="js/script1.js"></script>
</body>
</html>
