<?php
session_start();
$page = "profile";
if (!isset($_SESSION['admin'])) {
    header('location:../');
    exit;
}
include "../database.php";
$uid = $_SESSION['uid'];
$query = "SELECT * FROM `adminuser` WHERE `_id` = '$uid'";
$result = mysqli_query($conn, $query);
$profile = ['', '', '', '', ''];
if ($result) {
    $profile = mysqli_fetch_row($result);
} else {
    echo "Error :- " . mysqli_error($conn);
}
include "./header.php";
?>

<div class="container"><br><br>
    <center>
        <img src="<?php echo $profile[7]; ?>" alt="" style="width: 200px; height:200px; border:outset;">
        <br><br>
        <h2>
            Welcome <?php echo $profile[1]; ?>
        </h2>
        <br><br>
        <div class="container" style="margin:10px; border: ridge; border-radius: 10px;padding:20px;">
            <h3>
                Profile&nbsp;&nbsp;&nbsp;
                <!-- Edit Also -->
                <a href="./editprofile.php">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </a>
            </h3>
            <br><br>
            <div style="text-align: left; padding:20px">
                <table class="table table-hover table-bordered">
                    <tr>
                        <td>
                            User ID
                        </td>
                        <td>
                            <?php echo $profile[2]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email ID
                        </td>
                        <td>
                            <?php echo $profile[4]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Designation
                        </td>
                        <td>
                            <?php echo $profile[5]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Phone Number
                        </td>
                        <td>
                            <?php echo $profile[6]; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <a href="./updatepassword.php" class="btn btn-secondary">
            Update Password
        </a>
    </center>
    <br><br>

</div>
</body>

</html>
<!-- <form action="" method="POST" style="text-align: left;">
                <div class="form-group">
                    <label for="uid">User ID</label>
                    <input class="form-control" type="" id="uid" name="uid" readonly required value="aditya_ab">
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input class="form-control" type="" id="" name="" required value="">
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input class="form-control" type="" id="" name="" required value="">
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input class="form-control" type="" id="" name="" required value="">
                </div>

                <input type="submit" class="btn btn-success">
                <br><br>
            </form> -->