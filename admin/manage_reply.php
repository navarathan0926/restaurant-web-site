<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['response'])){
   $reply =mysqli_real_escape_string($conn, $_POST['reply']);
   $reply_id=$_POST['msg_id'];
   mysqli_query($conn, "UPDATE help set reply ='$reply' where msg_id='$reply_id'"  ) or die('query failed');
   header('location:manage_reply.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../css/admin_style7.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title"> messages </h1>

   <div class="box-container">
   <?php
      $get_msg = mysqli_query($conn, "SELECT * FROM `help` where reply is NULL") or die('query failed');
      if(mysqli_num_rows($get_msg) > 0){
         while($fetch_msg = mysqli_fetch_assoc($get_msg)){
      
   ?>
   <div class="box">
      
      <p> user id : <span><?php echo $fetch_msg['user_id']; ?></span> </p>
      <p> name : <span><?php echo $fetch_msg['user_name']; ?></span> </p>
      <p> number : <span><?php echo $fetch_msg['phone_no']; ?></span> </p>
      <p> email : <span><?php echo $fetch_msg['email']; ?></span> </p>
      <p> message : <span><?php echo $fetch_msg['message']; ?></span> </p>
       <form action="" method ="POST">
         <input type="hidden" name="msg_id" value="<?php echo $fetch_msg['msg_id']; ?>">
        
         <p>reply :</p><input  type="text" name="reply"   placeholder="enter your reply" size="30">
         <input type="submit" name="response" value="Reply" class="option-btn">
    
         </form>
 
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">you have no messages!</p>';
   }
   ?>
   </div>
   
     

</section>









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>