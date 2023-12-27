<?php

include '../connection.php';

session_start();

$deliveryboy_id = $_SESSION['deliveryboy_id'];

if(!isset($deliveryboy_id)){
   header('location:../login.php');
}
// .........for take order from customer..............
if(isset($_POST['payment_received'])) {
   $payment_received_id = $_POST['order_id'];
   mysqli_query($conn, "UPDATE `order_tbl` SET payment_status = 'completed' WHERE order_id = '$payment_received_id'") or die('query failed');
}

if(isset($_POST['order_delivered'])){
   $delivery_update_id = $_POST['order_id'];
   $b_id = $_POST['delb_id'];
   
   // $update_delivery_status=$_POST['update_delivery_status'];
   mysqli_query($conn, "UPDATE `order_tbl` SET delivery_status = 'YES' WHERE order_id = '$delivery_update_id'") or die('query failed');
   mysqli_query($conn, "UPDATE `delivery_boy` SET availability = 'YES' WHERE delb_id = '$b_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `order_tbl` WHERE order_id = '$delete_id'") or die('query failed');
   header('location:manage_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage Delivery Boy</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../css/admin_style7.css">

   <style>
      .disabled{
      pointer-events: none;
      opacity: .5;
      user-select: none;
      }

   </style>

</head>
<body>
   
<?php include 'del_boy_header.php'; ?>

<!-- orders of current date -->
<section class="orders">

   <h1 class="title">Today orders</h1>
   <table>
      <tr>
         <th>Order id</th>
         <th>UserName</th>
         <th>Phone number</th>
         <th>Address</th>
         <th>Total Items</th>
         <th>Total Price</th>
         <th>Order Date</th>
         <th>payment Method</th>
         <th>Payment Status</th>
         <th>Delivery status</th>
      </tr>
      <?php
      $cur_date=date('Y-m-d');
      // WHERE order_date LIKE '$cur_date%'
      $select_orders = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE delb_id='$deliveryboy_id' ORDER BY order_taken") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      
     
      <tr >
         <td><?php echo $fetch_orders['order_id']; ?></td>
         <td><?php echo $fetch_orders['user_name']; ?></td>
         <td><?php echo $fetch_orders['phone_no']; ?></td>
         <td><?php echo $fetch_orders['address']; ?></td>
         <td><?php echo $fetch_orders['total_items']; ?></td>
         <td><?php echo $fetch_orders['total_price']; ?></td>
         <td><?php echo $fetch_orders['order_date']; ?></td>
         <td><?php echo $fetch_orders['payment_method']; ?></td>


         <td>
            <form action="" method="post">
            <input type="hidden" name="order_id"  value="<?php echo $fetch_orders['order_id']; ?>">
            <input type="submit" name="payment_received"  style="background-color:<?php if($fetch_orders['payment_status'] == 'completed'){ echo '#7fa047'; } ?>" class="order-btn" value="<?php echo $fetch_orders['payment_status']; ?>"/>
            </form>
         </td>

         <td>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['order_id']; ?>">
            <input type="hidden" name="delb_id"  value="<?php echo $fetch_orders['delb_id']; ?>">
            <input type="submit" name="order_delivered"  style="background-color:<?php if($fetch_orders['delivery_status'] == 'YES'){ echo '#7fa047'; } ?>" class="order-btn" value="<?php echo $fetch_orders['delivery_status']; ?>"/>
            </form>
        </td>
         

      </tr>
      <?php
         }
      }else{
         echo '<p class="empty">Today no orders placed yet!</p>';
      }
      ?>
   
   </table>
   <!-- <button>Click to show old orders</button> -->

</section>



<!-- custom admin js file link  -->
<script src="../js/admin_script.js"></script>

<script>

</script>



</body>
</html>