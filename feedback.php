<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if (isset($_POST['add']))
{
    $name = $_POST["name"];
    $feedback = $_POST["feedback"];
    $rating = $_POST["rating"];

    $sql = "INSERT INTO feedback_tbl(customer_name,feedback,rating) VALUES ('$name','$feedback','$rating')";
    if (mysqli_query($conn, $sql))
    {
        echo "New Rate addedddd successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- <link rel="stylesheet" href="css/admin_style8.css"> -->
   
   <link rel="stylesheet" href="css/style19.css">

</head>
<body>
<?php include 'header.php'; ?>
<div class="heading">
   
</div>

<section class="contacts">
  <form action ="" method="post">

  <h3 class="caption">Rating of you for us</h3>
  
    <div class="inputBox">
        <label>Name</label><br>
        <input type="text" name="name"  size="100">
    </div>
    <div class="inputBox">
      <label>Feedback</label></br>
     <textarea name="feedback" class="box" placeholder="Enter your message" id="" cols="40" rows="5"> </textarea>
    </div>

    <div class="rateyo" id= "rate"
         data-rateyo-rating="4"
         data-rateyo-num-stars="5"
         data-rateyo-score="3">
    </div>

    <span class='result'>0</span>
    <input type="hidden" name="rating">

    <div class="inputBox"><input type="submit" name="add" class="home-btn"> </div>

</form>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<?php include 'footer.php' ?>

<script>
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating);
        });
    });

</script>

<script src="js/script1.js"></script>

</body>
</html>