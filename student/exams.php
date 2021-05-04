<?php
$page = "EXAM";
session_start();
?>
<?php include "./header.php"; ?>

<?php
include "../database.php";
$uname = $_SESSION['uname'];
$query = "SELECT * FROM `studentuser` WHERE `uname` = '$uname'";
$result = mysqli_query($conn, $query);
$data = [];
if ($result) {
    $data = mysqli_fetch_row($result);
} else {
    echo mysqli_error($conn);
    exit;
}
$sem = $data[5];
$userId = $_SESSION['uname'];
$query = "SELECT * FROM `exam-details` WHERE exam_sem='$sem'";
$result = mysqli_query($conn, $query);
$exam = [];
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $temp = [];
        array_push($temp, $row[0]);
        array_push($temp, $row[1]);
        array_push($temp, $row[2]);
        array_push($temp, 'false');
        array_push($exam, $temp);
    }
} else {
    echo "Error" . mysqli_error($conn);
}
$query = "SELECT * FROM `user_exam_attempted` WHERE `user_id`='$userId'";
$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        for ($i = 0; $i < sizeof($exam); $i++) {
            if ($exam[$i][0] == $row[2]) {
                $exam[$i][3] = "true";
            }
        }
    }
} else {
    echo "Error => " . mysqli_error($conn);
}
?>
<div class="container">
    <center>
        <h3>
            All Assigned Exams
        </h3>

        <table class="table table-stripped">
            <thead>
                <td>
                    #
                </td>
                <td>
                    Exam Name
                </td>
                <td>
                    Status
                </td>
                <td>
                    Actions
                </td>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < sizeof($exam); $i++) {
                ?>
                    <tr>
                        <td>
                            <?php echo $i + 1; ?>
                        </td>
                        <td>
                            <?php echo $exam[$i][1]; ?>
                        </td>
                        <td>
                            <?php if ($exam[$i][3] == "false") {
                                echo "Pending";
                            } else {
                                echo "Attempted";
                            } ?>
                        </td>
                        <td>
                            <?php if ($exam[$i][3] == "false") {
                            ?>
                                <a href="./examDetails.php?id=<?php echo $exam[$i][0]; ?>" class="btn btn-primary">
                                    Attempt
                                </a>
                            <?php
                            } else {
                            ?>
                                <a href="./result.php?id=<?php echo $exam[$i][0]; ?>" class="btn btn-primary">
                                    Result
                                </a>
                            <?php
                            } ?>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </center>
</div>

<?php include "./footer.php"; ?>