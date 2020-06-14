<?php

require("../includes/connect.php");
if (isset($_REQUEST['ProductID']) && is_numeric($_REQUEST['ProductID'])) {
    $item_id = $_REQUEST['ProductID'];
    $email = $_SESSION['email'];

    
    $query = "DELETE FROM user_products WHERE ProductID='$item_id' AND Email='$email' AND Status='ADDED TO WISHLIST'";
    mysqli_query($con, $query) or die(mysqli_error($con));
    echo "done";
}
?>
