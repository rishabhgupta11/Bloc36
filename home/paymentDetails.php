<?php
    require("../includes/connect.php");
    require("../includes/razorpay_config.php");
    require('../includes/delhivery_config.php');
    include("../includes/fetch_css.php");
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
    $_SESSION['price'] = $price;
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
        
        
        <div class="container-fluid cart-page" style="padding-top:10px;">
            <div class="cart-content" style="margin-top:1px;margin-bottom:30px;width:100%;justify-content:center;">
                <a href="../home/deliveryDetails.php"> < Go Back</a>
            </div>
            
            <h1 style="text-decoration:underline; text-align:center;"><b>Order Details</b></h1>
            
            <div class="row" style="margin-top:50px;">
                <div class="col-sm-11 offset-sm-1">
                    <h4 id="deliveryContact"><b>Product(s):</b></h4>
                    <table class="table table-responsive text-center">

                        <?php
                        $sum = 0;
                        $email = $_SESSION['email'];
                        $query3 = "SELECT products1.styleCode, products1.prod_color, products1.prod_price AS Price, products1.ProductID, products1.prod_name AS Name, user_products.Quantity AS Quantity, user_products.Size AS Size FROM user_products JOIN products1 ON user_products.ProductID = products1.ProductID WHERE user_products.Email='$email' and Status='ADDED TO CART'";
                        $result3 = mysqli_query($con, $query3)or die(mysqli_error($con));
                        if (mysqli_num_rows($result3) >= 1) 
                        {
                        ?>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                while ($row3 = mysqli_fetch_array($result3)) 
                                {
                                    $sum+= $row3["Price"] * $row3["Quantity"];
                                    echo "<tr>
                                            <td><a href='../home/product.php?styleCode=".$row3["styleCode"]."&color=".$row3['prod_color']."'><img src='../includes/image_view_1.php?id={$row3['ProductID']}' style='width:100px;height:150px;'></a></td>
                                            <td style='vertical-align:middle;'>" . $row3["Name"] . "</td>
                                            <td style='vertical-align:middle;'>" . $row3["Quantity"] . "</td>  
                                            <td style='vertical-align:middle;'>" . $row3["Size"] . "</td>    
                                            <td style='vertical-align:middle;'>Rs. " . $row3["Price"] * $row3["Quantity"] . "</td>
                                            <td style='vertical-align:middle;'><a href='../includes/cart-remove.php?id={$row3['ProductID']}' class='remove_item_link'> REMOVE </a></td>
                                          </tr>";
                                }
                                echo "<tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td>Subtotal</td>
                                        <td></td>
                                        <td></td>
                                        <td>Rs. ".$sum."</td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td>Shipping</td>
                                        <td></td>
                                        <td></td>
                                        <td>Free</td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td style='font-weight:bold;'>Order Total</td>
                                        <td></td>
                                        <td></td>
                                        <td style='font-weight:bold;'>Rs. ".$_SESSION['price']."</td>
                                        <td></td>
                                      </tr>";
                                ?>
                            </tbody>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            
            <div class="row" style="margin-top:50px;">
                <div class="col-sm-11 offset-sm-1">
                    <h4 id="deliveryContact"><b>Gift Card or Discount Code:</b></h4>
                    <form class="form-inline" method="post" action="">
                        <div class="form-group">
                            <input type="text" maxlength="12" class="form-control" name="discountcode" id="discountcode" placeholder="Enter Code" required>
                        </div>
                        &emsp;
                        <div class="form-group">
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="checkDiscountCode" name="checkDiscountCode"><span>APPLY</span></button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <br>
            <br>
            <?php 
            if($deliveryAddress!=NULL && $contact!=NULL)
            {
            ?>
                <div class="container-fluid text-center" style="padding:0px;">
                    <?php
                    $query4 = "SELECT referenceCode FROM order_payment";
                    $result4 = mysqli_query($con, $query4) or die(mysqli_error($con));
                    while($row4 = mysqli_fetch_array($result4))
                    {
                        $referenceCode = $row4['referenceCode'];
                    }
                    $referenceCode++;
                    ?>

                    <?php
                    $url= 'https://track.delhivery.com/c/api/pin-codes/json/?token='.$api_key_token.'&filter_codes='.$_SESSION['pincode'];
                    $output = json_decode(file_get_contents($url),true);
                    if($output['delivery_codes']==NULL)
                    {
                        echo "<p><b>Selected pin-code ".$_SESSION['pincode']." is not serviceable. Please select a different address.</b></p>";
                    }
                    else
                    {
                        if($output['delivery_codes'][0]['postal_code']!=NULL && $output['delivery_codes'][0]['postal_code']['pre_paid']=="Y")
                        {
                    ?>
                            <form action="../includes/payment-success.php" method="POST">
                            <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="<?php echo $api_key_id; ?>"
                                data-amount="<?php echo $_SESSION['price']*100; ?>" 
                                data-currency="INR"
                                data-buttontext="PAY NOW"
                                data-name="Bloc36"
                                data-description="Test transaction"
                                data-prefill.name="<?php echo $name; ?>"
                                data-prefill.email="<?php echo $_SESSION['email']; ?>"
                                data-prefill.contact="<?php echo $contact; ?>"
                                data-theme.color="#826b65"
                            ></script>
                                <input type="hidden" name="referenceCode" id="referenceCode" value="<?php echo $referenceCode; ?>">
                            </form>
                            <?php
                            if($output['delivery_codes'][0]['postal_code']!=NULL && $output['delivery_codes'][0]['postal_code']['cod']=="Y")
                            {
                            ?>
                                <div style="margin-bottom: 12px;">
                                    <h6 style="font-weight:bold;">or</h6>
                                </div>
                                <form style="margin-top:4px;" action="../includes/order-success.php" method="POST">
                                    <input type="hidden" name="referenceCode" id="referenceCode" value="<?php echo $referenceCode; ?>">
                                    <button type="submit" class="razorpay-payment-button" style="vertical-align:middle" ><span>PAY WITH COD</span></button>
                                </form>
                            <?php
                            }
                            else
                            {
                                echo "COD is unavailable in your selected location.";
                            }
                            ?>
                    <?php
                        }
                        else
                        {
                            echo "<p><b>Selected address is not serviceable. Please select a different address.</b></p>";
                        }
                    }
                    ?>
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