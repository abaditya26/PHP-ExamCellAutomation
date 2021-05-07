<?php 
if(isset($_POST['timer'])){
    extract($_POST);
    include "../database.php";
    $query = "UPDATE timer SET timer='$timer' WHERE userId = '$userId' AND examId=$examId";
    $r = mysqli_query($conn, $query);
    if(!($r)){
        echo "<script>console.log(\"".mysqli_error($conn)."\");</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <form action="./setTimer.php" method="post" name="timerForm">
        <input type="text" name="timer" id="timer">
        <input type="text" name="examId" id="examId">
        <input type="text" name="userId" id="userId">
    </form>
</body>
</html>