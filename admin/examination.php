<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:../');
    exit;
}

if(isset($_GET['marksheet'])){
    extract($_GET);
    include "../database.php";
    if($marksheet=="enable"){
        $today=date("d/m/Y");
        $query="UPDATE `statuses` SET `status` = 'true',`examname`='$exam',`activatedate` = '$today' WHERE `statuses`.`name` = 'result';";
    }elseif($marksheet=="disable"){
        $query="UPDATE `statuses` SET `status` = 'false' WHERE `statuses`.`name` = 'result';";
    }else{
    }
    $result=mysqli_query($conn,$query);
    if($result){
        ?>
        <script>
            alert('Marksheet Status Changed');
            document.location='./examination.php';
        </script>
        <?php
    }else{
        ?>
        <script>
            alert('Unable to change');
            document.location='./examination.php';
        </script>
        <?php
    }
}

$page="examination";
include "./header.php";
include "../database.php";


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

?>
<div class="container">
    <center><br>
        <h2>Examination</h2>
    </center>
    <br>
    <div style="padding:20px;border: ridge; border-radius: 10px;" class="fieldset">
        <legend>
            Exam Form
        </legend>
        <div class="row">
            <div class="col-md-4">
                <?php if($status[0][0]=='false'){ ?>
                    <form action="./examform.php" method="POST" style="padding: 10px; border:ridge;border-radius: 5px; background:rgba(200,200,200,0.2);">
                        <div class="form-group">
                            <label for="exam_name">
                                Exam Name
                            </label>
                            <input type="text" name="exam_name" id="exam_name" required class="form-control" value="<?php echo $status[0][1]; ?>">
                        </div>
                        <input type="submit" class="btn btn-success">
                    </form>
                <?php }else{ ?>
                    <h4>
                        Exam Name :- <?php echo $status[0][1]; ?>
                    </h4>
                    <a href="examform.php?id=disable" class="btn btn-danger">
                        Disable Exam Form
                    </a>
                <?php } ?>
            </div>
            <?php 
            $query="SELECT * FROM `studentuser` WHERE `permitted` = 'true'";
            $result=mysqli_query($conn,$query);
            $totalstudent=0;
            if($result){
                $totalstudent=mysqli_num_rows($result);
            }
            $examname=$status[0][1];
            $query="SELECT * FROM `exam_form`  WHERE `exam_name` = '$examname'";
            $result=mysqli_query($conn,$query);
            $totalform=0;
            if($result){
                $totalform=mysqli_num_rows($result);
            }
            ?>
            <div class="col-md-4">
                Total Students :- <b><u><?php echo $totalstudent; ?></b></u><br>
            </div>
            <div class="col-md-4">
                Total Form Submitted :- <b><u><?php echo $totalform; ?></b></u><br> 
            </div>
        </div>
    </div>
        <br>
        <div>
        <!-- Hall ticket generation -->
            <div style="padding:20px;border: ridge; border-radius: 10px;" class="fieldset">
                <legend>
                    Hall Ticket
                </legend>
                <?php if($status[1][0]=='false'){ ?>
                    <a href="hallticket.php?id=enable&exam=<?php echo $status[0][1]; ?>" class="btn btn-success">
                        Enable Hall Ticket
                    </a>
                <?php }else{ ?>
                    <a href="hallticket.php?id=disable&exam=<?php echo $status[1][1]; ?>" class="btn btn-danger">
                        Disable Hall Ticket
                    </a>
                <?php } ?>
                <br><br>
            </div>
            <!-- hall ticket generation end -->
        </div>
        <br>
        <div>
            <!-- Marks Filling -->
            <div style="padding:20px;border: ridge; border-radius: 10px;" class="fieldset">
                <legend>
                    Marksheets
                </legend>
                
                <a href="./fillmarks.php" class="btn btn-success">
                    Fill Students' Marks
                </a>
                <br><br>
                
                <?php if($status[2][0]=='false'){ ?>
                    <a href="./examination.php?marksheet=enable&exam=<?php echo $status[1][1]; ?>" class="btn btn-success">
                        Enable Marksheet
                    </a>
                <?php }else{ ?>
                    <a href="./examination.php?marksheet=disable" class="btn btn-danger">
                        Disable Marksheet
                    </a>
                <?php } ?>
                <br><br>
            </div>

        <!-- Marks Filling End -->

    </div><br><Br>
</div>
<?php 

include "./footer.php";
?>