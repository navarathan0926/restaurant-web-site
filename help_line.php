<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){
    $user_name = $_SESSION['user_name'];
    $email = $_SESSION['email']; 
    $phone_number = $_SESSION['phone_no']; 
    $msg=mysqli_real_escape_string($conn, $_POST['message']);

  
      mysqli_query($conn, "INSERT INTO `help`(user_id,user_name, email, phone_no, message) VALUES( '$user_id','$user_name', '$email', '$phone_number', '$msg')") or die('query failed');
    
 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style19.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Report issues</h3>
      <textarea name="message" class="box" placeholder="Enter your message" id="" cols="40" rows="10"></textarea>
     
      <input type="submit" value="send message" name="send" class="home-btn">
   </form>

      <table>
         <?php
         $get_reply= mysqli_query($conn, "SELECT * FROM help where user_id= '$user_id' ") or die('query failed');
         while($fetch_replies = mysqli_fetch_assoc($get_reply)){
         ?>  
            <tr id="user">
               <td ><?php echo $_SESSION['user_name'].':' ?></td>
               <td ><?php echo $fetch_replies['message'];?></td>
            </tr>  
            <tr id="admin">
               <td ><?php echo "Admin   :"?></td>
               <td ><?php echo $fetch_replies['reply'];?></td>
               </tr>
      
         <?php
            }
         ?>
      
      </table>  

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>