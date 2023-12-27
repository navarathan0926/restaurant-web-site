<?php
//Your authentication key
$authKey = "73dae30eba074780d512db50b2c9bd8e";

//Multiple mobiles numbers separated by comma
$mobileNumber = "+94779284618";

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "PAC978b2a189c94a9c174be8fded63c37b0HPTPN";

//Your message to send, Add URL encoding here.
$message = urlencode("Welcome to the world of Test API");

//Define route 
$route = "default";
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="http://sms.phptpoint.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}

curl_close($ch);

echo $output;
?>