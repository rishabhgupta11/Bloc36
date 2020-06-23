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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <title>BLOC36</title>
    </head>
    <body>
        <?php
        include("../includes/header.php");
        ?>
        
        <div class="container-fluid product_page text-center">
            <h2 style="margin-top:50px; text-decoration:underline; margin-bottom:75px;">My Account</h2>
            <a class="my_acc_set_link" href="../home/cart.php">
                <h6 class="my_acc_set">My Cart <b>></b> </h6>
            </a>
            <a class="my_acc_set_link" href="../home/wishlist.php">
                <h6 class="my_acc_set">My Wishlist <b>></b> </h6>
            </a>
            <a class="my_acc_set_link" href="../home/my_orders.php">
                <h6 class="my_acc_set">My Orders <b>></b> </h6>
            </a>
            <a class="my_acc_set_link" href="../home/manage_details.php">
                <h6 class="my_acc_set">Manage Account Details <b>></b> </h6>
            </a>
            <a class="my_acc_set_link" href="../home/logout.php">
                <h6 class="my_acc_set">Logout <b>></b> </h6>
            </a>
            <div class="container-fluid cart-content" style="margin-top:50px;margin-bottom:100px;width:100%;justify-content: center;">
                <div class="row">
                    <div class="col text-center">
                        <a href="../products/women.php">CONTINUE SHOPPING</a>
                    </div>
                </div>    
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


