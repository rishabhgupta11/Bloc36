<?php
    require("../includes/connect.php");
    include("../includes/fetch_css.php");
?>   

<?php
    $msg = '';
    if(isset($_POST['ConfirmCancel']))
    {
        $OrderID = $_POST['OrderID'];
        $query4 = "UPDATE order_delivery SET Status='Cancelled' WHERE OrderID='$OrderID'";
        mysqli_query($con, $query4);
        $msg = "Your order with Order ID: ".$OrderID." has been cancelled.";
    }
    else
    {
        if(isset($_POST['NoCancel']))
        {
            header('location: ../home/my_orders.php');
        }
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
        <div class="container-fluid product_page text-center">
            <div class="container-fluid cart-content" style="margin-top:10px;margin-bottom:50px;text-align:left;width:100%;">
                <a href="../home/my_orders.php"> < Go Back</a>
            </div>
            <h2 style="margin-top:50px; text-decoration:underline; margin-bottom:65px;">Current Order</h2>
            <?php echo "<p style='font-size:16px;color:black;'><b>$msg</b></p>"; ?>
            <?php
            if(isset($_POST['REVIEW']))
            {
                $OrderID = $_POST['OrderID'];
                $email = $_SESSION['email'];
            ?>
                <div class="container" style="text-align:left;">
                    <h5 style="text-decoration:underline;"><b>Order Details</b></h5>
                    <br>
                    <h6><b>Order ID :  </b><?php echo $OrderID; ?></h6>
                    <?php
                    $query = "SELECT * FROM order_payment WHERE Email='$email' AND OrderID='$OrderID'";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    while($row = mysqli_fetch_array($result))
                    {
                    ?>
                        <h6><b>Reference Code :  </b><?php echo $row['referenceCode']; ?></h6>
                        <h6><b>Payment Type :  </b><?php echo $row['paymentType']; ?></h6>
                        <?php
                        if($row['paymentType']=='Prepaid')
                        {
                        ?>
                            <h6><b>Payment ID :  </b><?php echo $row['PaymentID']; ?></h6>
                        <?php
                        }
                        ?>
                        <h6><b>Order Date :  </b><?php echo $row['Date']; ?></h6>   
                        <h6><b>Shipping Cost :  </b>Free</h6>
                        <h6><b>Order Total :  </b>INR <?php echo $row['totalAmount']; ?>/-</h6>
                    <?php
                    }
                    ?>
                    <br>
                    <br>
                    <h5 style="text-decoration:underline;"><b>Products</b></h5>
                    <?php
                    $query1 = "SELECT * FROM order_products WHERE OrderID='$OrderID'";
                    $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
                    while($row1 = mysqli_fetch_array($result1))
                    {
                        $ProductID = $row1['ProductID'];
                    ?>
                        <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                            <img src="../includes/image_view_1.php?id=<?php echo $row1['ProductID']; ?>" style="padding-left:5px; padding-right:5px; margin-right:10px;" width="110" height="150">
                            <div class="container-fluid" style="display:flex; flex-direction:column; padding:10px; border-left: 1.5px solid #c4c1c0;">
                                <?php
                                $query2 = "SELECT prod_name, prod_price, styleCode, prod_color FROM products1 WHERE ProductID='$ProductID'";
                                $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                                $row2 = mysqli_fetch_array($result2);
                                ?>
                                <h6><b>Name :  </b><?php echo $row2['prod_name']; ?></h6>
                                <h6><b>Size :  </b><?php echo $row1['Size']; ?></h6>
                                <h6><b>Quantity :  </b><?php echo $row1['Quantity']; ?></h6>
                                <h6><b>MRP :  </b>INR <?php echo $row2['prod_price']; ?>/-</h6>
                                <a href="../home/product.php?styleCode=<?php echo $row2["styleCode"]; ?>&color=<?php echo $row2['prod_color']; ?>"><h6><b>View Product</b></h6></a>
                            </div>
                        </div>
                        <br>
                    <?php
                    }
                    ?>
                    <br>
                    <br>
                    <h5 style="text-decoration:underline;"><b>Delivery Details</b></h5>
                    <?php
                    $query3 = "SELECT * FROM order_delivery WHERE OrderID='$OrderID'";
                    $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                    while($row3 = mysqli_fetch_array($result3))
                    {
                    ?>
                        <h6><b>Contact Number :  </b><?php echo $row3['Contact']; ?></h6>
                        <h6><b>Delivery Address :  </b><?php echo $row3['deliveryAddress']; ?></h6>
                        <?php
                        if($row3['Status'] == "Purchased" || $row3['Status'] == "Ordered")
                        {
                        ?>
                            <h6><b>Delivery Status :  </b>Preparing to Dispatch</h6>
                        <?php
                        }
                        else
                        {
                        ?>
                            <h6><b>Delivery Status :  </b><?php echo $row3['Status']; ?></h6>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                    <br>
                    <br>
                    <form method="POST" action="">
                        <div class="container-fluid" style="padding:0px; display:flex; flex-direction:row; justify-content:center;">
                            <input type="hidden" name="OrderID" id="OrderID" value="<?php echo $OrderID; ?>">
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="CANCEL" name="CANCEL"><span>CANCEL THIS ORDER</span></button>
                        </div>
                    </form>
                </div>
            <?php
            }
            else
            {
            ?>
                <?php
                if(isset($_POST['CANCEL']))
                {
                    $OrderID = $_POST['OrderID'];
                    $email = $_SESSION['email'];
                ?>
                    <h3 style="margin-top:50px; font-weight:bold; margin-bottom:15px;">Are you sure you want to cancel this order?</h3>
                    <form method="POST" action="">
                        <div class="container-fluid" style="padding:0px; display:flex; flex-direction:row; justify-content:center;">
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="ConfirmCancel" name="ConfirmCancel"><span>YES</span></button>
                            &emsp;
                            &emsp;
                            <input type="hidden" name="OrderID" id="OrderID" value="<?php echo $OrderID; ?>">
                            &emsp;
                            &emsp;
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="NoCancel" name="NoCancel"><span>  NO </span></button>
                        </div>
                    </form>
                    <br>
                    <br>
                    <div class="container" style="text-align:left;">
                        <h5 style="text-decoration:underline;"><b>Order Details</b></h5>
                        <br>
                        <h6><b>Order ID :  </b><?php echo $OrderID; ?></h6>
                        <?php
                        $query = "SELECT * FROM order_payment WHERE Email='$email' AND OrderID='$OrderID'";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result))
                        {
                        ?>
                            <h6><b>Reference Code :  </b><?php echo $row['referenceCode']; ?></h6>
                            <h6><b>Payment Type :  </b><?php echo $row['paymentType']; ?></h6>
                            <?php
                            if($row['paymentType']=='Prepaid')
                            {
                            ?>
                                <h6><b>Payment ID :  </b><?php echo $row['PaymentID']; ?></h6>
                            <?php
                            }
                            ?>
                            <h6><b>Order Date :  </b><?php echo $row['Date']; ?></h6>   
                            <h6><b>Shipping Cost :  </b>Free</h6>
                            <h6><b>Order Total :  </b>INR <?php echo $row['totalAmount']; ?>/-</h6>
                        <?php
                        }
                        ?>
                        <br>
                        <br>
                        <h5 style="text-decoration:underline;"><b>Products</b></h5>
                        <?php
                        $query1 = "SELECT * FROM order_products WHERE OrderID='$OrderID'";
                        $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
                        while($row1 = mysqli_fetch_array($result1))
                        {
                            $ProductID = $row1['ProductID'];
                        ?>
                            <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                                <img src="../includes/image_view_1.php?id=<?php echo $row1['ProductID']; ?>" style="padding-left:5px; padding-right:5px; margin-right:10px;" width="110" height="150">
                                <div class="container-fluid" style="display:flex; flex-direction:column; padding:10px; border-left: 1.5px solid #c4c1c0;">
                                    <?php
                                    $query2 = "SELECT prod_name, prod_price, styleCode, prod_color FROM products1 WHERE ProductID='$ProductID'";
                                    $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                                    $row2 = mysqli_fetch_array($result2);
                                    ?>
                                    <h6><b>Name :  </b><?php echo $row2['prod_name']; ?></h6>
                                    <h6><b>Size :  </b><?php echo $row1['Size']; ?></h6>
                                    <h6><b>Quantity :  </b><?php echo $row1['Quantity']; ?></h6>
                                    <h6><b>MRP :  </b>INR <?php echo $row2['prod_price']; ?>/-</h6>
                                    <a href="../home/product.php?styleCode=<?php echo $row2["styleCode"]; ?>&color=<?php echo $row2['prod_color']; ?>"><h6><b>View Product</b></h6></a>
                                </div>
                            </div>
                            <br>
                        <?php
                        }
                        ?>
                        <br>
                        <br>
                        <h5 style="text-decoration:underline;"><b>Delivery Details</b></h5>
                        <?php
                        $query3 = "SELECT * FROM order_delivery WHERE OrderID='$OrderID'";
                        $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                        while($row3 = mysqli_fetch_array($result3))
                        {
                        ?>
                            <h6><b>Contact Number :  </b><?php echo $row3['Contact']; ?></h6>
                            <h6><b>Delivery Address :  </b><?php echo $row3['deliveryAddress']; ?></h6>
                            <?php
                            if($row3['Status'] == "Purchased" || $row3['Status'] == "Ordered")
                            {
                            ?>
                                <h6><b>Delivery Status :  </b>Preparing to Dispatch</h6>
                            <?php
                            }
                            else
                            {
                            ?>
                                <h6><b>Delivery Status :  </b><?php echo $row3['Status']; ?></h6>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                        <br>
                        <br>
                    </div>
            <?php
                }
            }
            ?>
            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>    

        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>  

    </body>
</html>