<fieldset><legend></legend></fieldset>
<?php
session_start();
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
require_once __DIR__.'/config.php';

if(isset($_POST['emailid'])){
    extract($_POST);
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        
    
    
      //check query is execute successfully or not
        
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
        $mail->addAddress($emailid);
        $mail->addReplyTo('no-reply@gmail.com');
    
        // Content
         $mail->isHTML(true); //false if you don't use html.
        $mail->Subject = $title;
        
          
          //email body
          $mail->Body = $description;
      
    
    
        if($mail->send()) {
            ?>
            <script>
              alert('Mail Sent');
              document.location="../admin/";
            </script>
            <?php
          }
          else {
            ?>
            <script>
              alert('Mail Not Sent');
              document.location="../admin/";
            </script>
            <?php
        }
    
    
    } catch (Exception $e) {
        redirectWithError("An error occurred while trying to send your message: ".$mail->ErrorInfo);
    }
    

  
}  


?>