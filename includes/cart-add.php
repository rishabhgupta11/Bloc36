<?php

require("../includes/connect.php");
if (isset($_REQUEST['add_cart'])) {
    $size = 'S';
    
    $item_id = $_REQUEST['id'];
    $email = $_SESSION['email'];
    $size = mysqli_real_escape_string($con, $_REQUEST['size']);
    if($quantity = mysqli_real_escape_string($con, $_REQUEST['quantity']))
    {
        $quantity = mysqli_real_escape_string($con, $_REQUEST['quantity']);
    }
    else 
    {
        $quantity = 1;
    }
    
    
    $query = "INSERT INTO user_products(Email, ProductID, Quantity, Size, Status) VALUES('$email', '$item_id', '$quantity', '$size', 'ADDED TO CART')";
    mysqli_query($con, $query) or die(mysqli_error($con));
    $_SESSION['total']++;
    header('location: ../home/cart.php');
}
?>
