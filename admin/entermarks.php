<?php 
    session_start();
    
    if(!isset($_SESSION['admin'])){
        header('location:../');
        exit;
    }
    include "../database.php";
    include "./header.php";
   extract($_GET);
   $_SESSION['sem']=$sem;
   $_SESSION['branch']=$branch;
   $_SESSION['enroll']=$enroll;
   $query="SELECT * FROM `subjects` WHERE `semester`='$sem' AND `course`='$branch'";

   $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
   $subjects=[];
   if($result){
       while($row=mysqli_fetch_row($result)){
           array_push($subjects,$row);
           
       }
   }



    ?>
    <div class="container"><br> 
    <?php
    
    $choice=$_SESSION[$enroll.'marks'];
    if($choice=="update"){
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
        $examname=$status[2][1];
        $query="SELECT `subject_code`, `obtained_marks` FROM `marks` WHERE `enrollment_no` = '$enroll' AND `exam_name` = '$examname'";
        
        $result=mysqli_query($conn,$query);
        $obtainedmarks=[];
        if($result){
            while($row=mysqli_fetch_row($result)){
                array_push($obtainedmarks,$row);
            }
        }
    ?>
        <h3>
            Old Marks
            
        </h3>
            <table class="table table-hover">
                <tr>
                    <td>
                        #
                    </td>
                    <td>
                        Subject    
                    </td>
                    <td>
                        Marks Obtained    
                    </td>
                </tr>
                <?php for($i=0;$i<sizeof($obtainedmarks);$i++){ ?>
                    <tr>
                        <td>
                            <?php echo $i+1; ?>
                        </td>
                        <td>
                            <?php echo $obtainedmarks[$i][0]; ?>
                        </td>
                        <td>
                            <?php echo $obtainedmarks[$i][1]; ?>
                            
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <br><br>
            <h3>
                New Marks
            </h3>
    <?php
    }
    ?>
    <form method="POST" action="uploadme.php">
        <?php for($i=0;$i<sizeof($subjects);$i++){ ?>
        <div class="form-group">
            <label for="<?php echo $subjects[$i][4]?>" style="width:100%;">   
                <div class="row">
                    <div class="col-md-6">
                        <?php 
                            echo $subjects[$i][3]." (".$subjects[$i][4].")"; 
                        ?>
                    </div>
                    <div class="col-md-2">
                        Max-marks :- 
                        <?php 
                            echo $subjects[$i][5]; 
                        ?>
                    </div>
                    <div class="col-md-2">
                        Min-Marks :- 
                        <?php 
                            echo $subjects[$i][6]; 
                        ?>
                    </div>
                    <div class="col-md-2">
                        Credits :-
                        <?php 
                            echo $subjects[$i][7]; 
                        ?>
                    </div>
                </div>
            </label>
                <input id="<?php echo $subjects[$i][4]?>" type="number" class="form-control" name="<?php echo $subjects[$i][4]?>">
                       
            </div>
            <?php
            } 
            ?><div class="form-group">
            <input type="submit" id="submit" name="submit" class="btn btn-success">
        </div>
            </form>
    </div>