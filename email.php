<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once('admin/classes/phpmailer/class.phpmailer.php');
        include("admin/classes/phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

        $mail             = new PHPMailer();

        $body = include 'template.php';

        $mail->IsSMTP(); // telling the class to use SMTP
        
        $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                                   // 1 = errors and messages
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
        $mail->Username   = "wcs.test.kbs@gmail.com";  // GMAIL username
        $mail->Password   = "test123456";            // GMAIL password

        $mail->SetFrom('name@yourdomain.com', 'First Last');

        $mail->AddReplyTo("wcs.test.kbs@gmail.com","First Last");

        $mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $mail->MsgHTML($body);

        $address = "jankaptijnz@gmail.com";
        $mail->AddAddress($address, "John Doe");


        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
          echo "Message sent!";
        }

    ?>
        
    </body>
</html>
