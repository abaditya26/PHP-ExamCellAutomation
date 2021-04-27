<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header('location:../');
    exit;
}


include "../database.php";
if(isset($_GET['id'])){
    extract($_GET);
    if($id=="enable"){
        $today=date("d/m/Y");
        $query="UPDATE `statuses` SET `status` = 'true',`examname`='$exam',`activatedate` = '$today' WHERE `statuses`.`name` = 'hall ticket';";
    }elseif($id=="disable"){
        $query="UPDATE `statuses` SET `status` = 'false',`examname`='$exam' WHERE `statuses`.`name` = 'hall ticket';";
    }else{
    }
    $result=mysqli_query($conn,$query);
    if($result){
        ?>
        <script>
            alert('Hall ticket Status Changed');
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

?>