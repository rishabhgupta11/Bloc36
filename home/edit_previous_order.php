<?php
    require("../includes/connect.php");
?>   

<?php
    $msg = '';
    if(isset($_POST['ConfirmReturn']))
    {
        if(!empty($_POST['return_product']))
        {
            $OrderID = $_POST['OrderID'];
            $returnPickup = $_POST['return_pickup'];
            $returnReason = $_POST['return_reason'];
            $returnQuantity = $_POST['return_quantity'];
            foreach($_POST['return_product'] as $returnProduct)
            {
                $query6 = "SELECT prod_price FROM products1 WHERE ProductID='$returnProduct'";
                $result6 = mysqli_query($con, $query6);
                $row6 = mysqli_fetch_array($result6);
                $refundAmount = $row6['prod_price'] * $returnQuantity;
                
                $query8 = "SELECT * FROM return_products WHERE OrderID='$OrderID' AND ProductID='$returnProduct'";
                $result8 = mysqli_query($con, $query8);
                if(mysqli_num_rows($result8)==0)
                {
                    $query7 = "INSERT INTO return_products(OrderID, ProductID, exchangeProduct, returnQuantity, returnStatus, returnAddress, refundAmount, refundStatus, returnReason) VALUES('$OrderID', '$returnProduct', 'no', '$returnQuantity', 'In Return', '$returnPickup','$refundAmount', 'Pending', '$returnReason')";
                    mysqli_query($con, $query7);
                }    
            }
            $msg = "Your order with Order ID: ".$OrderID." and ProductID: ".$returnProduct." is being processed for Return.";  
            
            if(isset($_POST['account_number']) && isset($_POST['ifsc_code']) && isset($_POST['benef_name']))
            {
                $commaspace = ', ';
                $bankAccount = $_POST['account_number'].$commaspace.$_POST['ifsc_code'].$commaspace.$_POST['benef_name'];
                $query10 = "UPDATE return_products SET bankAccount='$bankAccount' WHERE OrderID='$OrderID' AND ProductID='$returnProduct'";
                mysqli_query($con, $query10);
            }
            else
            {
                if(isset($_POST['upi_id']))
                {
                    $UpiID = $_POST['upi_id'];
                    $query11 = "UPDATE return_products SET UpiID='$UpiID' WHERE OrderID='$OrderID' AND ProductID='$returnProduct'";
                    mysqli_query($con, $query11);
                }
                else
                {
                    $msg = "Error in saving refund details. <a href='../home/my_orders.php'>Go Back</a>";
                }
            }
        }
        else
        {
            $msg = "No product was selected. <a href='../home/my_orders.php'>Go Back</a>";
        }
    }
    else
    {
        if(isset($_POST['NoReturn']))
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
        <link href="../css/style.css" rel="stylesheet" type="text/css">
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
            
            <?php echo "<p style='font-size:16px;color:black;margin-top:100px;'><b>$msg</b></p>"; ?>
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
                                $query2 = "SELECT styleCode, prod_color, prod_name, prod_price FROM products1 WHERE ProductID='$ProductID'";
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
            else
            {
            ?>
                <?php
                if(isset($_POST['RETURN']))
                {
                    $OrderID = $_POST['OrderID'];
                    $email = $_SESSION['email'];
                    $ProductID = $_POST['ProductID']
                ?>
            
                    <h3 style="margin-top:50px; font-weight:bold; margin-bottom:15px;">Confirm the product for return</h3>
                    <div style="display:flex; justify-content:center;">
                    <h6 style="font-weight:bold; margin-bottom:15px;padding-top:3px;">or </h6>
                    <form method="POST" action="../home/exchange-product.php">
                        <input type="hidden" name="ProductID" id="ProductID" value="<?php echo $ProductID; ?>">
                        <input type="hidden" name="OrderID" id="OrderID" value="<?php echo $OrderID; ?>">
                        <input type="submit" value="click here" name="exchange-product" style="border:none;color:blue;font-weight:bold;font-size:16px;background-color:#f5f5f5;">
                    </form>
                    <h6 style="font-weight:bold; margin-bottom:15px;padding-top:3px;"> to request a replacement</h6>
                    </div>    
                    <form method="POST" action="">
                        <div class="container" style="text-align:left;">
                            <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                                <div style="padding-top:70px; padding-right:10px; border-right:1.5px solid #c4c1c0;">
                                    <input type="checkbox" name="return_product[]" value="<?php echo $ProductID; ?>">
                                </div>
                                <img src="../includes/image_view_1.php?id=<?php echo $ProductID; ?>" style="vertical-align:middle; margin-left:10px; padding-left:5px; padding-right:5px; margin-right:10px;" width="110" height="150">
                                <div class="container-fluid" style="display:flex; flex-direction:column; padding:10px; border-left:1.5px solid #c4c1c0;">
                                    <?php
                                    $query2 = "SELECT products1.styleCode, products1.prod_color, products1.prod_name, products1.prod_price, order_products.Size, order_products.Quantity FROM order_products JOIN products1 ON order_products.ProductID=products1.ProductID WHERE OrderID='$OrderID'";
                                    $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
                                    $row2 = mysqli_fetch_array($result2);
                                    ?>
                                    <h6><b>Name :  </b><?php echo $row2['prod_name']; ?></h6>
                                    <h6><b>Size :  </b><?php echo $row2['Size']; ?></h6>
                                    <h6 style="margin-bottom:5px;"><b>Select Quantity :  </b></h6>
                                    <select class="form-control" name="return_quantity" style="width:70px;height:25px;font-size:13px;padding:0px 0px 0px 6px;margin-bottom:8px;">
                                        <?php
                                        for($i=1;$i<=$row2['Quantity'];$i++)
                                        {
                                        ?>
                                            <option><?php echo $i; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <h6><b>MRP :  </b>INR <?php echo $row2['prod_price']; ?>/-</h6>
                                    <a href="../home/product.php?styleCode=<?php echo $row2["styleCode"]; ?>&color=<?php echo $row2['prod_color']; ?>"><h6><b>View Product</b></h6></a>
                                </div>
                            </div> 
                            <br>
                        </div>
                        
                        <div class="container" style="padding:0px;">
                            <h3 style="margin-top:50px; font-weight:bold;">Check pin-code serviceability</h3>
                            <div style="display:flex; justify-content:center;">
                                <input style="margin-top:7px;width:200px;" type="text" maxlength="6" class="form-control" name="pincode" id="pincode" value="" placeholder="Enter 6-Digit Pin-Code" required>
                                <img src="../images/loader.gif" id="loader" width="40" style="margin-top:7px;display:none">
                                <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button" name="checkPincodeforReturn" id="checkPincodeforReturn" onclick="checkService()" style="cursor:pointer;margin-top:7px;background-color:#b8beff;padding:7px 10px 0px 10px;border-radius:.25rem">search</i>
                            </div>  
                            <br>
                            <p id="service" style="font-size:14px; font-weight:bold;"></p>
                            <br>
                            <script>
                                function checkService()
                                {
                                    var pincode = null;
                                    pincode = document.getElementById("pincode").value;
                                    var checkPincodeforReturn = 'checkPincodeforReturn';
                                    $("#checkPincodeforReturn").hide();
                                    $("#loader").show();
                                    $.ajax({
                                        url: '../includes/checkServiceability.php',
                                        method: 'POST',
                                        data:{checkPincodeforReturn:checkPincodeforReturn, pincode:pincode},
                                        success:function(data){
                                            $("#checkPincodeforReturn").show();
                                            $("#loader").hide();
                                            if(data=="Return pickup service available!")
                                            {
                                                document.getElementById("service").innerHTML = data;
                                                document.getElementById("service").style.color = "blue";
                                            }
                                            else
                                            {
                                                document.getElementById("service").innerHTML = data;
                                                document.getElementById("service").style.color = "red";
                                            }
                                        }
                                    });
                                }
                            </script>
                        </div>
                        
                        <h3 style="margin-top:20px; font-weight:bold;">Select return pickup address</h3>
                        <p style="margin-bottom:15px;"><b>Please check pin-code serviceability before confirming address for return pickup.</b></p>
                        <div class="container" style="text-align:left;">
                            <?php
                            $query5 = "SELECT Address1, Address2, Address3 FROM user WHERE Email='$email'";
                            $result5 = mysqli_query($con, $query5);
                            $row5 = mysqli_fetch_array($result5);
                            $Address1 = $row5['Address1'];
                            $Address2 = $row5['Address2'];
                            $Address3 = $row5['Address3'];
                            if($Address1 != NULL)
                            {
                            ?>
                                <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                                    <div style="padding-top:14px; padding-right:10px; border-right:1.5px solid #c4c1c0;">
                                        <input type="radio" value="<?php echo $Address1; ?>" id="return_pickup" name="return_pickup" checked>
                                    </div>
                                    <div class="container-fluid" style="display:flex; flex-direction:column; padding:10px;">
                                        <h6 style="margin-bottom:0px;"><?php echo $Address1; ?></h6>
                                    </div>
                                </div>
                            <?php
                            }
                            if($Address2 != NULL)
                            {
                            ?>
                                <br>
                                <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                                    <div style="padding-top:14px; padding-right:10px; border-right:1.5px solid #c4c1c0;">
                                        <input type="radio" value="<?php echo $Address2; ?>" id="return_pickup" name="return_pickup" checked>
                                    </div>
                                    <div class="container-fluid" style="display:flex; flex-direction:column; padding:10px;">
                                        <h6 style="margin-bottom:0px;"><?php echo $Address2; ?></h6>
                                    </div>
                                </div>
                            <?php
                            }
                            if($Address3 != NULL)
                            {
                            ?>
                                <br>
                                <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                                    <div style="padding-top:14px; padding-right:10px; border-right:1.5px solid #c4c1c0;">
                                        <input type="radio" value="<?php echo $Address3; ?>" id="return_pickup" name="return_pickup" checked>
                                    </div>
                                    <div class="container-fluid" style="display:flex; flex-direction:column; padding:10px;">
                                        <h6 style="margin-bottom:0px;"><?php echo $Address3; ?></h6>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                        
                        <?php
                        $query9 = "SELECT paymentType FROM order_payment WHERE OrderID='$OrderID'";
                        $result9 = mysqli_query($con, $query9);
                        $row9 = mysqli_fetch_array($result9);
                        if($row9['paymentType'] == 'COD')
                        {
                        ?>
                            <h3 style="margin-top:50px; font-weight:bold;">Select method of refund</h3>
                            <br>
                            <div id="refund_div" style="display:flex; justify-content:center;">
                                <h6 style="cursor:pointer; font-weight:bold;color:blue;" onclick="refund_bank()">Bank Account</h6>
                                &emsp;
                                <h6 style="font-weight:bold;"">or</h6>
                                &emsp;
                                <h6 style="cursor:pointer; font-weight:bold; color:blue;" onclick="refund_upi()">UPI Transfer</h6>
                            </div>
                            <script>
                                function refund_bank()
                                {
                                    var htmlblock = '<div style="display:flex; flex-direction:column; justify-content:center;">'+
                                                        '<div class="form-group" style="display:flex; flex-direction:column; justify-content:center;">'+
                                                            '<label>Account Number</label>'+
                                                            '<input type="text" style="width:225px;" class="form-control" name="account_number" required>'+
                                                        '</div>'+
                                                        '<div class="form-group" style="display:flex; flex-direction:column; justify-content:center;">'+
                                                            '<label>IFSC Code</label>'+
                                                            '<input type="text" style="width:225px;" class="form-control" name="ifsc_code" required>'+
                                                        '</div>'+
                                                        '<div class="form-group" style="display:flex; flex-direction:column; justify-content:center;">'+
                                                            '<label>Beneficiary Name</label>'+
                                                            '<input type="text" style="width:225px;" class="form-control" name="benef_name" required>'+
                                                        '</div>'+
                                                        '<p style="cursor:pointer; font-weight:bold; text-decoration:underline;" onclick="refund_back()"> < Back </p>'+
                                                    '</div>';
                                    
                                    document.getElementById("refund_div").innerHTML= htmlblock;
                                }
                                
                                function refund_back()
                                {
                                    var htmlblock = '<h6 style="cursor:pointer; font-weight:bold;color:blue;" onclick="refund_bank()">Bank Account</h6>'+
                                                    '&emsp;'+
                                                    '<h6 style="font-weight:bold;"">or</h6>'+
                                                    '&emsp;'+
                                                    '<h6 style="cursor:pointer; font-weight:bold; color:blue;" onclick="refund_upi()">UPI ID</h6>';
                                    
                                    document.getElementById("refund_div").innerHTML= htmlblock;
                                }
                                
                                function refund_upi()
                                {
                                    var htmlblock = '<div style="display:flex; flex-direction:column; justify-content:center;">'+
                                                        '<div class="form-group" style="display:flex; flex-direction:column; justify-content:center;">'+
                                                            '<label>UPI ID</label>'+
                                                            '<input type="text" style="width:225px;" class="form-control" name="upi_id" required>'+
                                                        '</div>'+
                                                      '<p style="cursor:pointer; font-weight:bold; text-decoration:underline;" onclick="refund_back()"> < Back </p>'+
                                                    '</div>';
                                            
                                    document.getElementById("refund_div").innerHTML= htmlblock;
                                }
                            </script>
                        <?php
                        }
                        ?>
                        
                        <h3 style="margin-top:50px; font-weight:bold; margin-bottom:15px;">Select reason</h3>
                        <div class="container-fluid" style="padding:0px; display:flex; flex-direction:row; justify-content:center;">
                            <select class="form-control" name="return_reason" style="width:300px;">
                                <option value="Fitting problem">Fitting problem</option>
                                <option value="Incorrect size was delivered">Incorrect size was delivered</option>
                                <option value="Different product was delivered">Different product was delivered</option>
                                <option value="Product does not match description">Product does not match description</option>
                                <option value="I do not like this anymore">I do not like this anymore</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <h3 style="margin-top:50px; font-weight:bold; margin-bottom:15px;">Are you sure you want to return this order?</h3>
                        <div class="container-fluid" style="padding:0px; display:flex; flex-direction:row; justify-content:center;">
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="ConfirmReturn" name="ConfirmReturn"><span>YES</span></button>
                            &emsp;
                            &emsp;
                            <input type="hidden" name="OrderID" id="OrderID" value="<?php echo $OrderID; ?>">
                            &emsp;
                            &emsp;
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="NoReturn" name="NoReturn"><span>  NO </span></button>
                        </div>
                    </form>
                    <br>
                    <br>
                        
                       
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