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

<?php 
if(isset($_GET['d'])){
    $id = $_GET['id'];
    $exam = $_GET['exam'];
    $query = "DELETE FROM questions WHERE _id=$id";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "<script>alert('question deleted');document.location='./viewExam.php?id=$exam';</script>";
    }else{
        echo "<script>alert('unable to delete');</script>";
    }
}
?>
<?php 
$questionDetails = [];
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM questions WHERE _id=$id";
    $result = mysqli_query($conn, $query);
    if($result){
        if(mysqli_num_rows($result)==1){
            $questionDetails = mysqli_fetch_row($result);
        }else{
            echo "<script>alert('error to fetch data');document.location='./examination.php';</script>";
        }
    }else{
        echo "<script>alert('error to fetch data');document.location='./examination.php';</script>";
    }
}else{  
    echo "<script>document.location='./examination.php'</script>";
    exit;
}
?>
<br>
<div class="container">
    <center>
        <h3 class="font-styled-header">
            View Question Details
        </h3>
    </center>
    <br>
    <table class="table table-stripped table-bordered" style="margin-bottom: 15%;">
        <tr>
            <th>
                Question
            </th>
            <td>
                <?php echo $questionDetails[2]; ?>
            </td>
        </tr>
        <tr <?php if($questionDetails[7]==$questionDetails[3]){echo "style=\"background-color:rgba(0,255,0,0.4);\"";} ?>>
            <th>
                Option 1
            </th>
            <td>
                <?php echo $questionDetails[3]; ?>
            </td>
        </tr>
        <tr <?php if($questionDetails[7]==$questionDetails[4]){echo "style=\"background-color:rgba(0,255,0,0.4);\"";} ?>>
            <th>
                Option 2
            </th>
            <td>
                <?php echo $questionDetails[4]; ?>
            </td>
        </tr>
        <tr <?php if($questionDetails[7]==$questionDetails[5]){echo "style=\"background-color:rgba(0,255,0,0.4);\"";} ?>>
            <th>
                Option 3
            </th>
            <td>
                <?php echo $questionDetails[5]; ?>
            </td>
        </tr>
        <tr <?php if($questionDetails[7]==$questionDetails[6]){echo "style=\"background-color:rgba(0,255,0,0.4);\"";} ?>>
            <th>
                Option 4
            </th>
            <td>
                <?php echo $questionDetails[6]; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <center>
                    <button class="btn btn-danger" onclick="deleteConfirm()">
                        Delete
                    </button>
                </center>
            </td>
        </tr>
    </table>
</div>

<?php include "./footer.php"; ?>

<script>
    function deleteConfirm(){
        if(confirm('Do You Want to delete this question?')){
            document.location='./viewQuestion.php?d=1&id=<?php echo $id; ?>&exam=<?php echo $questionDetails[1]; ?>';
        }
    }
</script>