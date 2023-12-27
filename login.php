<?php

include 'connection.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `user_tbl` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   $select_del_boy = mysqli_query($conn, "SELECT * FROM `delivery_boy` WHERE email = '$email' AND password = '$pass'") or die('query failed');


   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['user_name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['user_id'];
         header('location:admin/admin_foods.php');

      }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['phone_no']=$row['phone_no'];
            $_SESSION['email']=$row['email'];
            header('location:home.php');
         }
   
         
   }
   elseif(mysqli_num_rows($select_del_boy) > 0){
      $row = mysqli_fetch_assoc($select_del_boy);
   
         $_SESSION['deliveryboy_name'] = $row['delb_name'];
         $_SESSION['deliveryboy_email'] = $row['email'];
         $_SESSION['deliveryboy_id'] = $row['delb_id'];
         header('location:Del_Boy/delivery.php');

   }
   else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style18.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form1">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="enter your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required class="box">
      <input type="password" name="password" placeholder="enter your password" pattern="/^[a-zA-Z0-9!@#\$%\^\&*_=+-]{8,30}$/g" required class="box">
      <input type="submit" name="submit" value="login now" class="home-btn">
      <p>Don't have an account? <a href="register.php">Register now</a></p>
   </form>

</div>

</body>
</html>