<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer();

    // ---------- adjust these lines ---------------------------------------
    $mail->Username = "arumoy04@gmail.com"; // your GMail user name
    $mail->Password = "library@123"; 
    $mail->AddAddress("kousikmitra143@gmail.com"); // recipients email
    $mail->FromName = "Kousik Library"; // readable name

    $mail->Subject = "Subject title";
    $mail->Body    = "Here is the message you want to send to your friend."; 
    //-----------------------------------------------------------------------
                               // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host = "ssl://smtp.gmail.com"; // GMail
    $mail->Port = 465;
    $mail->IsSMTP(); // use SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
    // $mail->SMTPSecure = 'tls';  
    $mail->From = $mail->Username;
    if(!$mail->Send())
        echo "Mailer Error: " . $mail->ErrorInfo;
    else
        echo "Message has been sent";
?>