
<?php
session_start();
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
require_once __DIR__.'/config.php';

if(isset($_SESSION['mailing'])){
    if($_SESSION['mailing']="YES"){
    $id=$_SESSION['id'];
    $to=$_SESSION['email'];
    $name=$_SESSION['name'];
    $uname=$_SESSION['uname'];
    $password=$_SESSION['password'];


    $sub="Student Verification Success";
    $msg="<fieldset><legend>Confirmation</legend><p>Hey $name.<br> Your Account is verified by us. Now You Can Check out your account. Below are your login credentials.<br>Do not share this Credentials with anyone else.</p>";
    $msg.="<br><br><br>Username :- <b>$uname</b><br>Password :- <b>$password</b><br></fieldset>";

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
            header("location:../admin/applications.php?id=$id");
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