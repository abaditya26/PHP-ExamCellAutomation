<?php  
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:../');
    exit;
}


$page = "examination";
include "./header.php";
include "../database.php";

if(isset($_POST['question'])){
    extract($_POST);
    $answer = $$select;
    echo $answer;
    $query = "INSERT INTO `questions`(`examId`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) 
    VALUES ($examId, '$question','$option1','$option2','$option3','$option4','$answer')";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "<script>alert('Question Added');document.location='viewExam.php?id=$examId';</script>";
    }else{
        echo "<script>alert('unable to add question');</script>";
    }
}

$examName = "";
$examSem = "";
$questions = [];
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM `exam-details` WHERE _id=$id";
    $result = mysqli_query($conn, $query);
    if($result){
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_row($result);
            $examName = $row[1];
            $examSem = $row[2];
        }
    }else{
        echo "<script>alert('error');document.location='./';</script>";
    }
}else{
    echo "<script>document.location='./examination.php';</script>";
    exit;
}

$query = "SELECT * FROM questions WHERE examId = $id";
$result = mysqli_query($conn, $query);
if($result){
    while($row=mysqli_fetch_row($result)){
        array_push($questions, $row);
    }
}else{
    echo "<script>alert('unable to fetch questions');</script>";
}
?>

<div class="container"><br>
    <center>
        <h3 class="font-styled-header">
            Exam Details
        </h3>
    </center>
    <div class="container" style="max-width: 800px;">
        <table class="table table-stripped">
            <tr>
                <th>
                    Exam Name :- 
                </th>
                <td>
                    <?php echo $examName; ?>
                </td>
            </tr>
            <tr>
                <th>
                    Exam Semester
                </th>
                <td>
                    <?php echo $examSem; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
        </table>
    </div>
    <center>
        <h3 class="font-styled-header">
            Add Question
        </h3>
    </center>
    <form action="./viewExam.php" method="post" style="max-width: 800px;" class="container" onsubmit="return validateAnswer()">
        <div class="form-group">
            <input type="text" name="examId" id="examId" class="form-control" style="display: none;" required value="<?php echo $id; ?>">
        </div>
        <div class="form-group">
            <input type="text" name="question" id="question" class="form-control" placeholder="Enter Question Here" required>
        </div>
        <div class="form-group">
            <input type="text" name="option1" id="option1" class="form-control" placeholder="Enter Option 1" required>
        </div>
        <div class="form-group">
            <input type="text" name="option2" id="option2" class="form-control" placeholder="Enter Option 2" required>
        </div>
        <div class="form-group">
            <input type="text" name="option3" id="option3" class="form-control" placeholder="Enter Option 3" required>
        </div>
        <div class="form-group">
            <input type="text" name="option4" id="option4" class="form-control" placeholder="Enter Option 4" required>
        </div>
        <div class="form-group">
            <select name="select" id="select" class="form-control">
                <option value="select">--Select Correct answer--</option>
                <option value="option1">option1</option>
                <option value="option2">option2</option>
                <option value="option3">option3</option>
                <option value="option4">option4</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Add Question" class="btn btn-success"> 
            <input type="reset" value="Reset" class="btn btn-danger">
        </div>
    </form>

    <div class="container">
        <center>
            <h3 class="font-styled-header">
                Added Questions
            </h3>
        </center>
        <table class="table table-stripped table-bordered">
            <tr>
                <th>
                    #
                </th>
                <th>
                    Question
                </th>
                <th>
                    Answer
                </th>
                <th>
                    Action
                </th>
            </tr>
            <?php if(sizeof($questions)==0){
                echo "<tr><th class='font-styled-header' colspan='4'><center><h3>No Questions Availiable</h3></center></th></tr>";
            } ?>
            <?php 
                for($i=0;$i<sizeof($questions);$i++){
                    ?>
                    <tr>
                        <td>
                            <?php echo $i+1; ?>
                        </td>
                        <td>
                            <?php echo $questions[$i][2]; ?>
                        </td>
                        <td>
                            <?php echo $questions[$i][7]; ?>
                        </td>
                        <td>
                            <button class="btn btn-primary">View</button>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>

<?php include "./footer.php"; ?>

<script>
    function validateAnswer(){
        const ans = document.getElementById('select').value;
        if(ans==""){
            alert('Please Select Correct Answer First')
            return false;
        }
        return true;
    }
</script>