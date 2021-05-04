<?php
if (isset($_POST['examName'])) {
    extract($_POST);
    include "../database.php";
    $query = "INSERT INTO `exam-details`(`exam_name`, `exam_sem`) VALUES ('$examName','$examSemester')";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if ($result) {
        echo "<script>alert('exam Added');document.location='./viewExam.php';</script>";
    } else {
        echo "<script>alert('error');document.location='./manageExam.php';</script>";
    }
    exit;
}
?>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:../');
    exit;
}


$page = "examination";
include "./header.php";
include "../database.php";
?>
<br>
<div class="container" style="max-width: 500px; border: ridge; border-radius: 20px; margin-top: 5%; margin-bottom: 5%; padding: 20px;">
    <center>
        <h3>
            Exam Management
        </h3>
        <h5>
            Add Exam
        </h5>
    </center>
    <hr class="hr" style="border-color: white;">
    <form action="./manageExam.php" method="post">
        <div class="form-group">
            <label for="examName">
                Exam Name
            </label>
            <input type="text" name="examName" id="examName" class="form-control" required placeholder="Enter Exam Name">
        </div>
        <div class="form-group">
            <label for="examSemester">
                Select Semester
            </label>
            <select name="examSemester" id="examSemester" class="form-control">
                <option value="select">--Select--</option>
                <option value="First Semester">First Semester</option>
                <option value="Second Semester">Second Semester</option>
                <option value="Third Semester">Third Semester</option>
                <option value="Forth Semester">Forth Semester</option>
                <option value="Fifth Semester">Fifth Semester</option>
                <option value="Sixth Semester">Sixth Semester</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Create" class="btn btn-success">
        </div>
    </form>

</div>
<br><br>


<?php include "./footer.php"; ?>