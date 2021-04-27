<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location:../');
        exit;
    }
    
    if(isset($_POST['uname'])){
        $id=$_SESSION['id'];
        extract($_POST);
        $_SESSION['uname']=$uname;
        $_SESSION['password']=$password;
        include "../database.php";
        $query="UPDATE `studentuser` SET `uname`='$uname',`pass`='$password',`permitted`='true' WHERE _id=$id;";
        $result=mysqli_query($conn,$query);
        if($result){
            $_SESSION['mailing']="YES";
            header("location:../mail/sendconf.php");
        }else{
            echo mysqli_error($conn);
        }
    }
?>