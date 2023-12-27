<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin Panel</a>

      <nav class="navbar">
         <a href="admin_home.php">Home</a>
         <a href="admin_foods.php">Foods</a>
         <a href="manage_orders.php">Orders</a>
         <a href="manage_users.php">Users</a>
         <a href="manage_reply.php">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user-circle">
         <span class="user">
            <?php echo $_SESSION['admin_name']; ?>
            </span>
         </div> 
      </div>

      <div class="account-box">
         <a href="../logout.php" class="delete-btn">logout</a>
      </div>

   </div>

</header>