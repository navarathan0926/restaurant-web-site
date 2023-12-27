<?php

include 'connection.php';

session_start();

if(isset( $_SESSION['user_id'])){
   $user_id = $_SESSION['user_id']; 
   
}
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style19.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
</head>
<body>
 
<div class="logi">

   <p>
     <a href="login.php">login</a> 
     <a href="register.php">register</a> 
   </p>

</div>

   <?php include 'header.php'; ?>

<section class="home">

      <div class="content">
         <h3>Take a bite feel the taste</h3>
      </div>

</section>



<section class="products">

   <h3 class="caption">Winners of this month </h3>
   <center>
   <div class="winner">

      <?php
         $select_names= mysqli_query($conn, "SELECT winners FROM winner order by date DESC limit 1") or die('query failed');
         $row=mysqli_fetch_row($select_names);
         $user_names= explode(',',$row[0]);
         ?>
         <div class="box">
            <p><?php echo "First winner is :".$user_names[0].'<br>' ?>
               <?php echo "Second winner is :".$user_names[1].'<br>' ?>
               <?php echo "Third winner is :".$user_names[2].'<br>'?></p>;
         </div>
   </div>
   </center>
   <h1 class="caption">Must Tryable Foods</h1>

      <div class="box-container">
         <?php 
            $select_rating = mysqli_query($conn, "SELECT * FROM `food_tbl` ORDER BY rating DESC LIMIT 4") or die('query failed');
            if(mysqli_num_rows($select_rating) > 0){
               while($fetch_rating = mysqli_fetch_assoc($select_rating)){
         ?>
         <a href="orders2.php">
          <form action="" method="post" class="box">
         <img class="image" src="images/<?php echo $fetch_rating['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_rating['food_name']; ?></div>
         <div class="price">Rs<?php echo $fetch_rating['price']; ?>/-</div>
        
         <input type="hidden" name="product_name" value="<?php echo $fetch_rating['food_name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_rating['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_rating['image']; ?>">

         <div class="rateyo" id= "rate"
               data-rateyo-rating="<?php echo $fetch_rating['rating']; ?>"
               data-rateyo-num-stars="5"
               data-rateyo-score="3">
         </div>
      
   
       
      </form>
               </a>
         <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>
      <div class="load-more" style="margin-top: 20px; text-align:center">
         <a href="order2.php" class="home-btn">View more</a>
      </div>

<br><br><br><br>
      <h1 class="caption">Special foods of today</h1>

      <div class="box-container">
         <?php  
            $select_products = mysqli_query($conn, "SELECT * FROM `food_tbl` where special_day =DAYNAME(Current_date) and availability='Yes'") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
         <a href="orders2.php">
          <form action="" method="post" class="box">
         <img class="image" src="images/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['food_name']; ?></div>
         <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
        
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['food_name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
       
      </form>
               </a>
         <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>
      <div class="load-more" style="margin-top: 20px; text-align:center">
         <a href="orders2.php" class="home-btn">View more</a>
      </div>


      

   
</section>


<section class="about_us">

   <div class="flex">
      <div class="image">
         <img src="images/2f.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>Our resturant is ont of the best in Sri Lanka . We have been running since 2010. If you want to contact us you can contact us.</p>
         <a href="contact.php" class="home-btn">contact us</a>
      </div>

   </div>

</section>





</section>

<?php include 'footer.php'; ?>


<script src="js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>


    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating);
        });
    });

</script>

</body>
</html>