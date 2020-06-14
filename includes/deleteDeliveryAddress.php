<?php

require("../includes/connect.php");
    $email = $_SESSION['email'];
    
    $query = "UPDATE user_products SET deliveryAddress = '' WHERE Email='$email' AND Status='ADDED TO CART'";
    mysqli_query($con, $query) or die(mysqli_error($con));
    header('location: ../home/deliveryDetails.php');
?>