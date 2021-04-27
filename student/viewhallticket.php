<?php

if(!isset($_SESSION)){
    session_start();
}
include "./header.php"; 
include "./hallticket.php";
?>
<center>
    <a target="_blank" href="./printhallticket.php" class="btn btn-secondary">
        Print
    </a>
</center><br><br><br>