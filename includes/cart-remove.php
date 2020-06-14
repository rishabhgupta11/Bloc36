<?php

require("../includes/connect.php");
if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
    $item_id = $_REQUEST["id"];
    $email = $_SESSION['email'];

    
    $query = "DELETE FROM user_products WHERE ProductID='$item_id' AND Email='$email' AND Status='ADDED TO CART'";
    mysqli_query($con, $query) or die(mysqli_error($con));
    $_SESSION['total']--;
    header("location: ../home/cart.php");
}
?>
