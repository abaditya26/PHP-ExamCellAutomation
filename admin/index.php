<?php
session_start(); 
$page="dashboard";
if(isset($_SESSION['admin'])){
    include "./header.php";
    include "../database.php";
    $query="SELECT `permitted` FROM `studentuser`";
    $result=mysqli_query($conn,$query);
    $total_students=mysqli_num_rows($result);
    $pending_students=0;
    $approved_students=0;
    if($result){
        while($row=mysqli_fetch_row($result)){
            if($row[0]=="true"){
                $approved_students++;
            }else{
                $pending_students++;
            }
        }
    }else{
        echo "error of ".mysqli_error($conn);
    }

    $query="SELECT `branch` FROM `studentuser`";
    $result1=mysqli_query($conn,$query);
    $branch=[0,0,0,0,0,0,0,0];
    if($result1){
        while($row=mysqli_fetch_row($result1)){
            if($row[0]=="Computer Engineering"){
                $branch[0]++;
            }elseif($row[0]=="Information Technology"){
                $branch[1]++;
            }elseif($row[0]=="Civil Engineering"){
                $branch[2]++;
            }elseif($row[0]=="Mechanical Engineering"){
                $branch[3]++;
            }elseif($row[0]=="Electrical Engineering"){
                $branch[4]++;
            }elseif($row[0]=="Electronics & Telecommunication Enginnering"){
                $branch[5]++;
            }elseif($row[0]=="Pharmacy"){
                $branch[6]++;
            }elseif($row[0]=="Science"){
                $branch[7]++;
            }
        }
    }else{
        echo "Error : ".mysqli_error($conn);
    }
    ?>
    <style>
        
        .card{
            background: rgba(255, 255, 255, 0.2);
        }
        .container{
            margin-top: 20px;
            margin-bottom: 20px;
            padding-top: 40px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-8"style="min-height:600px;">
                <center>
                    <h3>
                        Department Wise Applications
                    </h3>
                </center>
                <canvas class="my-4"  id="students" ></canvas>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title">Total Applications</h5>
                            <p class="card-text">
                                <h1>
                                    <?php echo $total_students; ?>
                                </h1>
                            </p>
                        </center>
                    </div>
                </div><br>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title">Approved Applications</h5>
                            <p class="card-text">
                                <h1>
                                    <?php echo $approved_students; ?>
                                </h1>
                            </p>
                        </center>
                    </div>
                </div><br>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title">Pending Applications</h5>
                            <p class="card-text">
                                <h1>
                                    <?php echo $pending_students; ?>
                                </h1>
                            </p>
                        </center>
                    </div>
                </div>


            </div>
        </div>
        
        <p>
            <center>
                <a href="./studentrequests.php" class="btn" style="color: white;">Goto Applications</a>
            </center>    
        </p>

    </div>


    <?php

}else{
    header('location:../');
}
include "./footer.php"; 
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script >
    /* globals Chart:false, feather:false */

    (function () {
    'use strict'

    feather.replace()

    // Graphs
    var ctx = document.getElementById('students')
    // eslint-disable-next-line no-unused-vars
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
        labels: [
            'Computer Engineering',
            'Information Technology',
            'Civil Engineering',
            'Mechinical Engineering',
            'Electrical Engineering',
            'Electronics & Telecommunication Engineering',
            'Pharmacy'
        ],
        datasets: [{
            data: [
            <?php echo $branch[0]; ?>,
            <?php echo $branch[1]; ?>,
            <?php echo $branch[2]; ?>,
            <?php echo $branch[3]; ?>,
            <?php echo $branch[4]; ?>,
            <?php echo $branch[5]; ?>,
            <?php echo $branch[6]; ?>,
            <?php echo $branch[7]; ?>
            ],
            borderColor: 'rgba(255,255,255,0)',
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#949FB1", "#4D5360"],
          hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774", "#A8B3C5", "#616774"]
        
        }]
        }
    })
    }())

</script>