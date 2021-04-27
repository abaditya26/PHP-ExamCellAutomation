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
if(!$status[2][0]=="true"){
    ?>
        <script>
            document.location="./";
        </script>
    <?php
    exit;
}
if(!isset($_SESSION)){
    session_start();
    ?>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Cell Automation</title>
    <link rel="icon" href="./images/logo.png">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <style>
        .nav-item{
            text-align: center;
        }
        .carousel-caption{
            background-color: rgba(0, 0, 0, 0.5);
        }
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
        
        .header{
            margin:0px;
        }
    </style>
    </head>
    <body>
    <?php
}

include "../database.php";
$uname=$_SESSION['uname'];

$query="SELECT * FROM `studentuser` WHERE `uname` = '$uname'";
$result=mysqli_query($conn,$query);
$student=[];
if($result){
    $student=mysqli_fetch_row($result);
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

    $enrollment_no=$student[1];
    $exam_name=$status[2][1];

    $query="SELECT * FROM `marks` WHERE `enrollment_no` = '$enrollment_no' AND `exam_name` = '$exam_name'";
    $result=mysqli_query($conn,$query);
    $tempmarks=[];
    if($result){
        while($row=mysqli_fetch_row($result)){
            $seatno=$row[2];
            array_push($tempmarks,$row);
        }
    }

    $marks=[];
    for($i=0;$i<sizeof($tempmarks);$i++){
        $temp=[];
        $code=$tempmarks[$i][4];
        $query="SELECT `subjects` FROM `subjects` WHERE `subject_code` = '$code'";
        $result=mysqli_query($conn,$query);
        if($result){
            array_push($temp,mysqli_fetch_row($result)[0]);
        }else{
            array_push($temp,"");
        }
        array_push($temp,$tempmarks[$i][5]);
        array_push($temp,$tempmarks[$i][6]);
        array_push($temp,$tempmarks[$i][7]);
        array_push($temp,$tempmarks[$i][8]);
        array_push($marks,$temp);
    }



    $back=0;
    $totalmarks=0;
    $totalcredits=0;
    $obtainedmarks=0;
?>

<style>

        body
       {
           font-family:Calibri;
       }

       .tableRecordPadding
       {
           font-weight:bold; 
           padding:2px 0 2px 2px;
       }

        .Error
       {
           text-align: center;
           margin: 70px 0;
           color: red;
           font-size: 1.5em;
       }

            .Error1
       {
           text-align: center;
           color: red;
           font-size: 1.5em;
       }


       .statment
       {
           font-family: Calibri; 
           text-align:center;
           margin-top:20px;
           text-transform:uppercase;
       }


       .tbl tr td
       {   
           padding:2px 5px; 
       }

       .Instruct
       {
           display:table-cell;

       }



       * {
           margin:0px;
           padding:0px;

       }

       .main {
            width: 1050px;
           height: auto;
           border: 3px dotted ;
           margin: auto;
           padding: 10px;
       }


    .heading {
            width:100%;
            height:100px;
    }


       .heading h1, h3 {

           font-family: cursive;
           text-align:center


       }


       .img {
           width:10%;
           height:100px;
           float:left;
           margin-left:15px;
    }

       .td
       {

          /*border-left:1px solid;
          border-right:1px solid;
          border-bottom:1px solid;*/
           height:15px;
           width:205px;
          text-align:center;
       }

       .td1
       {
           /*border: 1px solid;*/
           height: 15px;
           width:80px;
           text-align:center;
         
        
       }
       table, th, td {
        border: 1px solid;
        border-collapse: collapse;
        }

       .col
       {
           border:0px;
           border-bottom:1px dashed;
           border-collapse:collapse;
           height:40px;
       }
</style>


<br><Br>
<div class="main">
    <img class="img" src="../images/logo.png" alt="LOGO Here" border="0">
   
   <div class="heading">
   <h1 style="font-size:41px;">EXAM CELL AUTOMATION SYSTEM</h1>
   <h3 class="statment">Statement of Marks</h3>
   </div>
   <div>
       <br><Br>
       <table class="table table-bordered">
            <tr>
                <td colspan="4">
                    MR. / MS. <?php echo $student[2]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    ENROLLMENT NO. :- <?php echo $student[1]; ?> 
                </td>
                <td>
                    SEAT NO. :- 
                    <?php 
                        if(isset($seatno)){
                            echo $seatno;
                        }else{
                            echo "Exam Form not Filled";
                        }
                    ?> 
                </td>
                <td>
                    Semester :- <?php echo $student[5]; ?>
                </td>
                <td>
                    COURSE :- <?php echo $student[6]; ?>
                </td>
            </tr>
       </table>
       
       <br>
    <div id="dvMain0">
        <table  class="table" align="center">
        
            <tr>
                <td rowspan="2">
                    <strong><br>TITLE OF COURSES</strong>
                </td>
                
                <td colspan="3"class="text-center">
                    <strong>TOTAL MARKS</strong>
                </td>
                <td class="text-center" rowspan="2" style="max-width: 50px;">
                    <strong><br>CREDITS</strong>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <strong>MAX.</strong>
                </td>
                <td class="text-center">
                    <strong>MIN. </strong>
                </td class="text-center">
                <td class="text-center">
                    <strong>OBT.</strong>
                </td>
                
            </tr>
            <?php 
            // if(sizeof($marks)==0){
            //     echo "<center><h3>No Subject Availiable or Examiner has not filled up your marks.<br><br></h3></center>";
            // }
            for($i=0;$i<sizeof($marks);$i++){ ?>
            <tr>
                <td >
                    <strong>

                        <!-- subject name -->
                        <?php
                        if($marks[$i][3]<$marks[$i][2]){
                            echo "<b style=\"color:red;\">*</b>";
                        }
                        echo $marks[$i][0]; ?>
                    </strong>
                </td>
                
                <td align="center">
                <!-- max marks -->
                <?php 
                    echo $marks[$i][1]; 
                    $totalmarks+=$marks[$i][1];
                ?>
                </td>
                <td align="center">
                        <!-- min marks -->
                        <?php 
                            echo $marks[$i][2];
                                
                        ?>
                </td>
                <td align="center">
                        <!-- obtianed marks -->
                        <?php 
                            if($marks[$i][3]>=$marks[$i][2]){
                                echo $marks[$i][3];
                                $obtainedmarks+=$marks[$i][3]+$marks[$i][4];    
                            }else{
                                echo $marks[$i][3];
                                $back++;
                                $marks[$i][4]=0;
                                $obtainedmarks+=$marks[$i][3];    
                            }
                        ?>
                </td>
                <td  align="center">
                <!-- credits -->
                <?php 
                    echo $marks[$i][4];
                    $totalcredits+=$marks[$i][4];    
                ?>
                </td>
            </tr>
            
            
            <?php } ?>
           
        </tbody>
    </table>
</div>
<br>

<?php
    
    // script to check allowed back
    $totalsubjects=sizeof($marks);
    $allowedback=$totalsubjects/3;
    $allowedback%=1;
    if($allowedback==0){
        $allowedback=1;
    }
    // script to check allowed back end

    if($back==0){
        if($totalmarks==0){
            $percent=($obtainedmarks*100)/($totalmarks+1);
        }else{
            $percent=($obtainedmarks*100)/$totalmarks;
        }
        if($percent>75){
            $result="First Class Dist.";
        }elseif($percent>60){
            $result="First Class";
        }elseif($percent>=40){
            $result="Second Class";
        }else{
            $result="Fail";
        }
    }elseif($back<=$allowedback){
        $result="A.T.K.T.";
        $percent="--";
    }else{
        $percent="-";
        $result="Y.D.";
    }
?>
    <div id="dvTotal0">
        <table class="tbl" widht="0" cellspacing="0" border="1" align="center">
            <tbody>
                <tr>
                    <td rowspan="3" width="150px" height="30px" align="left">
                        <strong>DATE : </strong><br> <?php echo $status[2][2]; ?>
                    </td>
                    <td rowspan="3" width="600px" height="30px" align="center">
                        <span>This Marksheet is Generated by Exam Cell Automation System</span>
                    </td>
                    <td width="150px" height="30px" align="center">
                        <strong>TOTAL MAX.<br> MARKS</strong>
                    </td>
                    <td width="150px" height="30px" align="center">
                        <strong>RESULT WITH<br>%</strong>
                    </td>
                    <td width="150px" height="30px" align="center">
                        <strong>TOTAL MARKS<br> OBTAINED </strong>
                    </td>
                    <td width="100px" height="30px" align="center">
                        <strong>TOTAL CREDIT<br> </strong>
                    </td>
                </tr>
                <tr>
                    <td width="150px" height="30px" align="center">
                        <?php echo $totalmarks; ?>
                    </td>
                    <td width="150px" height="30px" align="center">
                        <?php echo $percent; ?>
                    </td>
                    <td width="150px" height="30px" align="center">
                        <?php echo $obtainedmarks; ?>
                    </td>
                    <td width="150px" height="30px" align="center">
                        <?php echo $totalcredits; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" width="150px" height="30px" align="center">
                        <strong><?php echo $result; ?></strong>  
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

   </div>
   <table class="table table-bordered">
<tbody style="text-align: center;">
  
      <tr>
          <th colspan="8" >
            INSTRUCTIONS
          </th>
      </tr>
    <tr>
        <td colspan="3"> 
            <span class="Instruct"> 1.</span>
            <span class="Instruct">Report Discrepancy in this certificate to Head of the institution.</span>
        </td>
        <td colspan="5"> 
            <span class="Instruct"> 2.</span>
            <span class="Instruct">This certificate of marks is issued as per prevaling rules and regulations of MSBTE at the time of this exam.</span>
        </td>
    </tr>
   <tr>
        <td colspan="3">
            <span class="Instruct"> 3.</span>
            <span class="Instruct">Eligibility for III semester is based on total number of failure subjects in I &amp; II semesters taken  together.</span>
        </td>
        <td colspan="5">
            <span class="Instruct"> 4.</span>
            <span class="Instruct">Candidate is eligible for admission to V/VII Semester only if he/she is fully passed in I &amp; II /III &amp; IV semesters &amp; availed benefit of A.T.K.T/PASS at III &amp; IV /V &amp; VI semesters taken together respectively.</span>
        </td>
    </tr>
    <tr>
        <td colspan="8"> 
            <span class="Instruct"> 5.</span>
            <span class="Instruct">Class awarded for Diploma is based on aggregate marks obtained in pre-final &amp; final semester.</span>
        </td>
    </tr>
    <tr>
        <td colspan="8" align="center">
            <strong>ABBREVATION DETAILS</strong>
        </td>
    </tr>
    <tr style="text-align: center;">
        <td class="td1">AB</td>
        <td class="td">Absent</td>
        <td class="td1">%</td>
        <td class="td">Percentage of Marks</td>
        <td class="td1">OTP</td>
        <td class="td">Optional</td>
        <td class="td1">AG</td>
        <td class="td">Aggregate</td>
    </tr>
    <tr>
        <td class="td1">IT</td>
        <td class="td">Industrial Training</td>
        <td class="td1">CON</td>
        <td class="td">Condoned</td>
        <td class="td1">@</td>
        <td class="td">Condoned Marks</td>
        <td class="td1" >DIST</td>
        <td class="td" >Distinction</td>
    </tr>
    
    <tr>
        <td class="td1">*</td>
        <td class="td">Failure Marks</td>
        <td class="td1">A.T.K.T</td>
        <td class="td">Allowed to Keep Term</td>
        <td class="td1">OR</td>
        <td class="td">Oral</td>
        <td class="td1">C#</td>
        <td class="td">Carry Forward Marks</td>
    </tr>
    <tr>
    </tr>
        
        <tr style="text-align: justify;">
            <td colspan="5">Result Declared On :- <?php echo $status[2][2]; ?></td>
            <td colspan="4" style="text-align:right">Url:-#################</td>
        </tr>
</tbody>
  
</table>
</div>
<br><br>
