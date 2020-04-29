<?php
 
function check_if_added_to_cart($item_id) {
    $email = $_SESSION['email'];
    require("../includes/connect.php"); 
    
    $query = "SELECT * FROM user_products WHERE ProductID='$item_id' AND Email ='$email' and Status='ADDED TO CART'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
    if (mysqli_num_rows($result) >= 1) {
        return 1;
    } else {
        return 0;
    }
}

?>