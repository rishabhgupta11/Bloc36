<?php
    require("../includes/connect.php");
    require("../includes/razorpay_config.php");
    require('../includes/delhivery_config.php');
?>   

<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
?>

<?php 
    $email = $_SESSION['email'];
    $query = "SELECT Name, Email, Contact, Address1, Address2, Address3 FROM user WHERE Email='$email'";
    $result = mysqli_query($con, $query)or die(mysqli_error($con));
    $userExist = mysqli_num_rows($result);
    if ($userExist > 0) {
        while($row = mysqli_fetch_array($result)){ 
            $name = $row["Name"];
            $contact = $row["Contact"];
            $address1 = $row["Address1"];
            $address2 = $row["Address2"];
            $address3 = $row["Address3"];
        }
    } 
    else 
    {
        echo "User does not exist.";
        header('location: ../home/login.php');
    }
    $query2 = "SELECT cartTotal, deliveryAddress FROM user_products WHERE Email='$email'";
    $result2 = mysqli_query($con, $query2)or die(mysqli_error($con));
    $userExist2 = mysqli_num_rows($result2);
    if ($userExist2 > 0) {
        while($row2 = mysqli_fetch_array($result2)){ 
            $price = $row2["cartTotal"];
            $deliveryAddress = $row2["deliveryAddress"];
        }
    } 
    else{
        header('location: ../home/cart.php');
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
        
        <div class="container-fluid cart-page" style="padding-top:10px;">
            <div class="cart-content" style="margin-top:1px;margin-bottom:30px;width:100%;justify-content:center;">
                <a href="../home/cart.php"> < Return to Cart</a>
            </div>
            <h1 style="text-decoration:underline; text-align:center;"><b>Delivery Details</b></h1>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col">
                    <div class="container" style="padding:0px;">
                        <?php
                        if($name != NULL)
                        {
                        ?>
                        <h4 id="deliveryName"><b>Name:</b>&nbsp;<?php echo $name;?></h4>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <br>
            <br>
            
            <div class="row">
                <div class="col">
                    <div class="container" style="padding:0px;">
                        <?php
                        if($email != NULL)
                        {
                        ?>
                        <h4 id="deliveryEmail"><b>E-Mail:</b>&nbsp;<?php echo $email;?></h4>
                        <?php
                        }
                        ?>
                    </div>    
                </div>
            </div>
            
            <br>
            <br>
            
            <div class="row">
                <div class="col">
                    <div class="container" style="padding:0px;">
                        <?php
                        if($contact != NULL)
                        {
                        ?>
                        <h4 id="deliveryContact"><b>Contact:</b>&nbsp;<?php echo $contact;?></h4>
                        <?php
                        }
                        else
                        {
                        ?>
                        <h4 id="deliveryContact"><b>Enter Contact Number:</b></h4> 
                        <form class="form-inline" method="post" action="../includes/updateContact.php">
                            <div class="form-group">
                                <input type="text" value="+91" class="form-control" size="1" readonly>
                            </div>
                            &emsp;
                            <div class="form-group">
                                <input type="tel" minlength="8" maxlength="10" class="form-control" name="contact" id="contact" placeholder="Enter 10-Digit Number" required>
                            </div>
                            &emsp;
                            <div class="form-group">
                                <button type="submit" class="button10 button105" style="vertical-align:middle" id="updateContact" name="updateContact"><span>SAVE</span></button>
                            </div>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <br>
            </div>
            
            <br>
            <br>
            
            <div class="row">
                <div class="col">
                    <div class="container" style="padding:0px;">
                        <h4 id="deliveryContact"><b>Check Pin-Code Serviceability:</b></h4>
                        <div style="display:flex;">
                            <input style="margin-top:7px;width:200px;" type="text" maxlength="6" class="form-control" name="pincode" id="pincode" value="" placeholder="Enter 6-Digit Pin-Code" required>
                            <img src="../images/loader.gif" id="loader" width="40" style="margin-top:7px;display:none">
                            <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button" name="checkPincode" id="checkPincode" onclick="checkService()" style="cursor:pointer;margin-top:7px;background-color:#b8beff;padding:7px 10px 0px 10px;border-radius:.25rem">search</i>
                        </div>  
                        <br>
                        <p id="service" style="font-size:14px; font-weight:bold;"></p>
                        <br>
                        <script>
                            function checkService()
                            {
                                var pincode = null;
                                pincode = document.getElementById("pincode").value;
                                var checkPincode = 'checkPincode';
                                $("#checkPincode").hide();
                                $("#loader").show();
                                $.ajax({
                                    url: '../includes/checkServiceability.php',
                                    method: 'POST',
                                    data:{checkPincode:checkPincode, pincode:pincode},
                                    success:function(data){
                                        $("#checkPincode").show();
                                        $("#loader").hide();
                                        if(data=="Service Available!")
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
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <div class="container" style="padding:0px;">
                        <?php
                        if($deliveryAddress != NULL)
                        {
                        ?>
                        <h4 class="deliveryAddress"><b>Delivery Address:</b></h4>
                        <div class="container" style="display:flex; padding:10px; justify-content:space-around; border:0.5px solid #c4c1c0; background-color:#ebebeb;">
                            <h6 class="address-list-span" style="margin-bottom:0px;"><?php echo $deliveryAddress; ?>.</h6>
                            <a href="../includes/deleteDeliveryAddress.php"><p class="remove_item_link" style="margin-bottom:5px;">CHANGE</p></a>
                            <br>
                        </div>
                        <?php
                        }
                        else
                        {
                            if($address1 != NULL || $address2 != NULL || $address3 != NULL)
                            {
                            ?>
                            <h4 class="deliveryAddress"><b>Select Delivery Address:</b></h4>
                            <p><b>Please check pin-code serviceability before confirming address.</b></p>
                            <br>
                            <form method="post" action="../includes/updateDeliveryAddress.php">
                                <?php
                                if($address1 != NULL)
                                {
                                ?>
                                <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                                    <div style="padding-top:14px; padding-right:10px; border-right:1.5px solid #c4c1c0;">
                                        <input type="radio" value="<?php echo $address1; ?>" id="address" name="address" checked>
                                    </div>
                                    <div class="container-fluid" style="display:flex; flex-direction:column; padding:10px;">
                                        <h6 class="address-list-span" style="margin-bottom:0px;"><?php echo $address1; ?></h6>
                                    </div>
                                </div>
                                <br>
                                <?php
                                }
                                ?>
                                <?php
                                if($address2 != NULL)
                                {
                                ?>
                                <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                                    <div style="padding-top:14px; padding-right:10px; border-right:1.5px solid #c4c1c0;">
                                        <input type="radio" value="<?php echo $address2; ?>" id="address" name="address" checked>
                                    </div>
                                    <div class="container-fluid" style="display:flex; flex-direction:column; padding:10px;">
                                        <h6 class="address-list-span" style="margin-bottom:0px;"><?php echo $address2; ?></h6>
                                    </div>
                                </div>
                                <br>
                                <?php
                                }
                                ?>
                                <?php
                                if($address3 != NULL)
                                {
                                ?>
                                <div class="container" style="display:flex; flex-direction:row; padding:10px; border: 0.5px solid #c4c1c0; background-color:#ebebeb;">
                                    <div style="padding-top:14px; padding-right:10px; border-right:1.5px solid #c4c1c0;">
                                        <input type="radio" value="<?php echo $address3; ?>" id="address" name="address" checked>
                                    </div>
                                    <div class="container-fluid" style="display:flex; flex-direction:column; padding:10px;">
                                        <h6 class="address-list-span" style="margin-bottom:0px;"><?php echo $address3; ?></h6>
                                    </div>
                                </div>
                                <br>
                                <?php
                                }
                                ?>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="button10 button105" style="vertical-align:middle" id="updateDeliveryAddress" name="updateDeliveryAddress"><span>CONFIRM ADDRESS</span></button>
                                </div>
                                <br>
                                <br>
                            </form>
                            <?php
                            }
                            if($address1 == NULL)
                            {
                            ?>
                            <h4 class="deliveryAddress"><b>New Delivery Address:</b></h4> 
                            <br>
                            <form style="width:80%" method="post" action="../includes/updateAddress1.php">
                                <div class="row">
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>House No./Building</label>
                                            <input type="text" maxlength="900" class="form-control" name="address11" id="address11" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Landmark</label>
                                            <input type="text" maxlength="200" class="form-control" name="address13" id="address13" required>
                                        </div>
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" maxlength="900" class="form-control" name="address15" id="address15" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Street Address</label>
                                            <input type="text" maxlength="900" class="form-control" name="address12" id="address12" required>
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" maxlength="900" class="form-control" name="address14" id="address14" required>
                                        </div>
                                        <div class="form-group">
                                            <label>PIN Code</label>
                                            <input type="text" maxlength="6" class="form-control" name="address16" id="address16" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="button10 button105" style="vertical-align:middle" id="updateAddress" name="updateAddress"><span>SAVE</span></button>
                                </div>
                            </form>
                            <?php
                            }
                            else
                            {
                                if($address2 == NULL)
                                {
                                ?>
                                <h4 class="deliveryAddress"><b>New Delivery Address:</b></h4> 
                                <br>
                                <form style="width:80%" method="post" action="../includes/updateAddress2.php">
                                    <div class="row">
                                        <div class="col-lg-6 col-xs-12">
                                            <div class="form-group">
                                                <label>House No./Building</label>
                                                <input type="text" maxlength="900" class="form-control" name="address21" id="address21" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Landmark</label>
                                                <input type="text" maxlength="200" class="form-control" name="address23" id="address23" required>
                                            </div>
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="text" maxlength="900" class="form-control" name="address25" id="address25" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Street Address</label>
                                                <input type="text" maxlength="900" class="form-control" name="address22" id="address22" required>
                                            </div>
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" maxlength="900" class="form-control" name="address24" id="address24" required>
                                            </div>
                                            <div class="form-group">
                                                <label>PIN Code</label>
                                                <input type="text" maxlength="6" class="form-control" name="address26" id="address26" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="button10 button105" style="vertical-align:middle" id="updateAddress" name="updateAddress"><span>SAVE</span></button>
                                    </div>
                                </form>
                                <?php
                                }
                                else
                                {
                                    if($address3 == NULL)
                                    {
                                    ?>
                                    <h4 class="deliveryAddress"><b>New Delivery Address:</b></h4> 
                                    <br>
                                    <form style="width:80%" method="post" action="../includes/updateAddress3.php">
                                        <div class="row">
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>House No./Building</label>
                                                    <input type="text" maxlength="900" class="form-control" name="address31" id="address31" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Landmark</label>
                                                    <input type="text" maxlength="200" class="form-control" name="address33" id="address33" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" maxlength="900" class="form-control" name="address35" id="address35" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Street Address</label>
                                                    <input type="text" maxlength="900" class="form-control" name="address32" id="address32" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" maxlength="900" class="form-control" name="address34" id="address34" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>PIN Code</label>
                                                    <input type="text" maxlength="6" class="form-control" name="address36" id="address36" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="updateAddress" name="updateAddress"><span>SAVE</span></button>
                                        </div>
                                    </form> 
                                    <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <br>
            </div>
            <br>
            <br>
            <br>
            <?php 
            if($deliveryAddress!=NULL && $contact!=NULL)
            {
            ?>
            <div class="container text-center">
                <div class="form-group text-center">
                    <a href="../home/paymentDetails.php">
                        <button class="razorpay-payment-button" style="vertical-align:middle" ><span>PROCEED TO PAYMENT</span></button>
                    </a>
                </div>
            </div>
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
        </div>    
        
        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>      
    </body>
</html>

