<header class="header">
   <div class="header-2">
      <div class="flex">

      <a><img src="images/green.png" height="60" width="100"></a>
         <nav class="navbar">
        
            <a href="home.php" title="to home page">Home</a>
            <a href="about_us.php">About</a>
            <a href="orders2.php">Foods</a>
            <a href="myorder.php">My orders</a>
            <a href="help_line.php">Help</a>
            <a href="feedback.php">Feedback</a>
         </nav>

         <div class="icons">
           
            
            
         <?php     
         if(isset( $_SESSION['user_id'])){
            
            ?>
            <div id="user-btn" class="fas fa-user-circle ">
               <span class="user">
               <?php echo $_SESSION['user_name']; ?>
               </span>
            </div>
            <div class="user-box">
            <a href="logout.php" class="delete-btn">logout</a>
      </div>
      <?php
      }
      ?>
           
            <?php
               if(isset($_SESSION['user_id'])){

                  $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart_tbl` WHERE user_id = '$user_id'") or die('query failed');
                  $cart_rows_number = mysqli_num_rows($select_cart_number); 
                  ?>
                   <a href="cart2.php"> <i class="fa fa-cart-arrow-down"></i><span>(<?php echo $cart_rows_number; ?>)</span> </a>
                   <?php
                }
             
            ?>
           <div id="menu-btn" class="fas fa-bars"></div> 
         </div>
       
         
     
   </div>
   
</header>