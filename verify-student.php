<!-- code to send otp and verify the otp -->
<?php 
session_start();
if(!isset($_SESSION['to'])){
exit;
}

if(isset($_POST['userotp'])){
    extract($_POST);
    extract($_SESSION);
    $otp=$_SESSION['otp'];
    if($otp==$userotp){
        include "./database.php";
        $query="INSERT INTO `studentuser`( `enrollment_number`, `name`, `email`, `mobileno`, `semester`, `branch`, `profile`) ";
        $query.="VALUES ($enrollmentno,'$name','$emailid',$mobileno,'$semester','$branch','$filestore')";
    
        $result=mysqli_query($conn,$query) or die($error=mysqli_error($conn));
        
        if($result){
            ?>
            <script>
                alert('Your Request has been submitted and is to be validated! Once your request is approved you will recieve mail.');
                document.location='./';
            </script>
            <?php
        }else{
            ?>
            <script>
                alert('Unable to approve your status. Kindly try again');
                document.location='./';
            </script>
            <?php
        }
        exit;
    }else{
        ?>
        <script>
            alert('OTP Invalid');
        </script>
        <?php
    }
}
if(!isset($_SESSION['otp'])){
     
    
    $otp=rand(10000000,999999999);
    $_SESSION['mailing']="YES";
    $_SESSION['otp']=$otp;
    include "./header.php";
    ?>

    <div  style="margin-left: 20%; margin-top:10%; margin-bottom:20%; background: rgba(255, 255, 255, 0.5); margin-right:20%; padding:5%;">
        <h3>
            <center>
                Sending OTP...
            </center>
        </h3>
    </div>

    <?php
    include "./footer.php";
    ?>
    <script>
        document.location="./mail/sendotp.php";
        </script>
    <?php 
    echo "mail";
}else{
    //code to check otp.
    include "./header.php";
    ?>

    <div  style="margin-left: 20%; margin-top:10%; margin-bottom:10%; background: rgba(255, 255, 255, 0.5); margin-right:20%; padding:5%;">
        <h3>
            Validate OTP
        </h3>
        <p>
            We have Sent You a mail containing OTP. Please Enter the OTP below.
        </p>
        <form method="POST" action="#">
            <div class="form-group">
                <label for="userotp">
                    OTP
                </label>
                <input type="text" placeholder="OTP Here" name="userotp" id="userotp" required class="form-control">
            </div>
            <input type="submit">
        </form>
    </div>

    <?php
    include "./footer.php";
}