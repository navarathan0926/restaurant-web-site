<?php 
 
// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
require_once '../twilio-php-main/src/Twilio/autoload.php'; 
 
use Twilio\Rest\Client; 
 
$sid    = "AC978b2a189c94a9c174be8fded63c37b0"; 
$token  = ""; 
$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create("+94779284618", // to 
                           array(  
                               "messagingServiceSid" => "MG7e2bc5107dcbd086ed01c8b5a51120db",      
                               "body" => "hello" 
                           ) 
                  ); 
 
print($message->sid);