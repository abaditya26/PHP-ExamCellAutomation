<?php 
if(isset($_POST['data_area'])){
    session_start();
    $questions = $_SESSION['questions'];
    $userId = $_SESSION['uname'];
    $examId = $_SESSION['examId'];
    $attempted=json_decode($_POST['data_area']);
    $correct = 0;
    $total = sizeof($attempted);

    for($i=0;$i<sizeof($questions);$i++){
        for($j=0;$j<sizeof($attempted);$j++){
            if($questions[$i][0]==$attempted[$j][6]){
                if($questions[$i][7]==$attempted[$j][5]){
                    $correct++;
                }
                break;
            }
        }
    }
    include "../database.php";
    $query = "INSERT INTO `user_exam_attempted`(`user_id`, `exam_id`,`score`,`total`) VALUES('$userId',$examId,'$correct','$total')";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "<script>alert('response recorded');document.location='./exams.php';</script>";
    }else{
        echo "<script>alert('data not submitted');document.location='./exams.php';</script>";
    }
}else{
    header('location:./exams.php');
}
?>