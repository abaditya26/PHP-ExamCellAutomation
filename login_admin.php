<?php
session_start();
if (isset($_POST['uname'])) {
    extract($_POST);
    include "./database.php";
    $query = "SELECT * FROM `adminuser` WHERE `uid` = '$uname' AND `pass` = '$password'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_row($result);
            $_SESSION['admin'] = "in";
            $_SESSION['uname'] = $uname;
            $_SESSION['uid'] = $data[0];
            header('location:./admin/');
            //transfer header;
        } else {
?>
            <script>
                alert('Credentials Does not match');
                document.location = './';
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert('Error Occured');
            document.loaction = './';
        </script>
    <?php
    }
} else {
    if (isset($_SESSION['admin'])) {
        header('location:./admin/');
    } else {
    }
    include "./header.php";
    ?>
    <center>
        <form method="POST" action="login_admin.php" class="form" style="max-width: 500px; width:100%; margin-top:10%; background: rgba(255, 255, 255, 0.5); padding:30px; border-radius:10px;">
            <h2>
                Admin Login
            </h2>
            <div class="form-group">
                <label for="uname">
                    User Name
                </label>
                <input type="text" name="uname" id="uname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">
                    Password
                </label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">

                <input type="submit" class="btn btn-success">

            </div>
        </form>
    </center>
<?php
}
