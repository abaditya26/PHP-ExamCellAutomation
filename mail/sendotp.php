
<?php
session_start();
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
require_once __DIR__.'/config.php';

if(isset($_SESSION['mailing'])){
  if($_SESSION['mailing']="YES"){
    $to=$_SESSION['to'];
    $otp=$_SESSION['otp'];
    $sub="OTP For Student Verification";
    $msg="<fieldset><legend>OTP For Your Login</legend><p>OPT for your verification is <b><u>$otp</u></b> .<br>Do not share this OTP with anyone else.</p></fieldset>";

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        
      //check query is execute successfully or not
        $email = $to;
        //Server settings
        $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;
        $mail->isSMTP();
        $mail->Host = CONTACTFORM_SMTP_HOSTNAME;
        $mail->SMTPAuth = true;
        $mail->Username = CONTACTFORM_SMTP_USERNAME;
        $mail->Password = CONTACTFORM_SMTP_PASSWORD;
        $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;
        $mail->Port = CONTACTFORM_SMTP_PORT;
    
        // Recipients
        $mail->setFrom('no-reply@gmail.com', 'Aditya');
        $mail->addAddress($email);
        $mail->addReplyTo('no-reply@gmail.com');
    
        // Content
         $mail->isHTML(true); //false if you don't use html.
        $mail->Subject = $sub;
        
          
          //email body
          $mail->Body = $msg;
      
    
    
        if($mail->send()) {
            //mail not send
            echo "mailsent";
            header('location:../verify-student.php');
          }
          else {
            header('location:../');
        }
    
    
    } catch (Exception $e) {
        redirectWithError("An error occurred while trying to send your message: ".$mail->ErrorInfo);
    }
    

  }  
}  


?>