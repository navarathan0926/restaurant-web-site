<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="../css/admin_style7.css">
</head>
<body>
   


<div class="container2">
   <form method="post">
      <input type="submit" name="winners" class="win-btn" value="Select Winners"/>
   </form>
</div>

</body>
</html>

   <?php  
      include '../connection.php';
      if(isset($_POST['winners'])) {
         
         $i=1;
        
         $sql="SELECT user_name from random where total_amount > 3000.00 order by rand() limit 3";
         $result = mysqli_query($conn,$sql);
         $date = DATE('Y-m-d');
         
         while($row= mysqli_fetch_array($result)){
            ?>
            <tr>
               <td> <?php echo " winner ".$i." is :".$row['user_name'].'<br>'?></td>
               <?php $winner[$i]=$row['user_name']?>
            </tr>
            <?php
             $i++;
           }
           $winners=$winner[1].','.$winner[2].','.$winner[3];
            mysqli_query($conn,"INSERT INTO winner VALUES('$date', '$winners')");
      }


      
     

     ?>
