<?php
if(!isset($_SESSION)){
    session_start();
}
if (!isset($_GET['id'])) {
    header('location:./exams.php');
    exit;
}
extract($_GET); // $id
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
    $uid = $_SESSION['uname'];
    $query = "SELECT * FROM userquestions WHERE examId=$id AND userId='$uid'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $questions = [];
        if (mysqli_num_rows($result) == 0) {
            //new to questions add to database
            $query = "SELECT * FROM questions WHERE examId=$id";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_row($result)){
                $question = $row[2];
                $option1 = $row[3];
                $option2 = $row[4];
                $option3 = $row[5];
                $option4 = $row[6];
                $selected = "";
                $answer = $row[7];
                $userId = $uid;
                mysqli_query($conn,"INSERT INTO `userquestions`(`examId`, `userId`, `question`, `option1`, `option2`, `option3`, `option4`, `selected`, `answer`) VALUES ('$id','$userId','$question','$option1','$option2','$option3','$option4','$selected','$answer')");
            }
        }
    }
} else {
    echo "Error => " . mysqli_error($conn);
}
?>
<?php include "./header.php"; ?>
<div class="container" style="max-width: 800px;">
    <center>
        <h3>
            Exam Details
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
                Exam Duration
            </th>
            <td>
                30:00 mins
            </td>
        </tr>
        <tr>
            <th>
                Instructions
            </th>
            <td>
                <ul>
                    <li>
                        The questions will be dynamic
                    </li>
                    <li>
                        Exam will not be submitted until you click end exam
                    </li>
                    <li>
                        In case you refreshed the exam, you will need to reattempt all exam.
                    </li>
                    <li>
                        Questions might be different in each attempt
                    </li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <center>
                    <form action="./mainExam.php" method="post" onsubmit="return confirmStart()">
                        <input type="text" name="examId" id="examId" style="display: none;" value="<?php echo $id; ?>">
                        <input type="text" name="examName" id="examName" style="display: none;" value="<?php echo $name; ?>">
                        <input type="submit" value="Start Exam" class="btn btn-success">
                    </form>

                </center>
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