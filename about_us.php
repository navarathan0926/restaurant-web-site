<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style19.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">


</head>
<body>
<?php include 'header.php'; ?> 


<div class="heading">
   
</div>
<section class="about_us">

   <div class="flex">
      <div class="content">
         <h3>about us</h3>
         <p> Our restaurant is very famous one in the hometown.Here we serve healthy advised food in healthy advised cooking manner.
            We will deliver the food items which you preferred within the time limit.You can make the pre orders for any functions for a big 
            amount of people.Join with us in your precious occations.</p>
         <a href="contact.php" class="home-btn">contact us</a>
      </div>

   </div>

</section>

<section class="message">
   <h1 class="caption"> Reviews</h1>
   <div class="box-container">
      <?php
         $get_review = mysqli_query($conn, "SELECT * FROM `feedback_tbl` group by customer_name") or die('query failed');
      
         if(mysqli_num_rows($get_review) > 0){
            while($fetch_msg = mysqli_fetch_assoc($get_review)){
         
      ?>
      <div class="box">
        <img src="images/user" width="50" height="50"></img>
         <p id="head"><span><?php echo $fetch_msg['customer_name']; ?></span> </p>
         <p>  <span><?php echo $fetch_msg['feedback']; ?></span> </p>
         <div class="rateyo" id= "rate"
               data-rateyo-rating="<?php echo $fetch_msg['rating']; ?>"
               data-rateyo-num-stars="5"
               data-rateyo-score="3">
         </div>
      
      </div>
<?php
   };
}else{
   echo '<p class="empty">you have no messages!</p>';
}
?>
</div>

</section>
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
<?php include 'footer.php'; ?>
<script src="js/script1.js"></script>

</body>
</html>