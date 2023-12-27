<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];


if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $user_name =  $_SESSION['user_name'];
   $phone_number = $_SESSION['phone_no'];
   $email =  $_SESSION['email'];
   $toppings=mysqli_real_escape_string($conn, $_POST['toppings']);
   $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
   $address = mysqli_real_escape_string($conn,$_POST['address']);

    // $placed_on = date('d-M-Y');
    $placed_on = date('Y-m-d H:i:s');
    if(!empty($_POST['date'])){
       $placed_on = $_POST['date']; 
   }


   $cart_total = 0;
   $cart_fooditems[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart_tbl` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_fooditems[]  = $cart_item['food_name'].'('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }
       
            $get_stars = mysqli_query($conn, "SELECT * FROM `user_tbl` WHERE user_id = '$user_id'") or die('query failed');
               if(mysqli_num_rows($get_stars) > 0){
                  while($fetch_points = mysqli_fetch_assoc($get_stars)){
                     
                        $net_pay =  $cart_total-$fetch_points['star_points'];
                        mysqli_query($conn, "UPDATE `user_tbl` SET star_points = 0  WHERE user_id = '$user_id'") ;
      ?>
         <p  class="cart-total">Final total amount : <span>Rs<?php echo $net_pay; ?>/-</span></p>
         <?php

        }
     }



   $total_fooditems = implode('  ',$cart_fooditems);

   $order_query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE user_name = '$user_name' AND phone_no = ' $phone_number' AND email = '$email' AND payment_method = '$payment_method' AND address = '$address' AND total_items = '$total_fooditems' AND total_price = '$net_pay'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `order_tbl`(user_id, user_name,phone_no, email, payment_method, address, total_items, total_price, order_date,toppings) VALUES('$user_id', '$user_name', '$phone_number', '$email', '$payment_method', '$address', '$total_fooditems', '$net_pay', '$placed_on','$toppings')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart_tbl` WHERE user_id = '$user_id'") or die('query failed');
      }
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
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
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
            <span>Add topping :</span>
            <input type="text" name="toppings" placeholder="add any description as you prefer">
         </div>
         <div class="inputBox">
            <span>Payment method :</span>
            <select name="payment_method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address :</span>
            <input type="text"  name="address" required placeholder="e.g. jaffna">
         </div>

         <div class="inputBox">
            <p>If you want to make pre-orders please click the check box below</p>
            <input type="checkbox" class="check" id="myCheck" name="check" onclick="dateShow()">
            <input id="show"  style="display:none" type="datetime-local" name="date" >
         </div>
        </div>
      <input type="submit" value="order now" class="option-btn" name="order_btn">
   </form>

</section>


<?php include 'footer.php'; ?>
<script src="js/script1.js"></script>
</body>
</html>