<?php
if (!isset($_GET['id'])) {
    header('location:./exams.php');
    exit;
}
extract($_GET); // $id
session_start();
$userId = $_SESSION['uname'];
$page = "EXAM";
include "../database.php";
$query = "SELECT * FROM `exam-details` WHERE _id=$id";
$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $id = $row[0];
        $name = $row[1];
        $sem = $row[2];
    }
} else {
    echo "Error => " . mysqli_error($conn);
}

$query = "SELECT * FROM `user_exam_attempted` WHERE `user_id`='$userId'";
$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $marks = $row[3];
        $total = $row[4];
    }
} else {
    echo "Error => " . mysqli_error($conn);
}
?>
<?php include "./header.php"; ?>
<div class="container" style="max-width: 800px;">
    <center>
        <h3>
            Exam Result
        </h3>
    </center>
    <table class="table table-stripped table-bordered">
        <tr>
            <th>
                Exam Name
            </th>
            <td>
                <?php echo $name; ?>
            </td>
        </tr>
        <tr>
            <th>
                Exam Semester
            </th>
            <td>
                <?php echo $sem; ?>
            </td>
        </tr>
        <tr>
            <th>
                Exam Duration
            </th>
            <td>
                30:00 mins
            </td>
        </tr>
        <tr>
            <td>
                Marks
            </td>
            <td>
                <?php echo $marks; ?>
            </td>
        </tr>
        <tr>
            <td>
                Total
            </td>
            <td>
                <?php echo $total; ?>
            </td>
        </tr>
    </table>
</div>
<?php include "./footer.php"; ?>

<script>
    function confirmStart() {
        if (confirm('Do You Want to start exam?')) {
            return true;
        }
        return false;
    }
</script>