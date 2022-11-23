<?php
$to = "damarlavenkatasaichandana@gmail.com";
$subject = "This is a test HTML email";

$message = "Hi";

// It is mandatory to set the content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers. From is required, rest other headers are optional
$headers .= 'From: <dvs6112001@gmail.com>' . "\r\n";

if(mail($to,$subject,$message,$headers)){
    echo "sent!";
}
else{
    echo "No";
}
?>