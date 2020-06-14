<?php
require("../includes/connect.php");

if (isset($_POST['action'])) {
    
    $item_id = $_REQUEST['ProductID'];
    $email = $_SESSION['email'];
    
    
    $query = "INSERT INTO user_products(Email, ProductID, Status) VALUES('$email', '$item_id', 'ADDED TO WISHLIST')";
    mysqli_query($con, $query) or die(mysqli_error($con));
    echo "done";
}
?>