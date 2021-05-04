<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location:../');
    exit;
}
include "../database.php";
$uid = $_SESSION['uname'];

if (isset($_POST['submit'])) {
    extract($_POST);
    $query = "UPDATE `studentuser` SET `name`='$name',`email`='$email',`mobileno`='$mobileno'  ";

    if ($_POST['updateimg'] == "yes") {
        //file upload optional
        extract($_FILES);
        $file_name = $_FILES['profileimage']['name'];
        $file_type = $_FILES['profileimage']['type'];
        $file_size = $_FILES['profileimage']['size'];
        $file_temp_loc = $_FILES['profileimage']['tmp_name'];

        $filestore = "../images/profile/profileimage($uid).jpg";
        move_uploaded_file($file_temp_loc, $filestore);
        $image = $filestore;
        $query .= ",`profile`='$image'";
    }

    $query .= "WHERE `uname` = '$uid'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $profile = [];
    if ($result) {
?>
        <script>
            alert('Profile Updated');

            document.location = "./";
        </script>
<?php
    } else {
        echo "Error";
    }
    exit;
}
include "./header.php";

$query = "SELECT * FROM `studentuser` WHERE `uname` = '$uid'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$profile = [];
if ($result) {
    $profile = mysqli_fetch_row($result);
} else {
}
?>
<div class="container" style="max-width: 800px; border:ridge; border-radius:10px; padding:20px; margin-top:3%;">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>
            Update Data
        </h3>
        <div class="form-group">
            <label for="name">
                Name
            </label>
            <input type="text" value="<?php echo $profile[2]; ?>" readonly required class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="email">
                Email ID
            </label>
            <input type="email" class="form-control" required value="<?php echo $profile[3]; ?>" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="mobileno">
                Mobile Number
            </label>
            <input type="number" class="form-control" required value="<?php echo $profile[4]; ?>" name="mobileno" id="mobileno">
        </div>
        <div class="form-group">
            <label>Old Image</label><br>
            <img src="<?php echo $profile[11]; ?>" style="max-height: 150px;"><br>

            <label>Do you want to change image?</label><br>
            <input type="radio" required onclick="activateimg()" name="updateimg" id="updateimgyes" value="yes">
            <label for="updateimgyes">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" required onclick="disableimg()" name="updateimg" id="updateimgno" value="no">
            <label for="updateimgyes">No</label>
        </div>
        <div class="form-group">
            <label for="imageinput">Select New Image </label>
            <input type="file" name="profileimage" class="form-control-file" id="imageinput">
        </div>
        <input type="submit" name="submit" class="btn btn-success">

    </form>
</div>

<script>
    function activateimg() {
        var imageinput = document.getElementById('imageinput');
        imageinput.disabled = false;
        imageinput.required = true;
    }

    function disableimg() {
        var imageinput = document.getElementById('imageinput');
        imageinput.disabled = true;
        imageinput.required = false;
        document.getElementById('updateimgno').checked = true;
    }
    disableimg();
</script>
</body>

</html>