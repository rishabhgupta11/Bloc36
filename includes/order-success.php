<?php
require("../includes/connect.php");
include("../includes/fetch_css.php");

if($_POST)
{
    $referenceCode = $_POST['referenceCode'];
    $email = $_SESSION['email'];

    $query2 = "UPDATE user_products SET Status='Ordered' WHERE Email='$email' AND Status='ADDED TO CART'";
    mysqli_query($con, $query2) or die(mysqli_error($con));
    
    $date = date("Y-m-d");
    $totalAmount = $_SESSION['price'];
    $query = "SELECT * FROM order_payment WHERE referenceCode='$referenceCode'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if(mysqli_num_rows($result)==0)
    {
        $query1 = "INSERT INTO order_payment(referenceCode, Email, totalAmount, paymentType, paymentStatus, Date) VALUES('$referenceCode', '$email', '$totalAmount', 'COD', 'Pending', '$date')";
        mysqli_query($con, $query1) or die(mysqli_error($con));
    }    


    $query3 = "SELECT OrderID FROM order_payment WHERE referenceCode='$referenceCode'";
    $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
    while($row3 = mysqli_fetch_array($result3))
    {
        $OrderID = $row3['OrderID'];
    }

    $query11 = "SELECT * FROM order_products WHERE OrderID='$OrderID' LIMIT 1";
    $result11 = mysqli_query($con, $query11) or die(mysqli_error($con));
    if(mysqli_num_rows($result11)==0)
    {
        $query4 = "SELECT ProductID, Quantity, Size FROM user_products WHERE Email='$email' AND Status='Ordered'";
        $result4 = mysqli_query($con, $query4);
        while($row4 = mysqli_fetch_array($result4))
        {
            $ProductID = $row4['ProductID'];
            $Quantity = $row4['Quantity'];
            $Size = $row4['Size'];
            $query5 = "INSERT INTO order_products(OrderID, ProductID, Quantity, Size) VALUES('$OrderID', '$ProductID', '$Quantity', '$Size')"; 
            mysqli_query($con, $query5);
            $query8 = "SELECT inventory_size_".strtolower($Size)." FROM  products1 WHERE ProductID='$ProductID'";
            $result8 = mysqli_query($con, $query8);
            $row8 = mysqli_fetch_array($result8);
            $inventorySize = $row8['inventory_size_'.strtolower($Size)];
            $inventorySize = $inventorySize - $Quantity;
            $query9 = "UPDATE products1 SET inventory_size_".strtolower($Size)."='$inventorySize' WHERE ProductID='$ProductID'";
            mysqli_query($con, $query9);
        }
    }    

    $query5 = "SELECT Contact, deliveryAddress, Status FROM user_products WHERE Email='$email' AND Status='Ordered' LIMIT 1";
    $result5 = mysqli_query($con, $query5);
    while($row5 = mysqli_fetch_array($result5))
    {
        $Contact = $row5['Contact'];
        $deliveryAddress = $row5['deliveryAddress'];
        $Status = $row5['Status'];
    }
    $query12 = "SELECT * FROM order_delivery WHERE OrderID='$OrderID'";
    $result12 = mysqli_query($con, $query12) or die(mysqli_error($con));
    if(mysqli_num_rows($result12)==0)
    {
        $query6 = "INSERT INTO order_delivery(OrderID, Contact, deliveryAddress, Status) VALUES('$OrderID', '$Contact', '$deliveryAddress', '$Status')"; 
        mysqli_query($con, $query6);
    }

    $query7 = "DELETE FROM user_products WHERE Email='$email' AND Status='Ordered'";
    mysqli_query($con, $query7);
    $_SESSION['total']=0;
}

?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link href="<?php echo $cssfilename; ?>" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <title>BLOC36</title>
    </head>
    <body>
        <?php
        include("../includes/header.php");
        ?>
        
        <div class="container-fluid cart-page">
            <center>
                <h2 style='margin-top:200px; color:#212a2f;'><b>Order placed successfully.</b></h2> 
                <br>
                <h2 style='color:#212a2f;'>Your <b>Order ID</b> is: <b><?php echo $OrderID; ?></b></h2>
                <br>
                <h2 style='color:#212a2f;'>and <b>Reference Code</b> is: <b><?php echo $referenceCode; ?></b></h2>
            </center>
            <div class="container-fluid cart-content" style="margin-top:150px;margin-bottom:100px;width:100%;justify-content:center;">
                <div class="row">
                    <div class="col text-center">
                        <a href="../products/women.php">CONTINUE SHOPPING</a>
                    </div>
                </div>    
            </div>
        </div> 
        
        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>      
    </body>
</html>
