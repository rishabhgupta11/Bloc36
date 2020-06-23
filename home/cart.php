<?php
    require("../includes/connect.php");
    include("../includes/fetch_css.php");
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
        <title>BLOC36</title>
    </head>
    <body>
        <?php
        include("../includes/header.php");
        ?>
        <div class="container-fluid cart-page">
            <h2 style="text-align:center; margin-top:50px; text-decoration:underline; margin-bottom:50px;">My Cart</h2>
            
            <?php
            $sum = 0;
            $email = $_SESSION['email'];
            $query = "SELECT products1.prod_price AS Price, products1.ProductID, products1.prod_name AS Name, user_products.Quantity AS Quantity, user_products.Size AS Size, products1.styleCode, products1.prod_color FROM user_products JOIN products1 ON user_products.ProductID = products1.ProductID WHERE user_products.Email='$email' and Status='ADDED TO CART'";
            $result = mysqli_query($con, $query)or die(mysqli_error($con));
            if (mysqli_num_rows($result) >= 1) 
            {
            ?>
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <table class="table table-responsive text-center">
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
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                    $sum+= $row["Price"] * $row["Quantity"];
                                    echo "<tr>
                                            <td><a href='../home/product.php?styleCode=".$row["styleCode"]."&color=".$row['prod_color']."'><img src='../includes/image_view_1.php?id={$row['ProductID']}' style='width:100px;height:150px;'></a></td>
                                            <td style='vertical-align:middle;'>" . $row["Name"] . "</td>
                                            <td style='vertical-align:middle;'>" . $row["Quantity"] . "</td>  
                                            <td style='vertical-align:middle;'>" . $row["Size"] . "</td>    
                                            <td style='vertical-align:middle;'>Rs. " . $row["Price"] * $row["Quantity"] . "</td>
                                            <td style='vertical-align:middle;'><a href='../includes/cart-remove.php?id={$row['ProductID']}' class='remove_item_link'> REMOVE </a></td>
                                          </tr>";
                                }
                                echo "<tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style='font-weight:bold;'>Total</td>
                                        <td style='font-weight:bold;'>Rs. " . $sum . "</td>
                                        <td></td>
                                      </tr>";
                                $email2=$_SESSION['email'];
                                $sql_query = "UPDATE user_products SET cartTotal='$sum' WHERE Email='$email2'";
                                $updateTotal = mysqli_query($con, $sql_query);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
            } 
            else 
            {
                echo "<center><h2 style='margin-top:100px; color:#212a2f;'>Your Cart is Empty</h2></center>";
            }
            ?>
            <?php
            if (mysqli_num_rows($result) >= 1) 
            {
            ?>
                <form method="post" action="../home/deliveryDetails.php">
                    <div class="form-group text-center">
                        <button type="submit" class="button1" style="vertical-align:middle; width:50%;" id="confirm_order" name="confirm_order"><span>Confirm Order </span></button>
                    </div>
                </form>    
            <?php
            }
            ?>
            <div class="container-fluid cart-content" style="margin-top:70px;margin-bottom:100px;width:100%;justify-content: center;">
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
