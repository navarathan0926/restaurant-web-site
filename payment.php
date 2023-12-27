<?php
    session_start();
    $total=$_SESSION['total'];
    $user=$_SESSION['user_id'];

    include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paypal payment</title>
    <link rel="stylesheet" href="css/admin_style7.css">
</head>
<body>
    


<div id="smart-button-container">
    <div style="text-align: center"><label for="amount"> </label><input name="amountInput" type="number" id="amount" value="<?php echo $total ?>" readonly ><span> USD</span></div>
      <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
    <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"></label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
      <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
    <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container">
   
</div>
  </div>

  <section class="add-foods">
      <a href="home.php" div="btn" >Return to Home</a>
  </section>

  <script src="https://www.paypal.com/sdk/js?client-id=AUGaXdSbwYEIXZP2WwY31tI7DoS8i0X6KIJg4LXKUQbw-pjzrElZa4XCzUtQluibGtWZPgYViHjy5fQS&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
  function initPayPalButton() {
    var amount = document.querySelector('#smart-button-container #amount');
    var priceError = document.querySelector('#smart-button-container #priceLabelError');
    var invoiceid = document.querySelector('#smart-button-container #invoiceid');
    var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
    var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

    var elArr = [amount];

    if (invoiceidDiv.firstChild.innerHTML.length > 1) {
      invoiceidDiv.style.display = "block";
    }

    var purchase_units = [];
    purchase_units[0] = {};
    purchase_units[0].amount = {};

    function validate(event) {
      return event.value.length > 0;
     
    }

    paypal.Buttons({
      style: {
        color: 'gold',
        shape: 'rect',
        label: 'paypal',
        layout: 'vertical',
     
      },

      onClick: function () {
    
        if (amount.value.length < 1) {
          priceError.style.visibility = "visible";
        } else {
          priceError.style.visibility = "hidden";
        }

        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
          invoiceidError.style.visibility = "visible";
        } else {
          invoiceidError.style.visibility = "hidden";
        }

      //   purchase_units[0].description = description.value;
        purchase_units[0].amount.value = amount.value;

        if(invoiceid.value !== '') {
          purchase_units[0].invoice_id = invoiceid.value;
        }
        
      },

      createOrder: function (data, actions) {
        
        return actions.order.create({
          purchase_units: purchase_units,
        });
      },

      onApprove: function (data, actions) {

        return actions.order.capture().then(function (orderData) {
          
          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
          element.innerHTML ='';
          element.innerHTML = '<h3>Thank you for your payment!</h3> ';

          location.replace("payment_complete.php");
          
        });
      },

      onError: function (err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
  
 
  </script>

<div>
   

</div>

<!-- <a href="https://secure.2checkout.com/order/checkout.php?PRODS=4551041&QTY=1&DOTEST=1" class="option-btn">Pay here</a> -->

</body>
</html>

