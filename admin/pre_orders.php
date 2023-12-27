<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
}
// .........for take order from customer..............
if(isset($_POST['take_order'])) {
   $order_update_id = $_POST['order_id'];
   
   mysqli_query($conn, "UPDATE `order_tbl` SET order_taken = 'Yes' WHERE order_id = '$order_update_id'") or die('query failed');
   $y = $_POST['total_price'];
   $star=$y/100;
   $user_id = $_POST['user_id'];
 
   $points= mysqli_query($conn,"SELECT * from user_tbl where loyality_cart='Yes' and user_id in (SELECT user_id from order_tbl where  order_id = '$order_update_id')") or die('query failed');
      if(mysqli_num_rows($points) > 0) {

         while($fetch_value = mysqli_fetch_assoc($points)){     
            $star_point = $fetch_value['star_points'] + $star;
            mysqli_query($conn, "UPDATE `user_tbl` SET star_points = '$star_point' WHERE user_id = '$user_id'") ;
           

         }
         
      } 

}

if(isset($_POST['update_order'])){
   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   
   
   // $update_delivery_status=$_POST['update_delivery_status'];
   mysqli_query($conn, "UPDATE `order_tbl` SET payment_status = '$update_payment' WHERE order_id = '$order_update_id'") or die('query failed');
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
   <title>Manage orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../css/admin_style7.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">placed orders</h1>
   <table>
      <tr>
         <th>Order id</th>
         <th>User id</th>
         <th>Customer</th>
         <th>Phone number</th>
         <th>Address</th>
         <th>Total Products</th>
         <th>Toppings</th>
         <th>Toppings Price</th>
         <th>Size</th>
         <th>Size price</th>
         <th>Total price</th>
         <th>Order Date and Time</th>
         <th>Payment method</th>
         <th>Order taken</th>
         <th>Payment status</th>
         <th>Delivery status</th>
         
         
         <th>Update</th>
      </tr>
      <?php
      $cur_date=date('Y-m-d');
      $cur_dateTime=date('Y-m-d H:i:s');
      $select_orders = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE order_date NOT LIKE '$cur_date%' AND order_date > '$cur_dateTime' ORDER BY order_taken, order_date") or die('query failed');

      // $select_orders = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE order_date LIKE '$cur_date%  ORDER BY order_taken") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <tr>
         <td><?php echo $fetch_orders['order_id']; ?></td>
         <td><?php echo $fetch_orders['user_id']; ?></td>
         <td><?php echo $fetch_orders['user_name']; ?></td>
         <td><?php echo $fetch_orders['phone_no']; ?></td>
         <!-- <td><?php echo $fetch_orders['email']; ?></td> -->
         <td><?php echo $fetch_orders['address']; ?></td>
         <td><?php echo $fetch_orders['total_items']; ?></td>
         <td><?php echo $fetch_orders['topping']; ?></td>
         <td><?php echo $fetch_orders['t_price']; ?></td>
         <td><?php echo $fetch_orders['size']; ?></td>
         <td><?php echo $fetch_orders['s_price']; ?></td>
         <td><?php echo $fetch_orders['total_price']; ?></td>
         <td><?php echo $fetch_orders['order_date']; ?></td>
         <td><?php echo $fetch_orders['payment_method']; ?></td>
         
         <td>
            <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['order_id']; ?>">
            <input type="hidden" name="total_price" value="<?php echo $fetch_orders['total_price']; ?>">
           
            <input type="hidden" name="user_id" value="<?php echo $fetch_orders['user_id']; ?>">
            <input type="submit" name="take_order"  style="background-color:<?php if($fetch_orders['order_taken'] == 'Yes'){ echo '#7fa047'; } ?>" class="order-btn" value="<?php echo $fetch_orders['order_taken']; ?>"/>
            </form>
         
         </td>
         <td><form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['order_id']; ?>">
            <select class="selecting" name="update_payment">
               <option value="<?php echo $fetch_orders['payment_status']; ?>" hidden><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
         </td>
         <!-- <td><?php echo $fetch_orders['payment_status']; ?></td> -->
         <td><?php echo $fetch_orders['delivery_status']; ?></td>
         <td>
            <input type="submit" value="Update"  name="update_order" class="option-btn">
            <a href="manage_orders.php?delete=<?php echo $fetch_orders['order_id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">Delete</a>
         </form>
         </td>

      </tr>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   
   </table>

</section>



<!-- custom admin js file link  -->
<script src="../js/admin_script.js"></script>



</body>
</html>