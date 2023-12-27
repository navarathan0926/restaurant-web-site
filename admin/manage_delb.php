<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `delivery_boy` WHERE delb_id = '$delete_id'") or die('query failed');
   header('location:manage_users.php');
}

if(isset($_POST['update'])){

   $update_delb_id = $_POST['update_delb_id'];
   $update_name = $_POST['update_name'];
   $update_phone_number= $_POST['update_phone_number'];
   $update_email=$_POST['update_email'];
   $update_availability=$_POST['update_availability'];

   mysqli_query($conn, "UPDATE `delivery_boy` SET delb_name = '$update_name',  phone_number= '$update_phone_number', email = '$update_email',  availability= '$update_availability' WHERE delb_id = '$update_delb_id'") or die('query failed');

   header('location:manage_delb.php');
}


if(isset($_POST['appoint'])){

   $add_name = $_POST['delb_name'];
   $add_phone_number= $_POST['delb_phone_number'];
   $add_email=$_POST['delb_email'];
   $add_password=$_POST['delb_password'];
   $add_availability=$_POST['delb_availability'];

   mysqli_query($conn, "INSERT INTO `delivery_boy` (delb_name,  phone_number, email, password, availability) VALUES('$add_name', '$add_phone_number', '$add_email', '$add_password', '$add_availability')") or die('query failed');

   header('location:manage_delb.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../css/admin_style7.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-foods">


   <form action="" method="post" enctype="multipart/form-data">
      <h3>Appoint Delivery Boy</h3>
      <input type="text" name="delb_name" class="box" placeholder="Enter delivery boy name" required>
      <input type="text" name="delb_phone_number" class="box" placeholder="Enter delivery boy phone number" required>
      <input type="text" name="delb_email" class="box" placeholder="Enter delivery boy email" required>
      <input type="password" name="delb_password" class="box" placeholder="Enter delivery boy password" required>
      <input type="text" name="delb_availability" class="box" placeholder="Enter delivery boy availability" required>

      <input type="submit" value="Appoint" name="appoint" class="btn">
   </form>

</section>

<section class="users">

    

   <h1 class="title"> user accounts </h1>

   <div class="box-container">
    <table class="center">
        <tr>
            <th>Delivery Boy id</th>
            <th>Delivery Boy name</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>Availability</th>
            <th>Manage delivery Boy</th>
        </tr>
    
      <?php
         $select_del_boy = mysqli_query($conn, "SELECT * FROM `delivery_boy`") or die('query failed');
         while($fetch_delivery = mysqli_fetch_assoc($select_del_boy)){
      ?>
        <tr>
         <form action="" method="POST">
            <td><input type="text" name="update_delb_id" class="box" value="<?php echo $fetch_delivery['delb_id']; ?>" required></td>
            <td><input type="text" name="update_name" class="box" value="<?php echo $fetch_delivery['delb_name']; ?>" required></td>
            <td><input type="text" name="update_phone_number" class="box" value="<?php echo $fetch_delivery['phone_number']; ?>" required></td>
            <td><input type="text" name="update_email" class="box" value="<?php echo $fetch_delivery['email']; ?>" required></td>
            <td><input type="text" name="update_availability" class="box" value="<?php echo $fetch_delivery['availability']; ?>" required></td>

            <td>
            <input type="submit" value="Update"  name="update" class="option-btn">
            <a href="manage_delb.php?delete=<?php echo $fetch_delivery['delb_id']; ?>" onclick="return confirm('Confirm to delete this delivery_boy?');" class="delete-btn">delete</a>
         </form> 
         </td>
        </tr>
      
      <?php
         }
      ?>
    </table>
   </div>

</section>



<!-- custom admin js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>