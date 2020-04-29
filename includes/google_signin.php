<?php
include('google_config.php');
require("../includes/connect.php");

$login_button = '';
$firstname = '';
$lastname = '';
$emailid = '';
$space = ' ';
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if(!isset($token['error']))
    {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Get user profile data from google
        $data = $google_service->userinfo->get();

        //Below you can find Get profile data and store into $_SESSION variable
        if(!empty($data['given_name']))
        {
            $firstname = $data['given_name'];
        }

        if(!empty($data['family_name']))
        {
            $lastname = $data['family_name'];
        }

        if(!empty($data['email']))
        {
            $emailid = $data['email'];
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
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
    //Create a URL to obtain user authorization
    $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="../images/google-signin.png" style="width:50px;"></a>';
}

?>