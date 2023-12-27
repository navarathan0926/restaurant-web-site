<!-- <?php
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
?> -->


<header class="header">

   <div class="flex">

      <a href="delivery.php" class="logo">Delivery Boy</a>

      <nav class="navbar">
         <a href="">Home</a>
         <a href="">Foods</a>
         <a href="">Orders</a>
         <a href="">Users</a>
         <a href="">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user-circle">
         <span class="user">
            <?php echo $_SESSION['deliveryboy_name']; ?>
            </span>
         </div> 
      </div>

      <div class="account-box">
         <a href="../logout.php" class="delete-btn">logout</a>
      </div>

   </div>

</header>