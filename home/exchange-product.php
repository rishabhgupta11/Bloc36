<?php
    require("../includes/connect.php");
    include("../includes/fetch_css.php");
?>   

<?php
    $msg = '';
    if(isset($_POST['ConfirmExchange']))
    {
        if(!empty($_POST['exchange_product']))
        {
            $OrderID = $_POST['OrderID'];
            $returnPickup = $_POST['return_pickup'];
            $returnReason = $_POST['return_reason'];
            $returnQuantity = $_POST['return_quantity'];
            $exchangeNewSize = $_POST['exchangeNewSize'];
            foreach($_POST['exchange_product'] as $exchangeProduct)
            {   
                $query8 = "SELECT * FROM return_products WHERE OrderID='$OrderID' AND ProductID='$exchangeProduct'";
                $result8 = mysqli_query($con, $query8);
                if(mysqli_num_rows($result8)==0)
                {
                    $query7 = "INSERT INTO return_products(OrderID, ProductID, exchangeProduct, exchangeNewSize, returnQuantity, returnStatus, returnAddress, returnReason) VALUES('$OrderID', '$exchangeProduct', 'yes', '$exchangeNewSize', '$returnQuantity', 'In Return', '$returnPickup', '$returnReason')";
                    mysqli_query($con, $query7);
                }
            }
            
            $msg = "Your order with Order ID: ".$OrderID." and ProductID: ".$exchangeProduct." is being processed for Exchange.";
        }
        else
        {
            $msg = "No product was selected. <a href='../home/my_orders.php'>Go Back</a>";
        }
    }
    else
    {
        if(isset($_POST['NoExchange']))
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
            
            <?php echo "<p style='font-size:16px;color:black;margin-top:100px;'><b>$msg</b></p>"; ?>                
                <?php
                if(isset($_POST['exchange-product']))
                {
                    $OrderID = $_POST['OrderID'];
                    $email = $_SESSION['email'];
                    $ProductID = $_POST['ProductID']
                ?>
            
                    <h3 style="margin-top:50px; font-weight:bold; margin-bottom:15px;">Confirm the product for exchange</h3>  
                    <form method="POST" action="">
                        <div class="container" style="text-align:left;">
                            <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                                <div style="padding-top:70px; padding-right:10px; border-right:1.5px solid #c4c1c0;">
                                    <input type="checkbox" name="exchange_product[]" value="<?php echo $ProductID; ?>">
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
                        
                        <h3 style="margin-top:50px; font-weight:bold; margin-bottom:15px;">Select new size</h3>
                        <?php
                        $query6 = "SELECT prod_size_xs, prod_size_s, prod_size_m, prod_size_l, prod_size_xl, prod_size_xxl, inventory_size_xs, inventory_size_s, inventory_size_m, inventory_size_l, inventory_size_xl, inventory_size_xxl FROM products1 WHERE ProductID='$ProductID' LIMIT 1";
                        $result6 = mysqli_query($con, $query6);
                        $row6 = mysqli_fetch_array($result6);
                        ?>
                        <div class="container-fluid" style="padding:0px; display:flex; flex-direction:row; justify-content:center;">
                            <select class="form-control" name="exchangeNewSize" style="width:200px;">
                                <?php if($row6['prod_size_xs'] == 'yes' && $row6['inventory_size_xs'] > 3) {?>
                                <option> XS </option>
                                <?php } ?>
                                <?php if($row6['prod_size_s'] == 'yes' && $row6['inventory_size_s'] > 3) {?>
                                <option> S </option>
                                <?php } ?>
                                <?php if($row6['prod_size_m'] == 'yes' && $row6['inventory_size_m'] > 3) {?>
                                <option> M </option>
                                <?php } ?>
                                <?php if($row6['prod_size_l'] == 'yes' && $row6['inventory_size_l'] > 3) {?>
                                <option> L </option>
                                <?php } ?>
                                <?php if($row6['prod_size_xl'] == 'yes' && $row6['inventory_size_xl'] > 3) {?>
                                <option> XL </option>
                                <?php } ?>
                                <?php if($row6['prod_size_xxl'] == 'yes' && $row6['inventory_size_xxl'] > 3) {?>
                                <option> XXL </option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        
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
                        
                        <h3 style="margin-top:50px; font-weight:bold; margin-bottom:15px;">Are you sure you want to exchange this order?</h3>
                        <div class="container-fluid" style="padding:0px; display:flex; flex-direction:row; justify-content:center;">
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="ConfirmReturn" name="ConfirmExchange"><span>YES</span></button>
                            &emsp;
                            &emsp;
                            <input type="hidden" name="OrderID" id="OrderID" value="<?php echo $OrderID; ?>">
                            &emsp;
                            &emsp;
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="NoReturn" name="NoExchange"><span>  NO </span></button>
                        </div>
                    </form>
                    <br>
                    <br>
                        
                       
                <?php
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