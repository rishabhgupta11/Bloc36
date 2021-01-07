<?php
    $conn = new mysqli("localhost","root","password","bloc36");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
?>

