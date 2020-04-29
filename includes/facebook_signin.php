<?php

include('facebook_config.php');
require("../includes/connect.php");

$facebook_output = '';
$name = '';
$emailid = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code']))
{
    if(isset($_SESSION['access_token']))
    {
        $access_token = $_SESSION['access_token'];
    }
    else
    {
        $access_token = $facebook_helper->getAccessToken();

        $_SESSION['access_token'] = $access_token;

        $facebook->setDefaultAccessToken($_SESSION['access_token']);
    }

    $graph_response = $facebook->get("/me?fields=name,email", $access_token);

    $facebook_user_info = $graph_response->getGraphUser();

    if(!empty($facebook_user_info['name']))
    {
        $name = $facebook_user_info['name'];
    }

    if(!empty($facebook_user_info['email']))
    {
        $emailid = $facebook_user_info['email'];
    }
    $user_check_query = "SELECT * FROM user WHERE email='$emailid' LIMIT 1";
    $name = $firstname.$space.$lastname;
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if (!$user) 
    {
        $query = "INSERT INTO user (Name, Email) VALUES('$name', '$emailid')";
        mysqli_query($con, $query);
        $_SESSION['email'] = $emailid;
        $_SESSION['id'] = mysqli_insert_id($con);
        $_SESSION['total'] = 0;
        $_SESSION['rating'] = 0;
        header('location: ../home/index.php');
    }
    else
    {
        $_SESSION['email'] = $emailid;
        $_SESSION['id']= mysqli_insert_id($con);
        $query = "SELECT products1.prod_price AS Price, products1.ProductID, products1.prod_name AS Name FROM user_products JOIN products1 ON user_products.ProductID = products1.ProductID WHERE user_products.Email='$emailid' and Status='ADDED TO CART'";
        if($result = mysqli_query($con, $query))
        {
            $number = mysqli_num_rows($result);
        }    
        $_SESSION['total'] = $number; 
        $_SESSION['rating'] = 0;
        header('location: ../home/index.php');
    }
 
}
else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('http://localhost/BLOC36/includes/facebook_signin.php', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<a href="'.$facebook_login_url.'"><img src="../images/facebook-signin.png" style="width:40px;"></a>';
}



?>
