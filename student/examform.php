<?php 
session_start();
include "../database.php";
if(!isset($_SESSION['student'])){
    header('location:../');
    exit;
}

if(isset($_POST['eno'])){
    $query="SELECT * FROM `statuses`";
    $result=mysqli_query($conn,$query);
    $status=[];
    if($result){
        while($row=mysqli_fetch_row($result)){
            array_push($status,[$row[2],$row[3]]);
        }
    }else{
        echo mysqli_error($conn);
    }
    extract($_POST);
    $examname=$status[0][1];
    $query="SELECT COUNT(*) FROM `exam_form` WHERE branch=\"$branch\" AND `exam_name` = '$examname'";
    $result=mysqli_query($conn,$query);
    $seatno=0;
    $branchcode="";
    if($result){
        $seatno=mysqli_fetch_row($result)[0];
        $seatno++;
        $query1="SELECT `branchcode` FROM `branch` WHERE `branch` = '$branch'";
        $result1=mysqli_query($conn,$query1);
        if($result1){
            $branchcode=mysqli_fetch_row($result1)[0];
            if($seatno>=100){
                $seatno=$branchcode.$seatno;
            }elseif($seatno>=10){
                $branchcode.=0;
                $seatno=$branchcode.$seatno;
            }else{
                $branchcode.=0;
                $branchcode.=0;
                $seatno=$branchcode.$seatno;
            }
        }
    }
    $query="INSERT INTO `exam_form`(`enrollment_no`, `semester`, `branch`, `exam_name`, `seatno`) VALUES ($eno,'$semester','$branch','$exam','$seatno')";
    $result=mysqli_query($conn,$query);
    if($result){
        ?>
            <script>
                alert('Form Filled');
                document.location="./";
            </script>
        <?php
        exit;
    }   
}

$page="exam-form";
include "./header.php";
if(!$status[0][0]=="true"){
    ?>
        <script>
            document.location="./";
        </script>
    <?php
    exit;
}
$uname=$_SESSION['uname'];
$query="SELECT * FROM `studentuser` WHERE `uname` = '$uname'";
$result=mysqli_query($conn,$query);
$data=[];
if($result){
    $data=mysqli_fetch_row($result);
}else{
    echo mysqli_error($conn);
    exit;
}
$examname=$status[0][1];

$query="SELECT * FROM `exam_form` WHERE `enrollment_no` = $data[1] AND `semester` = '$data[5]' AND `branch` = '$data[6]' AND `exam_name` = '$examname'";

$result=mysqli_query($conn,$query);
if($result){
    if(mysqli_num_rows($result)>=1){
    ?>
        <script>
            alert('Form Already Filled');
            document.location="./";
        </script>
    <?php
    exit;
    }
}   
?>

<div class="container">
    <form method="POST" action="">
        <h3>
            Exam Form 
        </h3>
        <br>
        <div class="form-group">
            <label for="eno">
                Enrollment Number
            </label>
            <input type="number" name="eno" id="eno" class="form-control" required readonly value="<?php echo $data[1]; ?>">
        </div>
        <div class="form-group">
            <label for="name">
                Name
            </label>
            <input type="text" name="name" id="name" class="form-control" required readonly value="<?php echo $data[2]; ?>">
        </div>
        <div class="form-group">
            <label for="semester">
                Semester Of Exam Applying
            </label>
            <input type="text" name="semester" id="semester" class="form-control" readonly required value="<?php echo $data[5]; ?>">
        </div>
        <div class="form-group">
            <label for="branch">
                Branch Of Exam Applying
            </label>
            <input type="text" name="branch" id="branch" class="form-control" readonly required value="<?php echo $data[6]; ?>">
        </div>
        <div class="form-group">
            <label for="exam">
                Exam
            </label>
            <input type="text" name="exam" id="exam" class="form-control" readonly readonly value="<?php echo $status[0][1]; ?>">
        </div>


        <input type="submit" class="btn btn-success">
    </form>
</div><br><br>

<?php
include "./footer.php";
?>