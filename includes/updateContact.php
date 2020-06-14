<?php
require("../includes/connect.php");

if (isset($_REQUEST['updateContact'])) 
{
    $code='+91';
    $contact = mysqli_real_escape_string($con, $_REQUEST['contact']);
    $email = $_SESSION['email'];
    $full_contact = $code.$contact;
    $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $userCount = mysqli_num_rows($result);
  
    if ($userCount > 0) 
    {
        $query = "UPDATE user SET Contact = '$full_contact' WHERE Email='$email'";
  	mysqli_query($con, $query);
        $query1 = "UPDATE user_products SET Contact = '$full_contact' WHERE Email='$email'";
  	mysqli_query($con, $query1);
  	header('location: ../home/deliveryDetails.php');
    }
}

?>
