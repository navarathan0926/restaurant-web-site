<!DOCTYPE html>
<html>
<body>

<?php
$txt = "PHP";


if(isset($_POST['order_btn'])){
    $dt=$_POST['date'];
    $tm = $_POST['time'];
    $placed_on=$dt.' '.$tm.':00';
 echo 'time is '.$placed_on;
}


?>
<form action="" method="post">
 <div class="inputBox">
           
           
            <input id="show"   type="datetime-local" name="date" min="<?php echo date("Y-m-d 08:00:00"); ?>" min="<?php echo date("23:00:00"); ?>"  >
            <input id="show"   type="date" min="<?php echo date('Y-m-d'); ?>" name="date" >
            <input id="show"   type="time" min="08:00:00" max="23:00:00" value="90:00:00" name="time" >
   
        </div>
      <input type="submit" value="order now" class="option-btn" name="order_btn">
</form>

</body>
</html>
