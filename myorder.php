<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `order_tbl` WHERE order_id = '$delete_id'") or die('query failed');
   header('location:myorder.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>myorders</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style19.css">

</head>
<body>
   
<?php include 'header.php'; ?>
<div class="heading">
   
</div>

<section class="myorder">

<h1 class="caption">My orders</h1>
   <div class="box-container">
    <?php
   $order_query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE user_id = '$user_id' order by order_date DESC") or die('query failed');
   ?>
      <div class="myview">
      <table>
           <tr>
            <th>User name</th>
            <th>Mobile No</th>
            <th>Address</th>
            <th>Your orders</th>
            <th>Total Price</th>
            <th>Order date</th>
            <th>Process</th>
            <th>Order cancel</th>
           
           </tr>
           <?php
       
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
         ?>
           <tr>               
            <td><span><?php echo $fetch_orders['user_name']; ?></span></td>
            <td><span><?php echo $fetch_orders['phone_no']; ?></span></td>
            <td> <span><?php echo $fetch_orders['address']; ?></span> </td>
            <td><?php echo $fetch_orders['total_items']; ?></span> </td>
            <td><span>Rs.<?php echo $fetch_orders['total_price'];?></span> </td>
            <td><?php echo $fetch_orders['order_date']; ?></span> </td>
            <td>
               <?php
                  if($fetch_orders['order_taken'] =='Yes'){
                     if($fetch_orders['delivery_status'] =='YES'){
               ?>
                     <b style ="color:green; <?php echo "Delivered";?>">Delivered</b>

               <?php
                        }else
               {?>
                     <b style="color:orange; <?php echo "On process";?>">On process</b>
               <?php
                        }
                     }else
               {?>
                     <b  style="color:red; <?php echo "On process";?>">Not accepted</b>
               <?php
                 }
               ?>
           </td>
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['order_id']; ?>">
            <td>
               <!-- <a href="cart.php " class ="home-btn <?php echo ($fetch_orders['order_taken'] =='No')?'':'disabled'; ?>">Replace</a>  -->
               <a href="myorder.php?delete=<?php echo $fetch_orders['order_id']; ?>" class = "delete-btn <?php echo ($fetch_orders['order_taken'] =='No')?'':'disabled'; ?>"onclick="return confirm('Confirm cancel order?');">Cancel</a>  
            </td>
            
           </tr>
       
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
      
      </table> 
   </div>

</section>



<?php include 'footer.php'; ?>
<script src="js/script1.js"></script>

</body>
</html>