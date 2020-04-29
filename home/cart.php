<?php
    require("../includes/connect.php");
?>    
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
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
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <table class="table table-responsive text-center">

                        <?php
                        $sum = 0;
                        $email = $_SESSION['email'];
                        $query = "SELECT products1.prod_price AS Price, products1.ProductID, products1.prod_name AS Name, user_products.Quantity AS Quantity, user_products.Size AS Size FROM user_products JOIN products1 ON user_products.ProductID = products1.ProductID WHERE user_products.Email='$email' and Status='ADDED TO CART'";
                        $result = mysqli_query($con, $query)or die(mysqli_error($con));
                        if (mysqli_num_rows($result) >= 1) {
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
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                    $sum+= $row["Price"];
                                    $email="";
                                    $email .= $row["ProductID"] . ",";
                                    echo "<tr>
                                            <td><img src='../includes/image_view_1.php?id={$row['ProductID']}' style='width:120px;height:155px;'></td>
                                            <td style='vertical-align:middle;'>" . $row["Name"] . "</td>
                                            <td style='vertical-align:middle;'>" . $row["Quantity"] . "</td>  
                                            <td style='vertical-align:middle;'>" . $row["Size"] . "</td>    
                                            <td style='vertical-align:middle;'>Rs. " . $row["Price"] . "</td>
                                            <td style='vertical-align:middle;'><a href='../includes/cart-remove.php?id={$row['ProductID']}' class='remove_item_link'> REMOVE </a></td>
                                          </tr>";
                                }
                                $email = rtrim($email, ",");
                                echo "<tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style='font-weight:bold;'>Total</td>
                                        <td style='font-weight:bold;'>Rs. " . $sum . "</td>
                                        <td></td>
                                      </tr>";
                                
                                ?>
                            </tbody>
                            <?php
                        } else {
                            echo "<center><h2 style='margin-top:200px; color:#212a2f;'>Your Cart is Empty</h2></center>";
                        }
                        ?>
                    </table>
                </div>
            </div>
            <?php
            if (mysqli_num_rows($result) >= 1) 
            {
            ?>
                <form method="post" action="#">
                    <div class="form-group text-center">
                        <button type="submit" class="button1" style="vertical-align:middle; width:50%;" id="confirm_order" name="confirm_order"><span>Confirm Order </span></button>
                    </div>
                </form>    
            <?php
            }
            ?>
            <div class="container-fluid cart-content" style="margin-top:150px;margin-bottom:100px;width:100%;justify-content: center;">
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
