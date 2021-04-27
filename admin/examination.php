<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:../');
    exit;
}


$page = "examination";
include "./header.php";
include "../database.php";

$query = "SELECT * FROM `exam-details` ORDER BY _id DESC";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$exams = [];
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        array_push($exams, $row);
    }
} else {
    echo "<script>alert('error');document.location='./';</script>";
}

?>
<div class="container">
    <center><br>
        <h2>Examination</h2>
        <button class="btn btn-primary" onclick="document.location='./manageExam.php'">New Exam</button>
    </center>
    <br>
    <div style="padding:20px;border: ridge; border-radius: 10px;" id="table-exam" class="fieldset">
        <table class="table table-stripped">
            <thead>
                <th>
                    #
                </th>
                <th>
                    Exam Name
                </th>
                <th>
                    Exam Semester
                </th>
                <th>
                    Manage
                </th>
            </thead>
            <tbody>
                <?php if (sizeof($exams) == 0) {
                    echo "<tr><td colspan=\"4\"><h3><center>No Exam Added</center></h3></td></tr>";
                } ?>
                <?php for ($i = 0; $i < sizeof($exams); $i++) { ?>
                    <tr>
                        <td>
                            <?php echo $i + 1; ?>
                        </td>
                        <td>
                            <?php echo $exams[$i][1]; ?>
                        </td>
                        <td>
                            <?php echo $exams[$i][2]; ?>
                        </td>
                        <td>
                            <button class="btn btn-success" onclick="document.location='./viewExam.php?id=<?php echo $exams[$i][0]; ?>'">Manage</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div><br><Br>
</div>
<?php include "./footer.php"; ?>

<script>
    document.getElementById('table-exam').style.minHeight = (window.innerHeight - 350) + "px";
</script>