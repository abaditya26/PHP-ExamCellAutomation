<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:../');
    exit;
}


include "../database.php";
if (isset($_GET['id'])) {

    extract($_GET);

    if ($id == "disable") {
        $query = "UPDATE `statuses` SET `status` = 'false' WHERE `statuses`.`name` = 'exam form';";
    } else {
    }
    $result = mysqli_query($conn, $query);
    if ($result) {
?>
        <script>
            alert('Exam Form Filling Closed');
            document.location = './examination.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Unable to change');
            document.location = './examination.php';
        </script>
    <?php
    }
}

if (isset($_POST['exam_name'])) {
    extract($_POST);
    $today = date("d/m/Y");
    $query = "UPDATE `statuses` SET `status` = 'true',`examname`='$exam_name',`activatedate` = '$today' WHERE `statuses`.`name` = 'exam form';";
    $result = mysqli_query($conn, $query);
    if ($result) {
    ?>
        <script>
            alert('Exam Form Filling Active');
            document.location = './examination.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Unable to change');
            document.location = './examination.php';
        </script>
<?php
    }
}

?>