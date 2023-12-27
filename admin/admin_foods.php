<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
};



if(isset($_GET['delete'])){
   $delete_name = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `food_tbl` WHERE food_name = '$delete_name'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('../images/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `food_tbl` WHERE food_nam2 = '$delete_name'") or die('query failed');
   header('location:admin_foods.php');
}

if(isset($_POST['update_food'])){

   // $update_f_id = $_POST['update_f_id'];
   $update_name = $_POST['update_name'];
   $update_category = $_POST['update_category'];
   $update_price = $_POST['update_price'];
   $update_special_day=$_POST['update_special_day'];
   $update_availability=$_POST['update_availability'];

   mysqli_query($conn, "UPDATE `food_tbl` SET food_name = '$update_name', category = '$update_category', price = '$update_price', special_day= '$update_special_day', availability= '$update_availability' WHERE food_name = '$update_name'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = '../images/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `food_tbl` SET image = '$update_image' WHERE food_name = '$update_name'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('../images/'.$update_old_image);
      }
   }

   header('location:admin_foods.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>foods</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../css/admin_style7.css">
   <style>
      .caption{
         text-align: center;
         text-transform:capitalize;
         font-size: 40px;
         margin: 40px;
      }
   </style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>



<h1 class="title">Food Items</h1>



<section class="add-foods">
   <a href="admin_add_foods.php" div="btn" >Add foods</a>
</section>
<section class="add-foods">
   <a href="admin_manage_toppings.php" div="btn" >Manage Toppings</a>
</section>


<!-- show foods  section -->

<section class="show-products">
   <?php
      $select_category = mysqli_query($conn, "SELECT DISTINCT(category) FROM `food_tbl`") or die('query failed');
               if(mysqli_num_rows($select_category) > 0){
                  while($fetch_category = mysqli_fetch_assoc($select_category)){
                     $category=$fetch_category['category'];
   ?>
                     <h3 class="caption"><?php echo $category; ?></h3>
                     <div class="box-container">
                        <?php
                           $select_foods = mysqli_query($conn, "SELECT * FROM `food_tbl` WHERE category='$category'") or die('query failed');
                           if(mysqli_num_rows($select_foods) > 0){
                              while($fetch_foods = mysqli_fetch_assoc($select_foods)){
                        ?>
                        <div class="box">
                           <img src="../images/<?php echo $fetch_foods['image']; ?>" alt="<?php echo $fetch_foods['food_name']; ?>">
                           <div class="name"><?php echo $fetch_foods['food_name']; ?></div>
                           <div class="price">Rs<?php echo $fetch_foods['price']; ?>/-</div>
                           <a href="admin_foods.php?update=<?php echo $fetch_foods['food_name']; ?>" class="option-btn">update</a>
                           <a href="admin_foods.php?delete=<?php echo $fetch_foods['food_name']; ?>" class="delete-btn" onclick="return confirm('Confirm delete?');">delete</a>
                        </div>
                        <?php
                           }
                        }
                        ?>
                     </div>
   <?php
                  }
               }else{
                  echo '<p class="empty">No foods added yet!</p>';
               }
   ?>
</section>

<!-- edit food section -->
<section class="edit-product-form">
   <?php
      if(isset($_GET['update'])){
         $update_name = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `food_tbl` WHERE food_name = '$update_name'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_name" value="<?php echo $fetch_update['food_name']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="../images/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['food_name']; ?>" class="box" required placeholder="Enter food name">
      <input type="text" name="update_category" value="<?php echo $fetch_update['category']; ?>" class="box" required placeholder="Enter food category">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Enter food price">
      <select name="update_special_day" class="box" >
         <option value="<?php echo $fetch_update['special_day']; ?>" hidden><?php echo $fetch_update['special_day']; ?></option>
         <option value=" "> </option>
         <option value="Monday">Monday</option>
         <option value="Tuesday">Tuesday</option>
         <option value="Wednesday">Wednesday</option>
         <option value="Thursday">Thursday</option>
         <option value="Friday">Friday</option>
         <option value="Saturday">Saturday</option>
         <option value="Sunday">Sunday</option>
      </select>
      <?php $available=$fetch_update['availability'] ?>
      <label class="lbl">Availability:
         <input type="radio" name="update_availability" value="Yes" class="rdo" <?php if($available=="Yes"){?> checked="true" <?php } ?> required />Yes
         <input type="radio" name="update_availability" value="No" class="rdo" <?php if($available=="No"){?> checked="true" <?php } ?>  required />No
      </label>
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_food" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>
</section>

<!-- JS file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>