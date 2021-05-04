<?php
if(!isset($_GET['id'])){
    header('location:./exams.php');
    exit;
}
extract($_GET); // $id
$page = "EXAM";
include "../database.php";
$query = "SELECT * FROM `exam-details` WHERE _id=$id";
$result = mysqli_query($conn, $query);
if($result){
    while($row = mysqli_fetch_row($result)){
        $id = $row[0];
        $name = $row[1];
        $sem = $row[2];
    }
}else{
    echo "Error => ".mysqli_error($conn);
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
    function confirmStart(){
        if(confirm('Do You Want to start exam?')){
            return true;
        }
        return false;
    }
</script>