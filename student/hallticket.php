<?php 
if(!isset($_SESSION['student'])){
    header('location:../');
    exit;
}
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
if(!$status[1][0]=="true"){
    ?>
        <script>
            document.location="./";
        </script>
    <?php
    exit;
}
include "../database.php";
$uname=$_SESSION['uname'];
    $query="SELECT * FROM `studentuser` WHERE `uname` = '$uname'";
    $result=mysqli_query($conn,$query);
    $userdetails=[];
    if($result){
        $userdetails=mysqli_fetch_row($result);
    }else{
        echo mysqli_error($conn);
        exit;
    }
    $query="SELECT * FROM `statuses`";
    $result=mysqli_query($conn,$query);
    $status=[];
    if($result){
        while($row=mysqli_fetch_row($result)){
            array_push($status,[$row[2],$row[3],$row[4]]);
        }
    }else{
        echo mysqli_error($conn);
    }
    $examname=$status[1][1];
    $query="SELECT `seatno` FROM `exam_form` WHERE `enrollment_no` = $userdetails[1] AND `semester` = '$userdetails[5]' AND `branch` = '$userdetails[6]' AND `exam_name` = '$examname'";
    $result=mysqli_query($conn,$query);
    $seatno="";
    if($result){
        $seatno=mysqli_fetch_row($result)[0];
    }else{
        echo mysqli_error($conn);
    }
    $query="SELECT * FROM `subjects` WHERE `semester` = '$userdetails[5]' AND `course` = '$userdetails[6]'";
    $result=mysqli_query($conn,$query);
    $subjects=[];
    if($result){
        while($row=mysqli_fetch_row($result)){
            array_push($subjects,$row);
        }
    }
    timezone_open("Asia/Kolkata");
?>

<div class="container"><br>

    <div class="row">
        <div class="col-md-3">
            <img class="img" src="../images/logo.png" alt="LOGO Here" width="100px">
        </div>
        <div class="col-md-9">
            <h1 style= "text-align: center;">E CELL AUTOMATION SYSTEM </h1>
            <h4 class="enrollment" style="text-align: center;">ENROLLMENT NO :<?php echo $userdetails[1]; ?></h4>
        </div>
    </div><br>
    
    <table class="table table-bordered">
    <tbody>
    
        <tr>
            <th colspan="8" >
                Candidate Information Details :
            </th>
        </tr>
        <tr>
            <td colspan="2" > 
                Student Full Name : 
            </td>
            <td colspan="3"> 
                <?php echo $userdetails[2] ?>
            </td>
            <td colspan="2" rowspan="7" align="center" style="max-width:200px;"> 
                <img class="profile" src="<?php echo $userdetails[11]; ?>" alt="Student Profile" width="300px">
            </td>
        </tr>
        </tr>
        <tr>
            <td colspan="2">
                Semester
            </td>
            <td colspan="3">
                <?php echo $userdetails[5]; ?>
            </td>   
        </tr>
        <tr>
            <td colspan="2" >
                Branch
            </td>
            <td colspan="3">
                <?php echo $userdetails[6]; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" >
                Seat Number
            </td>
            <td colspan="3">
                <?php echo $seatno ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" >
                Exam Name
            </td>
            <td colspan="3">
                <?php echo $status[1][1]; ?>
            </td>
        </tr>
    </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <td colspan="8">
                <strong>Student Appearing Subject Details</strong>
            </td>
        </tr>
        <tr>
            <td><strong>Sr. No.</strong></td>
            <td><strong>Subject Name-Code </strong></td>
            <td><strong> Max-Marks</strong></td>
            <td><strong> Min-Marks </strong></td>
        </tr>
        <?php for($i=0;$i<sizeof($subjects);$i++){ ?>
        <tr>
            <td> <?php echo $i+1; ?> .</td>
            <td><?php echo $subjects[$i][3]; ?></td>
            <td><?php echo $subjects[$i][5]; ?></td>
            <td><?php echo $subjects[$i][6]; ?></td>
        </tr>
                <?php } ?>
        </tbody>
    </table>


    <table class="table table-bordered">
        <tbody>
            <tr>
                <td colspan="2">Student Confirmed By EXAM CELL </td>
            </tr>
            <tr>
                <td>URL :-  -site- </td>
                <td>Printed On :- <?php echo date("d/m/Y"); ?></td>
            </tr>
            <tr>
                <td >Date :-  <?php echo $status[1][2]; ?> <br> Place : </td>
                
            
                <td  align="center" style="margin: 10px auto;"><br>Signature of Student </td>
                
            </tr>
            
    </tbody>
    
    </table>
</div>