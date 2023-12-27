<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $food_name = $_POST['food_name'];
   $food_price = $_POST['food_price'];
   $food_image = $_POST['food_image'];
   $food_quantity = $_POST['food_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart_tbl` WHERE food_name = '$food_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart_tbl`(user_id, food_name, price, quantity, image) VALUES('$user_id', '$food_name', '$food_price', '$food_quantity', '$food_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>order</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style15.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Green kitchen</h3>
</div>

<section class="products">

   <h1 class="caption">Tasty foods</h1>
   
         <?php  
            $select_category = mysqli_query($conn, "SELECT DISTINCT(category) FROM `food_tbl`") or die('query failed');
            // $select_foods = mysqli_query($conn, "SELECT * FROM `food_tbl`") or die('query failed');
            if(mysqli_num_rows($select_category) > 0){
               while($fetch_category = mysqli_fetch_assoc($select_category)){
                  $category=$fetch_category['category'];
                  ?><h3 class="caption"><?php echo $category; ?></h3>
                  <div  class="box-container"><?php
                  // $category=$fetch_category['category'];
                  $select_foods = mysqli_query($conn, "SELECT * FROM `food_tbl` WHERE category='$category' ") or die('query failed');
                  if(mysqli_num_rows($select_foods) > 0){
                     while($fetch_foods = mysqli_fetch_assoc($select_foods)){
                        ?>
                        <form action="" method="post" class="box">
                        <img class="image" src="images/<?php echo $fetch_foods['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_foods['food_name']; ?></div>
                        <div class="price">Rs<?php echo $fetch_foods['price']; ?>/-</div>
                        <input type="number" min="1" name="food_quantity" value="1" class="qty">
                        <input type="hidden" name="food_name" value="<?php echo $fetch_foods['food_name']; ?>">
                        <input type="hidden" name="food_price" value="<?php echo $fetch_foods['price']; ?>">
                        <input type="hidden" name="food_image" value="<?php echo $fetch_foods['image']; ?>">
                        <button name="add_to_cart" class="add-btn"><i class="fa fa-cart-arrow-down"></i></button>
                        </form>
                        <?php
                     }
               ?>
               </div>
         <?php
                  }
            }
         }else{
            echo '<p class="none">Menu added yet</p>';
         }
         ?>
      

   

   

   

   

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>