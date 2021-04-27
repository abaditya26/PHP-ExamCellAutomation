<?php
session_start();
if(isset($_POST['suname'])){
    extract($_POST);
    include "./database.php";
    $query="SELECT * FROM `studentuser` WHERE `uname` = '$suname' AND `pass` = '$spassword' AND `permitted` = 'true'";
    $result=mysqli_query($conn,$query);
    if($result){
        if(mysqli_num_rows($result)==1){
            $data=mysqli_fetch_row($result);
            session_unset();
            $_SESSION['student']="in";
            $_SESSION['uname']=$suname;
            header('location:./student/');
            //transfer header;
        }else{
            ?>
            <script>
                alert('Credentials Does not match or Not Validated By Admin');
                document.location='./';
            </script>
            <?php
        }
    }else{
        echo mysqli_error($conn);
        ?>
        <script>
            alert('Error Occured');
            document.loaction='./';
        </script>
        <?php
    }
}else{
    if(isset($_SESSION['student'])){
        header('location:./student/');
    }
    include "./header.php";
    ?>
    <center>
        <form method="POST" class="form" action="login_student.php" style="max-width: 500px; width:100%; margin-top:10%; background: rgba(255, 255, 255, 0.5); padding:30px; border-radius:10px;">
            <h2>
                Students' Login
            </h2>
            <div class="form-group">
                <label for="uname">
                    User Name
                </label>
                <input type="text" name="suname" id="suname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">
                    Password
                </label>
                <input type="password" name="spassword" id="spassword" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success">
            </div>
            <div class="form-group">
                Don't have Login Yet. <a href="./registerstudent.php" style="color: white;"><u>Apply for new one.</u></a>
            </div>
        </form>
    </center>
    <?php
}
