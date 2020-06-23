<?php
    require("../includes/connect.php");
    include("../includes/fetch_css.php");
?>   

<?php
    $email = $_SESSION['email'];
    
    $query = "SELECT * FROM order_payment P JOIN order_delivery D ON P.OrderID = D.OrderID WHERE Email='$email' AND (Status='Purchased' OR Status='Ordered' OR Status='Dispatched')";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
    $query1 = "SELECT * FROM order_payment P JOIN order_delivery D ON P.OrderID = D.OrderID WHERE Email='$email' AND Status='Delivered'";
    $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
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
                <a href="../home/my_account.php"> < Go Back</a>
            </div>
            <h2 style="margin-top:50px; text-decoration:underline; margin-bottom:75px;">My Orders</h2>
            
            <div class="container" style="text-align:left;">
                <h4 style="text-decoration:underline; margin-bottom:30px;"><b>Current Orders</b></h4>
                <?php
                if(mysqli_fetch_array($result))
                {
                    $query = "SELECT * FROM order_payment P JOIN order_delivery D ON P.OrderID = D.OrderID WHERE Email='$email' AND (Status='Purchased' OR Status='Ordered' OR Status='Dispatched')";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    while ($row = mysqli_fetch_array($result))
                    {
                        $orderID = $row['OrderID'];
                        
                        $query2 = "SELECT * FROM order_products WHERE OrderID='$orderID'";
                        $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                ?>
                        <div class="container" style="padding:10px; background-color:#ebebeb; border: 0.5px solid #c4c1c0;">
                            <br>
                            <?php
                            while($row2 = mysqli_fetch_array($result2))
                            {
                            ?>
                            <img src="../includes/image_view_1.php?id=<?php echo $row2['ProductID']; ?>" style="padding-left:5px; padding-right:5px; margin-bottom:5px;" width="110" height="150">
                            <?php
                            }
                            ?>
                            <br>
                            <br>
                            <hr>
                            <?php
                            if($row['Status'] == "Purchased" || $row['Status'] == "Ordered")
                            {
                            ?>
                                <h6 style="margin:15px 0px 15px 0px;"><b>Delivery Status:</b> Preparing for Dispatch</h6>
                            <?php
                            }
                            else
                            {
                            ?>
                                <h6 style="margin:15px 0px 15px 0px;"><b>Delivery Status :  </b><?php echo $row['Status']; ?></h6>
                            <?php
                            }
                            ?>
                            <hr>
                            <h6 style="margin:15px 0px 15px 0px;"><b>Total Order Amount:</b> <?php echo $row['totalAmount']; ?></h6>
                            <h6 style="margin:15px 0px 15px 0px;"><b>Order Date:</b> <?php echo $row['Date']; ?></h6>
                            <hr>
                            <form method="POST" action="../home/edit_current_order.php" style="margin:8px 0px 0px 0px;">
                                <div class="container-fluid" style="padding:0px; display:flex; flex-direction:row;">
                                    <input type="hidden" name="OrderID" id="OrderID" value="<?php echo $row['OrderID']; ?>">
                                    <button type="submit" class="button10 button105" style="vertical-align:middle" id="REVIEW" name="REVIEW"><span>REVIEW</span></button>
                                    &nbsp;
                                    <button type="submit" class="button10 button105" style="vertical-align:middle" id="CANCEL" name="CANCEL"><span>CANCEL</span></button>
                                </div>
                            </form>
                        </div>
                        <br>
                        <br>
                <?php
                    }
                }
                else
                {
                ?>
                        <center><h6><b>You don't have any Current Orders.</b></h6></center>
                <?php
                }
                ?>
            </div>
            
            <br>
            <br>
            <br>
            
            <div class="container" style="text-align:left;">
                <h4 style="text-decoration:underline; margin-bottom:30px;"><b>Previous Orders</b></h4>
                <?php
                if(mysqli_fetch_array($result1))
                {
                    $query1 = "SELECT * FROM order_payment JOIN order_delivery ON order_payment.OrderID = order_delivery.OrderID WHERE Email='$email' AND Status='Delivered' ORDER BY deliveryDate DESC, Date DESC";
                    $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
                    while ($row1 = mysqli_fetch_array($result1))
                    {
                        $orderID2 = $row1['OrderID'];
                        
                        $query3 = "SELECT * FROM order_products WHERE OrderID='$orderID2'";
                        $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
                ?>
                        <?php
                        while($row3 = mysqli_fetch_array($result3))
                        {
                            $ProductID = $row3['ProductID'];
                            $query4 = "SELECT returnStatus FROM return_products WHERE OrderID='$orderID2' AND ProductID='$ProductID'";
                            $result4 = mysqli_query($con, $query4);
                        ?>
                            <div class="container" style="padding:10px; background-color:#ebebeb; border: 0.5px solid #c4c1c0;">
                                <br>
                                <img src="../includes/image_view_1.php?id=<?php echo $row3['ProductID']; ?>" style="padding-left:8px; padding-right:8px;" width="120" height="150">
                                <br>
                                <br>
                                <hr>
                                <?php
                                if(mysqli_num_rows($result4) > 0)
                                {
                                    $row4 = mysqli_fetch_array($result4);
                                    if($row4['returnStatus'] == "In Return")
                                    {
                                ?>
                                        <h6 style="margin:15px 0px 15px 0px;"><b>Delivery Status:</b> In Return</h6>
                                <?php
                                    }
                                    else
                                    {
                                        if($row4['returnStatus'] == "Returned")
                                        {
                                ?>
                                            <h6 style="margin:15px 0px 15px 0px;"><b>Delivery Status:</b> Returned</h6>
                                <?php
                                        }
                                    }
                                }
                                else
                                {
                                    if($row1['Status'] == "Purchased" || $row1['Status'] == "Ordered")
                                    {
                                ?>
                                        <h6 style="margin:15px 0px 15px 0px;"><b>Delivery Status:</b> Preparing for Dispatch</h6>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <h6 style="margin:15px 0px 15px 0px;"><b>Delivery Status:</b> <?php echo $row1['Status']; ?></h6>
                                <?php
                                    }
                                }
                                ?>
                                <hr>
                                <h6 style="margin:15px 0px 15px 0px;"><b>Order ID:</b> <?php echo $orderID2; ?></h6>
                                <h6 style="margin:15px 0px 15px 0px;"><b>Order Date:</b> <?php echo $row1['Date']; ?></h6>
                                <h6 style="margin:15px 0px 15px 0px;"><b>Delivery Date:</b> <?php echo $row1['deliveryDate']; ?></h6>
                                <hr>
                                <form method="POST" action="../home/edit_previous_order.php" style="margin:8px 0px 0px 0px;">
                                    <div class="container-fluid" style="padding:0px; display:flex; flex-direction:row;">
                                        <input type="hidden" name="OrderID" id="OrderID" value="<?php echo $row1['OrderID']; ?>">
                                        <input type="hidden" name="ProductID" id="ProductID" value="<?php echo $row3['ProductID']; ?>">
                                        <button type="submit" class="button10 button105" style="vertical-align:middle" id="REVIEW" name="REVIEW"><span>REVIEW</span></button>
                                        &nbsp;
                                        <?php
                                        $date = date("Y-m-d");
                                        if((strtotime($date)-strtotime($row1['deliveryDate'])) < 2592000)
                                        {
                                            if(mysqli_num_rows($result4) == 0)
                                            {
                                        ?>
                                                <button type="submit" class="button10 button105" style="vertical-align:middle" id="RETURN" name="RETURN"><span>RETURN</span></button>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <br>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                <?php
                }
                else
                {
                ?>
                <center><h6><b>You don't have any Previous Orders.</b></h6></center>
                <?php
                }
                ?>
            </div>
            
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