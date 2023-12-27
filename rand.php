<!-- <form method="post">
        <input type="submit" name="button1"
                value="Button1"/>
         
    </form>
   <?php  
      
      if(isset($_POST['button1'])) {
         include 'connection.php';
         $i=1;
        
         $sql="SELECT user_name from random_tbl where total_amount > 2000.00 order by rand() limit 3";
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
         
            mysqli_query($conn,"INSERT INTO win VALUES('$date', '$winners')");
      }
      ?> -->

