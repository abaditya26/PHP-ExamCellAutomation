<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:../');
    exit;
}
include "../database.php";
include "./header.php";
$fillmarks=[];
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
$examname=$status[1][1];
$query="SELECT * FROM `exam_form` WHERE `exam_name` = '$examname' ORDER BY `branch` ASC";
$result=mysqli_query($conn,$query);
$tempform=[];
if($result){
    while($row=mysqli_fetch_row($result)){
        array_push($tempform,$row);
    }
}
$query="SELECT `seatno`, `exam_name` FROM `marks`";
$result=mysqli_query($conn,$query);
$marksfilled=[];
if($result){
    while($row=mysqli_fetch_row($result)){
        array_push($marksfilled,$row);
    }
}

$form=[];
for($i=0;$i<sizeof($tempform);$i++){
    $temp1=[];
    array_push($temp1,$tempform[$i][0]);
    array_push($temp1,$tempform[$i][1]);
    array_push($temp1,$tempform[$i][2]);
    array_push($temp1,$tempform[$i][3]);
    array_push($temp1,$tempform[$i][4]);
    array_push($temp1,$tempform[$i][5]);
    $j=0;
    for(;$j<sizeof($marksfilled);$j++){
        if($tempform[$i][4]==$marksfilled[$j][1] and $tempform[$i][5]==$marksfilled[$j][0]){
            array_push($temp1,"Success");
            break;
        }
    }
    if($j==sizeof($marksfilled)){
        array_push($temp1,"Pending");
    }
    array_push($form,$temp1);
}


?>
<div class="container"><br>
    <h3>
        Fill Students' Marks
    </h3>
    <br>
    <table class="table table-hover">
        <tr>
            <th>
                #
            </th>
            <th>
                Enrollment Number
            </th>
            <th>
                Seat No.
            </th>
            <th>
                Branch
            </th>
            <th>
                Semester
            </th>
            <th>
                Status
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php for($i=0;$i<sizeof($form);$i++){ ?>
        <tr>
            <td>
                <?php echo $i+1; ?>
            </td>
            <td>
                <?php echo $form[$i][1]; ?>
            </td>
            <td>
                <?php echo $form[$i][5]; ?>
            </td>
            <td>
                <?php echo $form[$i][3]; ?>
            </td>
            <td>
                <?php echo $form[$i][2]; ?>
            </td>
            <td>
                <?php echo $form[$i][6]; ?>
            </td>
            <td>
                <?php if($form[$i][6]=="Success"){
                    $x=$form[$i][1]."marks";
                    $_SESSION["$x"]="update";
                    ?>
                        <a href="entermarks.php?enroll=<?php echo $form[$i][1]; ?>&branch=<?php echo $form[$i][3];?>&sem=<?php echo $form[$i][2]; ?>" class="btn btn-secondary">Edit Marks</a>
                        <?php
                }else{
                    $x=$form[$i][1]."marks";
                    $_SESSION["$x"]="enter";
                    ?>
                       <a href="entermarks.php?enroll=<?php echo $form[$i][1]; ?>&branch=<?php echo $form[$i][3]; ?>&sem=<?php echo $form[$i][2]; ?>" class="btn btn-success">Fill Marks</a>
                    <?php
                } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
