<?php
require("../includes/connect.php");

if (isset($_REQUEST['reg_user'])) 
{
    $name = mysqli_real_escape_string($con, $_REQUEST['name']);
    $email = mysqli_real_escape_string($con, $_REQUEST['email']);
    $password_1 = mysqli_real_escape_string($con, $_REQUEST['password_1']);
    $password_2 = mysqli_real_escape_string($con, $_REQUEST['password_2']);

    $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);
  
    if (!$user) 
    {
  	$password = md5($password_1);
        $query = "INSERT INTO user (Name, Email, Password) VALUES('$name', '$email', '$password')";
  	mysqli_query($con, $query);
        $_SESSION['email'] = $email;
        $_SESSION['id'] = mysqli_insert_id($con);
        $_SESSION['total'] = 0;
        $_SESSION['rating'] = 0;
  	header('location: ../home/index.php');
    }
}

if (isset($_REQUEST['login_user'])) 
{
    $email = mysqli_real_escape_string($con, $_REQUEST['email']);
    $password1 = mysqli_real_escape_string($con, $_REQUEST['password']);

    
    $password = md5($password1);
    $query = "SELECT * FROM user WHERE Email='$email' AND Password='$password'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) 
    {
        $_SESSION['email'] = $email;
        $_SESSION['id']= mysqli_insert_id($con);
        $query = "SELECT products1.prod_price AS Price, products1.ProductID, products1.prod_name AS Name FROM user_products JOIN products1 ON user_products.ProductID = products1.ProductID WHERE user_products.Email='$email' and Status='ADDED TO CART'";
        if($result = mysqli_query($con, $query))
        {
            $number = mysqli_num_rows($result);
        }    
        $_SESSION['total'] = $number; 
        $_SESSION['rating'] = 0;
        header('location: ../home/index.php');
    }
}
?>