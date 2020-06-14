<?php
require("../includes/connect.php");

if (isset($_REQUEST['updateAddress'])) 
{
    $address1 = mysqli_real_escape_string($con, $_REQUEST['address31']);
    $address2 = mysqli_real_escape_string($con, $_REQUEST['address32']);
    $address3 = mysqli_real_escape_string($con, $_REQUEST['address33']);
    $address4 = mysqli_real_escape_string($con, $_REQUEST['address34']);
    $address5 = mysqli_real_escape_string($con, $_REQUEST['address35']);
    $address6 = mysqli_real_escape_string($con, $_REQUEST['address36']);
    $commaspace = ', ';
    $email = $_SESSION['email'];
    $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $userCount = mysqli_num_rows($result);
  
    if ($userCount > 0) 
    {
        $query = "UPDATE user SET Address3 = '$address1"
                . "$commaspace"
                . "$address2"
                . "$commaspace"
                . "$address3"
                . "$commaspace"
                . "$address4"
                . "$commaspace"
                . "$address5"
                . "$commaspace"
                . "$address6', PinCode3='$address6' WHERE Email='$email'";
  	mysqli_query($con, $query);
  	header('location: ../home/deliveryDetails.php');
    }
}

?>
