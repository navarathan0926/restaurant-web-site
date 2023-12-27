<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart_tbl` SET quantity = '$cart_quantity' WHERE cart_id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart_tbl` WHERE cart_id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart_tbl` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}


$loyality= mysqli_query($conn,"SELECT user_id from rand_tbl where total_amount > 5000.00 ") or die('query failed');
      if(mysqli_num_rows($loyality) > 0) {
            while($fetch_status = mysqli_fetch_assoc($loyality)){
                     $id = $fetch_status['user_id'];
                     mysqli_query($conn, "UPDATE `user_tbl` SET loyality_cart = 'Yes' WHERE user_id = $id") ;
            }
         } 


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>
   <link rel="stylesheet" href="css/style15.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
      .hidden{
         display:none;
      }

   </style>

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
 
</div>

<section class="shopping-cart">

   <h1 class="caption">Food items are added to the cart</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart_tbl` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart_tbl = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetch_cart_tbl['cart_id']; ?>" class="fas fa-times" onclick="return confirm('Do you want to delete?');"></a>
         <img src="images/<?php echo $fetch_cart_tbl['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart_tbl['food_name']; ?></div>
         <div class="price">Rs<?php echo $fetch_cart_tbl['price']; ?>/-</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart_tbl['cart_id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart_tbl['quantity']; ?>">
            <input type="submit" name="update_cart" value="update" class="option-btn">
         </form>
         <div class="sub-total"> sub total : <span>Rs<?php echo $sub_total = ($fetch_cart_tbl['quantity'] * $fetch_cart_tbl['price']); ?>/-</span> </div>
      </div>
      <?php
         $grand_total += $sub_total;
            }

         }else{
            echo '<p class="none">No food items are selected from the menu</p>';
         }
      ?>   
   </div>
   

   <div class="add-more">
      <a href="orders.php" class="add-more-btn">Add more food items</a>
   </div>

   <div style="margin-top: 20px; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>


   <div class="cart-total">
      <p>Grand total : <span>Rs<?php echo $grand_total; ?>/-</span></p>
      
      <div class="add-more">
        
              <?php
                 
                     $get_stars = mysqli_query($conn, "SELECT * FROM `user_tbl` WHERE user_id = '$user_id'") or die('query failed');
                        if(mysqli_num_rows($get_stars) > 0){
                           while($fetch_points = mysqli_fetch_assoc($get_stars)){
                              ?>

                   <form method="post">
                         <input type="submit" name="stars" value="Use star points" class="home-btn <?php echo ($fetch_points['star_points'] > 0)?'':'hidden'; ?>"/>
                    </form> 

                  
                              <?php
                              if(isset($_POST['stars'])) {
                                 $final_total =  $grand_total-$fetch_points['star_points'];
                              
               ?>
                  <p  class="cart-total">Final total amount : <span>Rs<?php echo $final_total; ?>/-</span></p>
                  <?php

                 }
              }
            }
       ?>
      </div>
               

      <div class="flex">
         <a href="order_userdetails.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Order</a>
      </div>

   </div>


</section>



<?php include 'footer.php'; ?>


<script src="js/script1.js"></script>

</body>
</html>