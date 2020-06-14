<?php

require("../includes/connect.php");
if (isset($_REQUEST['updateDeliveryAddress'])) 
{
    $email = $_SESSION['email'];
    $query4 = "SELECT Address1, Address2, Address3 FROM user WHERE Email='$email'";
    $result4 = mysqli_query($con, $query4);
    $row4 = mysqli_fetch_array($result4);
    $_SESSION['pincode'] = "";
    if($_REQUEST['address'] == $row4['Address1'])
    {
        $deliveryAddress = mysqli_real_escape_string($con, $_REQUEST['address']);

        $query1 = "SELECT Contact FROM user WHERE Email='$email'";
        $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
        while($row1 = mysqli_fetch_array($result1))
        {
            $contact = $row1["Contact"];
        }

        $query3 = "SELECT PinCode1 FROM user WHERE Email='$email' LIMIT 1";
        $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
        while($row3 = mysqli_fetch_array($result3))
        {
            $_SESSION['pincode'] = $row3["PinCode1"];
        }
        
        $query = "UPDATE user_products SET deliveryAddress = '$deliveryAddress' WHERE Email='$email' AND Status='ADDED TO CART'";
        mysqli_query($con, $query) or die(mysqli_error($con));

        $query2 = "UPDATE user_products SET Contact = '$contact' WHERE Email='$email' AND Status='ADDED TO CART'";
        mysqli_query($con, $query2) or die(mysqli_error($con));
        header('location: ../home/deliveryDetails.php');
    }
    else
    {
        if($_REQUEST['address'] == $row4['Address2'])
        {
            $deliveryAddress = mysqli_real_escape_string($con, $_REQUEST['address']);

            $query1 = "SELECT Contact FROM user WHERE Email='$email'";
            $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
            while($row1 = mysqli_fetch_array($result1))
            {
                $contact = $row1["Contact"];
            }

            $query3 = "SELECT PinCode2 FROM user WHERE Email='$email' LIMIT 1";
            $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
            while($row3 = mysqli_fetch_array($result3))
            {
                $_SESSION['pincode'] = $row3["PinCode2"];
            }

            $query = "UPDATE user_products SET deliveryAddress = '$deliveryAddress' WHERE Email='$email' AND Status='ADDED TO CART'";
            mysqli_query($con, $query) or die(mysqli_error($con));

            $query2 = "UPDATE user_products SET Contact = '$contact' WHERE Email='$email' AND Status='ADDED TO CART'";
            mysqli_query($con, $query2) or die(mysqli_error($con));
            header('location: ../home/deliveryDetails.php');
        }
        else
        {
            if($_REQUEST['address'] == $row4['Address3'])
            {
                $deliveryAddress = mysqli_real_escape_string($con, $_REQUEST['address']);

                $query1 = "SELECT Contact FROM user WHERE Email='$email'";
                $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
                while($row1 = mysqli_fetch_array($result1))
                {
                    $contact = $row1["Contact"];
                }

                $query3 = "SELECT PinCode3 FROM user WHERE Email='$email' LIMIT 1";
                $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                while($row3 = mysqli_fetch_array($result3))
                {
                    $_SESSION['pincode'] = $row3["PinCode3"];
                }

                $query = "UPDATE user_products SET deliveryAddress = '$deliveryAddress' WHERE Email='$email' AND Status='ADDED TO CART'";
                mysqli_query($con, $query) or die(mysqli_error($con));

                $query2 = "UPDATE user_products SET Contact = '$contact' WHERE Email='$email' AND Status='ADDED TO CART'";
                mysqli_query($con, $query2) or die(mysqli_error($con));
                header('location: ../home/deliveryDetails.php');
            }
        }
    }
}
?>
