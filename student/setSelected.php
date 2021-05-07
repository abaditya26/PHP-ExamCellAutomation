<?php 
if(isset($_POST['selected'])){
    extract($_POST);
    include "../database.php";
    $query = "UPDATE userquestions SET selected = '$selected' WHERE _id=$questionID";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <form action="./setSelected.php" method="post" name="selectedForm">
        <input type="text" name="selected" id="selected">
        <input type="text" name="questionID" id="questionID">
    </form>
</body>
</html>