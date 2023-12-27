<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- admin css file link  -->
   <link rel="stylesheet" href="../css/admin_style7.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>


<section class="dashboard">

      

   <h1 class="title">dashboard</h1>

   <div class="box2">
         
      </div>

   <div class="box-container">
        <div class="box">
            <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM `user_tbl` WHERE user_type = 'user'") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $number_of_users; ?></h3>
            <p>Normal users</p>
        </div>

        <div class="box">
            <?php 
                $select_admins = mysqli_query($conn, "SELECT * FROM `user_tbl` WHERE user_type = 'admin'") or die('query failed');
                $number_of_admins = mysqli_num_rows($select_admins);
            ?>
            <h3><?php echo $number_of_admins; ?></h3>
            <p>Admins</p>
        </div>
        
      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `order_tbl` WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3>Rs<?php echo $total_pendings; ?>/-</h3>
         <p>Total pendings</p>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `order_tbl` WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3>Rs<?php echo $total_completed; ?>/-</h3>
         <p>Completed payments</p>
      </div>
      
      <div class="box">
         <?php 
            $select_msg = mysqli_query($conn, "SELECT * FROM `help` where reply is NULL") or die('query failed');
            $number_of_msg = mysqli_num_rows($select_msg);
         ?>
         <h3><?php echo $number_of_msg; ?></h3>
         <p>New Messages</p>
      </div>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `order_tbl`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>Order placed</p>
      </div>

      <div class="box">
            <?php 
                $select_pending = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE delivery_status='No' ") or die('query failed');
                $number_of_pending = mysqli_num_rows($select_pending);
            ?>
            <h3><?php echo $number_of_pending; ?></h3>
            <p>Pending deliveries</p>
        </div>

      <div class="box">
         <?php 
            $select_foods = mysqli_query($conn, "SELECT * FROM `food_tbl`") or die('query failed');
            $number_of_foods = mysqli_num_rows($select_foods);
         ?>
         <h3><?php echo $number_of_foods; ?></h3>
         <p>Food items</p>
      </div>

   
   </div>
   <div class="contain">
   <a href="rand.php">Select winners</a>
   </div>

</section>

<!-- js file for admin panel  -->
<script src="../js/admin_script.js"></script>



</body>
</html>

