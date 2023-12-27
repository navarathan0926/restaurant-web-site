<?php

session_start();

$user=$_SESSION['user_id'];

include 'connection.php';

?>
<section class="add-foods">
    <div class="box-container">
        <div class="box">
        <?php
            echo "<p>Your payment successsfully credited and your order will delivered soon<p>";
        ?>
        </div>
    </div>
</section>
    
<?php
    

            $oId=mysqli_query($conn,"SELECT order_id FROM order_tbl WHERE user_id='$user' ORDER BY order_id DESC LIMIT 1");
            if(mysqli_num_rows($oId)>0){
                while($fetch_order=mysqli_fetch_assoc($oId)){
                    $order_Id=$fetch_order['order_id'];
                    mysqli_query($conn,"UPDATE order_tbl SET payment_status='completed' WHERE order_id=$order_Id");
                }
            }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment success page</title>
    <link rel="stylesheet" href="css/admin_style8.css">
</head>
<body>
    <section class="add-foods">
        <a href="home.php" div="btn" >Return to Home</a>
    </section>
</body>
</html>
