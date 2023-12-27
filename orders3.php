<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['delete'])){
   $delete_id = $_POST['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `food_tbl` WHERE food_name = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('../images/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `food_tbl` WHERE food_name = '$delete_id'") or die('query failed');
   header('location:admin_foods.php');
}

if(isset($_POST['add_to_cart'])){

   $food_name = $_POST['food_name'];
   $food_price = $_POST['food_price'];
   $food_image = $_POST['food_image'];
   $food_quantity = $_POST['food_quantity'];
   $t_price = $_POST['t_price'];
   $size=$_POST['size'];
 
   
   $top_price=0;
      if(!empty($_POST['toppings'])) {

         $value=$_POST['toppings'];
            $count = count($_POST['toppings']);
               $total_toppings = implode('  ', $value);

               $top_query = mysqli_query($conn, "SELECT * FROM `toppings` ") or die('query failed');
               if(mysqli_num_rows($top_query) > 0){
                  while($fetch_cus = mysqli_fetch_assoc($top_query)){
                     for($i=0;$i<$count;$i++){
                     if($value[$i]==$fetch_cus['toppings']){
                        $top_price = $fetch_cus['price']+$top_price;
                        
                     }
                  }
                  }
               } 
            }
   
   if($size=="normal" || $size=="Small"){
      $_POST['p_price'] = $food_price;
      $p_price=$_POST['p_price'];
   }          
  else if($size=="full" || $size=="Medium"){
   $_POST['p_price'] = $food_price*1.8;
   $p_price=$_POST['p_price'];
   } 
   else if($size =="Large"){
      $_POST['p_price'] = $food_price*2.5;
      $p_price=$_POST['p_price']; 
   }


   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart_tbl` WHERE food_name = '$food_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart_tbl`(user_id, food_name, price, quantity,toppings,t_price,size,p_price, image) VALUES('$user_id', '$food_name', '$food_price', '$food_quantity','$total_toppings','$top_price','$size','$p_price','$food_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }
   header('location:orders2.php');
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
   <link rel="stylesheet" href="css/style16.css">
   <link rel="stylesheet" href="css/admin_style8.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Green kitchen</h3>
</div>

<section class="products">

   <h1 class="caption">Tasty foods</h1>
   
         <?php  
            $select_category = mysqli_query($conn, "SELECT DISTINCT(category) FROM `food_tbl`  ORDER BY `category` DESC") or die('query failed');
            // $select_foods = mysqli_query($conn, "SELECT * FROM `food_tbl`") or die('query failed');
            if(mysqli_num_rows($select_category) > 0){
               while($fetch_category = mysqli_fetch_assoc($select_category)){
                  $category=$fetch_category['category'];
                  ?><h3 class="caption"><?php echo $category; ?></h3>
                  <div class="box-container"><?php
                  // $category=$fetch_category['category'];
                  $select_foods = mysqli_query($conn, "SELECT * FROM `food_tbl` WHERE category='$category' ") or die('query failed');
                  if(mysqli_num_rows($select_foods) > 0){
                     while($fetch_foods = mysqli_fetch_assoc($select_foods)){
                        ?>
                        <form action="" method="post" class="box">
                        <img class="image" src="images/<?php echo $fetch_foods['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_foods['food_name']; ?></div>
                        <div class="price">Rs<?php echo $fetch_foods['price']; ?>/-</div>
                        <!-- <input type="number" min="1" name="food_quantity" value="1" class="qty"> -->
                        <input type="hidden" name="food_name" value="<?php echo $fetch_foods['food_name']; ?>">
                        <input type="hidden" name="food_price" value="<?php echo $fetch_foods['price']; ?>">
                        <input type="hidden" name="food_image" value="<?php echo $fetch_foods['image']; ?>">
                        <!-- <button name="add_to_cart" class="add-btn"><i class="fa fa-cart-arrow-down"></i></button> -->
                        <a href="orders2.php?customize=<?php echo $fetch_foods['food_name']; ?>" class="delete-btn" >Customize</a> 
                        
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

<!-- customize section -->

<section class="edit-product-form">
   <?php
      if(isset($_GET['customize'])){
         $customize_food = $_GET['customize'];
         $customize_query = mysqli_query($conn, "SELECT * FROM `food_tbl` WHERE food_name = '$customize_food'") or die('query failed');
         if(mysqli_num_rows($customize_query) > 0){
            while($fetch_customize = mysqli_fetch_assoc($customize_query)){
   ?>
   <form action="" method="post"   enctype="multipart/form-data">
         <h3 class="box"><?php echo $customize_food ?></h3>
         <img class="image" src="images/<?php echo $fetch_customize['image']; ?>" alt="">
         <div class="box">
               <p>Add something extra:</p>
                  <?php
                     $cat=$fetch_customize['category'];
                     $toppings_tbl = mysqli_query($conn, "SELECT * FROM `toppings`") or die('query failed');
                          if(mysqli_num_rows($toppings_tbl) > 0){    
                            while($fetch_custom = mysqli_fetch_assoc($toppings_tbl)){
                             
                              $row=$fetch_custom['category_toppings'];
                              $cate = explode(",",$row);
                              foreach ($cate as $cate) { 
                                 if($cate==$cat){  
                                          
                               
                  ?>
     
                            <input type="checkbox" name="toppings[]" value="<?php echo $fetch_custom['toppings']; ?>"><?php echo $fetch_custom['toppings']." ".$fetch_custom['price'].'<br>'; ?>
                            <input type="hidden" name="t_price" value="<?php echo $fetch_custom['price']; ?>">
                  <?php
                          
                           }
                        }
                              
                            }
                        }
               ?>
         </div>
         <label for="size">Select the size:</label>
         <select name="size" class="box" >
            <!-- <option value=""  hidden>Select the size </option> -->
            <?php
            if($fetch_customize['category']=='Pizza'){
               ?>
        
            <option value="Small">Small <?php echo $fetch_customize['price'];?></option>
            <option value="Medium">Medium <?php echo ($fetch_customize['price']*1.8);?>.00</option>
            <option value="Large">Large <?php echo ($fetch_customize['price']*2.5);?>.00</option>
               <?php
            }else
              {
            ?>
            <option value="normal">Normal <?php echo $fetch_customize['price'];?></option>
            <option value="full">Full <?php echo ($fetch_customize['price']*1.8);?>.00</option>
            <?php
              }
              ?>
         </select>
         <input type="hidden" name="p_price" value="<?php echo $fetch_customize['price']; ?>">
               
         <h2> Quantity :</h2>
                <input type="number" min="1" name="food_quantity" value="1" class="qty"><br>
            <input type="hidden" name="food_name" value="<?php echo $fetch_customize['food_name']; ?>">
            <input type="hidden" name="food_price" value="<?php echo $fetch_customize['price']; ?>">
            <input type="hidden" name="food_image" value="<?php echo $fetch_customize['image']; ?>">
         <input type="submit" value="Add to cart" name="add_to_cart" class="btn">
         <input type="reset" value="cancel" id="close-customize" class="delete-btn"> 
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>
</section>



<?php include 'footer.php'; ?>

<script src="js/script2.js"></script>
<script>
   document.querySelector('#close-customize').onclick = () =>{
   document.querySelector('.edit-product-form').style.display = 'none';
   window.location.href = 'orders2.php';
}
</script>
</body>
</html>