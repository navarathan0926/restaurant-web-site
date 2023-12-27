<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
};

if(isset($_POST['new_toppings'])){

   $name = mysqli_real_escape_string($conn, $_POST['toppings']);
   $category_toppigs =  $_POST['category_toppings'];
   $price = $_POST['price'];
   

   $select_toppings = mysqli_query($conn, "SELECT toppings FROM `toppings` WHERE toppings = '$name'") or die('query failed');

   if(mysqli_num_rows($select_toppings) > 0){
      $message[] = 'Toppings already added';
   }else{
      $new_toppings = mysqli_query($conn, "INSERT INTO `toppings`(toppings, category_toppings, price) VALUES('$name', '$category_toppigs', '$price')") or die('query failed');

   }
}

if(isset($_POST['update_toppings'])){
    $toppings_update_id = $_POST['toppings_id'];
    $update_name = $_POST['update_name'];
    $update_price= $_POST['update_price'];
    $update_category = $_POST['update_category'];
 
    
    // $update_delivery_status=$_POST['update_delivery_status'];
    mysqli_query($conn, "UPDATE `toppings` SET toppings = '$update_name' , price='$update_price', category_toppings='$update_category' WHERE toppings_id = '$toppings_update_id'") or die('query failed');
    $message[] = 'Topping details have been updated!';
 
 }
 
 if(isset($_GET['delete_toppings'])){
    $delete_id = $_GET['delete_toppings'];
    mysqli_query($conn, "DELETE FROM `toppings` WHERE toppings_id = '$delete_id'") or die('query failed');
    header('location:admin_manage_toppings.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!--  css file link  -->
   <link rel="stylesheet" href="../css/admin_style7.css">
   <link rel="stylesheet" href="../css/style16.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>


<h1 class="title">Manage Toppings</h1>

<section class="add-foods">


   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add new Toppings</h3>
      <input type="text" name="toppings" class="box" placeholder="Enter new toppings name" required>
      <input type="text" name="category_toppings" class="box" placeholder="Enter toppings category" required>
      <input type="number" min="0" name="price" class="box" placeholder="Enter toppings price" required>
    
      <input type="submit" value="Add new toppings" name="new_toppings" class="btn">
   </form>

</section>

<section class="users">
<h1 class="title">Topping items</h1>
   <div class="box-container">
   
      <table class="center">
         <tr>
            <th>Toppings id</th>
            <th>Toppings name</th>
            <th>Price</th>
            <th>Toppings category</th>
            <th>Update</th>
         </tr>
         <?php
         $select_toppings = mysqli_query($conn, "SELECT * FROM `toppings`") or die('query failed');

         // $select_orders = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE order_date LIKE '$cur_date%  ORDER BY order_taken") or die('query failed');
         if(mysqli_num_rows($select_toppings) > 0){
            while($fetch_toppings = mysqli_fetch_assoc($select_toppings)){
         ?>
         <tr>
            <form action="" method="POST">
            <td><input type="text" name="toppings_id" class="box" value="<?php echo $fetch_toppings['toppings_id']; ?>" required></td>
            <td><input type="text" name="update_name" class="box" value="<?php echo $fetch_toppings['toppings']; ?>" required></td>
            <td><input type="text" name="update_price" class="box" value="<?php echo $fetch_toppings['price']; ?>" required></td>
            <td><input type="text" name="update_category" class="box" value="<?php echo $fetch_toppings['category_toppings']; ?>" required></td>
         
            <td>
               <input type="submit" value="Update"  name="update_toppings" class="option-btn">
               <a href="admin_manage_toppings.php?delete=<?php echo $fetch_toppings['toppings_id']; ?>" onclick="return confirm('delete this topping?');" class="delete-btn">Delete</a>
            </form>
            </td>

         </tr>
         <?php
            }
         }else{
            echo '<p class="empty">No toppigs added yet!</p>';
         }
         ?>
      
      </table>
   </div>
</section>


<!-- custom admin js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>