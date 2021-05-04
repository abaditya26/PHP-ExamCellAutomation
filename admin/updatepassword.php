<?php
session_start();
$page = "profile";
if (!isset($_SESSION['admin'])) {
    header('location:../');
    exit;
}
if (isset($_POST['oldpassword'])) {
    extract($_POST);
    include "../database.php";
    $uname = $_SESSION['uid'];
    $query = "SELECT `pass` FROM `adminuser` WHERE `uid` = '$uname'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_row($result);
        if ($row[0] == $oldpassword) {
            $query1 = "UPDATE `adminuser` SET `pass`='$newpassword' WHERE `uid` = '$uname'";
            $result1 = mysqli_query($conn, $query1);
            if ($result1) {
?>
                <script>
                    alert('Password Changed!');
                    document.location = "./";
                </script>
            <?php
                exit;
            } else {
                echo "Error : - " . mysqli_error($conn);
            }
        } else {
            ?>
            <script>
                alert('Old Password Not Match');
                document.location = "./updatepassword.php";
            </script>
<?php
            exit;
        }
    } else {
        echo "Error : " . mysqli_error($conn);
    }
}
include "./header.php";
?><br><Br>
<div class="container" style="max-width: 550px;">
    <h3>
        Change Password
    </h3><br><Br>
    <form name="changepass" method="POST" onsubmit="return checkpass()" action="" class="form" style="padding-top: 20px;">
        <div class="form-group">
            <label for="oldpassword">
                Enter Your Old Password
            </label>
            <input type="password" name="oldpassword" id="oldpassword" required class="form-control">
        </div>
        <div class="form-group">
            <label for="newpassword">
                Enter Your New Password
            </label>
            <input type="password" name="newpassword" id="newpassword" required class="form-control">
        </div>
        <div class="form-group">
            <label for="confirmnewpassword">
                Confirm Your New Password
            </label>
            <input type="password" name="confirmnewpassword" id="confirmnewpassword" required class="form-control">
        </div>
        <input type="submit" class="btn btn-success" value="Update">
    </form>
</div>

<script>
    function checkpass() {
        var oldpassword = document.forms["changepass"]["oldpassword"].value
        var newpassword = document.forms["changepass"]["newpassword"].value
        var confirmnewpassword = document.forms["changepass"]["confirmnewpassword"].value
        if (oldpassword == newpassword) {
            alert('Both New and Old passwords are same');
            return false;
        }
        if (newpassword == confirmnewpassword) {
            return true;
        } else {
            alert('New Passwords Not Mached');
            return false;
        }
    }
</script>