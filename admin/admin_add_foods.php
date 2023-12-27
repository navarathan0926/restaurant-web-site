<?php

include '../connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
};

if(isset($_POST['add_food'])){

   $name = mysqli_real_escape_string($conn, $_POST['food_name']);
   $category =  $_POST['food_category'];
   $price = $_POST['price'];
   $special_day=$_POST['special_day'];
   $availability=$_POST['availability'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../images/'.$image;

   $select_food_name = mysqli_query($conn, "SELECT food_name FROM `food_tbl` WHERE food_name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_food_name) > 0){
      $message[] = 'food name already added';
   }else{
      $add_food_query = mysqli_query($conn, "INSERT INTO `food_tbl`(food_name, category, price, image, special_day, availability) VALUES('$name', '$category', '$price', '$image', '$special_day', '$availability')") or die('query failed');

      if($add_food_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'food added successfully!';
         }
      }else{
         $message[] = 'food could not be added!';
      }
   }
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

</head>
<body>
   
<?php include 'admin_header.php'; ?>



<h1 class="title">Food Items</h1>

<section class="add-foods">


   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add food</h3>
      <input type="text" name="food_name" class="box" placeholder="Enter food name" required>
      <input type="text" name="food_category" class="box" placeholder="Enter food category" required>
      <input type="number" min="0" name="price" class="box" placeholder="Enter food price" required>
      <select name="special_day" class="box" required>
         <option value="" disabled selected hidden>Select your option</option>
         <option value=""></option>
         <option value="Monday">Monday</option>
         <option value="Tuesday">Tuesday</option>
         <option value="Wednesday">Wednesday</option>
         <option value="Thursday">Thursday</option>
         <option value="Friday">Friday</option>
         <option value="Saturday">Saturday</option>
         <option value="Sunday">Sunday</option>
      </select>
      <label class="lbl">Availability:
         <input type="radio" name="availability" value="Yes" class="rdo" required />Yes
         <input type="radio" name="availability" value="No" class="rdo" required />No
      </label>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="Add food" name="add_food" class="btn">
   </form>

</section>




<!-- custom admin js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>