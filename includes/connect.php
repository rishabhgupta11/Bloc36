<?php
    $con= mysqli_connect("localhost","root","password","bloc36")
    or die(mysqli_error($con));
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
?>
