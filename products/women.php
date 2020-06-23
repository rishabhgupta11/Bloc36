<?php
    require("../includes/connect.php");
    include("../includes/check_if_added.php");
    include("../includes/fetch_css.php");
?>   
<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
?>
<html>
    <head>
        <title>BLOC36</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="<?php echo $cssfilename; ?>" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            include("../includes/header.php");
        ?>
        
        <script>
            window.onload = function(){
                if(screen.width <= 1024)
                {
                    var screenwidth = screen.width;
                    document.getElementById('imagesize').style.width = screenwidth;
                    document.getElementById('bannersize').style.width = screenwidth;
                }
            };
        </script>
        <div class="container-fluid" style="margin-top: 60px; padding: 0px;">
            <div class="row no-gutters">
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="prod-women-image">
                        <img id="imagesize" class="prod-women-image-2" src="../images/products-women-banner.jpg" alt="BLOC36">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 prod-women-banner" id="bannersize">
                    <div style='padding:16%'>
                        <h1 style='font-size: 1.5rem'> Women's Active-Wear </h1>
                        <h4 style='font-size: 0.9rem'> The world’s most comfortable active-wear made from premium materials go perfectly with your daily escapades. </h4>
                    </div>
                </div>
            </div>
        </div>    
        
        <div class="container" style="margin-bottom:50px;padding-bottom:25px;">
            <?php 
                $query = "SELECT * FROM products1";
                $result = mysqli_query($con, $query)or die(mysqli_error($con));
            ?>   
            <a href="../home/all_t-shirts.php" class="title-heading"><h2 style="margin-top:50px;padding-top:25px;color:#212a2f; font-weight:900;">Women's T-Shirts</h2></a>
            <p style="padding-top:5px;padding-bottom:5px;color: #212a2f;font-size:16px;font-weight:700;text-decoration:underline;">Featured</p>
            <div class="container-fluid text-center table-responsive text-nowrap">
                <table class="table w-100 table-fixed">
                    <tr>
                        <?php 
                        $number = 0;
                        while($row = mysqli_fetch_array($result)){
                            ++$number;
                            if($row["prod_subcategory"] == "T-Shirt" && $row["prod_featured"] == "yes")
                            { ?>
                                <th class="th-lg">
                                    <div class="container product-size-form-container" style="width:200px">
                                        <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>">
                                        <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id=<?php echo $row["ProductID"]; ?>" style="margin-top:10px; width:200px !important; height:auto;">
                                        </a>
                                        <div class="caption">
                                            <br>
                                            <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>" style="color:#212a2f; text-decoration: none;">
                                            <h3 class="product-name"><?php echo $row["prod_name"]; ?></h3>
                                            <p>Rs. <?php echo $row["prod_price"]; ?></p>  
                                            </a>
                                            <a class="quick-add" href="#collapse-size-form<?php echo $number; ?>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse-size-form">Quick Add  +</a>
                                            <div class="collapse" id="collapse-size-form<?php echo $number; ?>">
                                                <div class="product-size-form-quick-add">
                                                    <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                        <div class="form-group sizes">
                                                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                            <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                                <span class="size-list-span">S</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                                <span class="size-list-span">M</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                                <span class="size-list-span">L</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                                <span class="size-list-span">XL</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                                <span class="size-list-span">XXL</span>
                                                            </label>
                                                            <?php } ?>
                                                        </div> 
                                                        <br>
                                                        <?php 
                                                            if (!isset($_SESSION['email'])) 
                                                            { ?>
                                                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                            <?php
                                                            } 
                                                            else 
                                                            {
                                                                if (check_if_added_to_cart($row["ProductID"]))
                                                                { 
                                                                    echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                                } 
                                                                else 
                                                                {
                                                            ?>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="product-size-form">
                                                <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                    <div class="form-group sizes">
                                                        <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                        <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                            <span class="size-list-span">XS</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                            <span class="size-list-span">S</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                            <span class="size-list-span">M</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                            <span class="size-list-span">L</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                            <span class="size-list-span">XL</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                            <span class="size-list-span">XXL</span>
                                                        </label>
                                                        <?php } ?>
                                                    </div> 
                                                    <br>
                                                    <?php 
                                                        if (!isset($_SESSION['email'])) 
                                                        { ?>
                                                            <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                        <?php
                                                        } 
                                                        else 
                                                        {
                                                            if (check_if_added_to_cart($row["ProductID"]))
                                                            { 
                                                                echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                            } 
                                                            else 
                                                            {
                                                        ?>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </th>
                            <?php }    
                        }?>
                    </tr>
                </table>
            </div>
            <a class="see-all" href="../home/all_t-shirts.php">See All ></a>
            
                
            <?php 
                $query = "SELECT * FROM products1";
                $result = mysqli_query($con, $query)or die(mysqli_error($con));
            ?> 
            <a href="../home/all_leggings.php" class="title-heading"><h2 style="margin-top:50px; padding-top:25px; color:#212a2f; font-weight:900;">Women's Leggings</h2></a>
            <p style="padding-top:5px;padding-bottom:5px;color: #212a2f;font-size:16px;font-weight:700;text-decoration:underline;">Featured</p>
            <div class="container-fluid text-center table-responsive text-nowrap">
                <table class="table w-100 table-fixed">
                    <tr>
                        <?php 
                        $number = 0;
                        while($row = mysqli_fetch_array($result)){
                            ++$number;
                            if($row["prod_subcategory"] == "Leggings" && $row["prod_featured"] == "yes")
                            { ?>
                                <th class="th-lg">
                                    <div class="container product-size-form-container" style="width:200px">
                                        <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>">
                                        <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id=<?php echo $row["ProductID"]; ?>" style="margin-top:10px; width:200px !important; height:auto;">
                                        </a>
                                        <div class="caption">
                                            <br>
                                            <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>" style="color:#212a2f; text-decoration: none;">
                                            <h3 class="product-name"><?php echo $row["prod_name"]; ?></h3>
                                            <p>Rs. <?php echo $row["prod_price"]; ?></p>  
                                            </a>
                                            <a class="quick-add" href="#collapse-size-form<?php echo $number; ?>" data-toggle="collapse">Quick Add + </a>
                                            <div class="collapse" id="collapse-size-form<?php echo $number; ?>">
                                                <div class="product-size-form-quick-add">
                                                    <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                        <div class="form-group sizes">
                                                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                            <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                                <span class="size-list-span">S</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                                <span class="size-list-span">M</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                                <span class="size-list-span">L</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                                <span class="size-list-span">XL</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                                <span class="size-list-span">XXL</span>
                                                            </label>
                                                            <?php } ?>
                                                        </div> 
                                                        <br>
                                                        <?php 
                                                            if (!isset($_SESSION['email'])) 
                                                            { ?>
                                                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                            <?php
                                                            } 
                                                            else 
                                                            {
                                                                if (check_if_added_to_cart($row["ProductID"]))
                                                                { 
                                                                    echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                                } 
                                                                else 
                                                                {
                                                            ?>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="product-size-form">
                                                <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                    <div class="form-group sizes">
                                                        <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                        <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                            <span class="size-list-span">XS</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                            <span class="size-list-span">S</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                            <span class="size-list-span">M</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                            <span class="size-list-span">L</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                            <span class="size-list-span">XL</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                            <span class="size-list-span">XXL</span>
                                                        </label>
                                                        <?php } ?>
                                                    </div> 
                                                    <br>
                                                    <?php 
                                                        if (!isset($_SESSION['email'])) 
                                                        { ?>
                                                            <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                        <?php
                                                        } 
                                                        else 
                                                        {
                                                            if (check_if_added_to_cart($row["ProductID"]))
                                                            { 
                                                                echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                            } 
                                                            else 
                                                            {
                                                        ?>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </th>
                            <?php }    
                        }?>
                    </tr>
                </table>
            </div>
            <a class="see-all" href="../home/all_leggings.php">See All ></a>
            
                
            <?php 
                $query = "SELECT * FROM products1";
                $result = mysqli_query($con, $query)or die(mysqli_error($con));
            ?> 
            <a href="../home/all_sport-bras.php" class="title-heading"><h2 style="margin-top:50px; padding-top:25px; color:#212a2f; font-weight:900;">Women's Sport-Bras</h2></a>
            <p style="padding-top:5px;padding-bottom:5px;color: #212a2f;font-size:16px;font-weight:700;text-decoration:underline;">Featured</p>
            <div class="container-fluid text-center table-responsive text-nowrap">
                <table class="table w-100 table-fixed">
                    <tr>
                        <?php 
                        $number = 0;
                        while($row = mysqli_fetch_array($result)){
                            ++$number;
                            if($row["prod_subcategory"] == "Sport-Bra" && $row["prod_featured"] == "yes")
                            { ?>
                                <th class="th-lg">
                                    <div class="container product-size-form-container" style="width:200px">
                                        <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>">
                                        <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id=<?php echo $row["ProductID"]; ?>" style="margin-top:10px; width:200px !important; height:auto;">
                                        </a>
                                        <div class="caption">
                                            <br>
                                            <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>" style="color:#212a2f; text-decoration: none;">
                                            <h3 class="product-name"><?php echo $row["prod_name"]; ?></h3>
                                            <p>Rs. <?php echo $row["prod_price"]; ?></p>  
                                            </a>
                                            <a class="quick-add" href="#collapse-size-form<?php echo $number; ?>" data-toggle="collapse">Quick Add + </a>
                                            <div class="collapse" id="collapse-size-form<?php echo $number; ?>">
                                                <div class="product-size-form-quick-add">
                                                    <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                        <div class="form-group sizes">
                                                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                            <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                                <span class="size-list-span">S</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                                <span class="size-list-span">M</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                                <span class="size-list-span">L</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                                <span class="size-list-span">XL</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                                <span class="size-list-span">XXL</span>
                                                            </label>
                                                            <?php } ?>
                                                        </div> 
                                                        <br>
                                                        <?php 
                                                            if (!isset($_SESSION['email'])) 
                                                            { ?>
                                                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                            <?php
                                                            } 
                                                            else 
                                                            {
                                                                if (check_if_added_to_cart($row["ProductID"]))
                                                                { 
                                                                    echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                                } 
                                                                else 
                                                                {
                                                            ?>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="product-size-form">
                                                <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                    <div class="form-group sizes">
                                                        <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                        <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                            <span class="size-list-span">XS</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                            <span class="size-list-span">S</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                            <span class="size-list-span">M</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                            <span class="size-list-span">L</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                            <span class="size-list-span">XL</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                            <span class="size-list-span">XXL</span>
                                                        </label>
                                                        <?php } ?>
                                                    </div> 
                                                    <br>
                                                    <?php 
                                                        if (!isset($_SESSION['email'])) 
                                                        { ?>
                                                            <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                        <?php
                                                        } 
                                                        else 
                                                        {
                                                            if (check_if_added_to_cart($row["ProductID"]))
                                                            { 
                                                                echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                            } 
                                                            else 
                                                            {
                                                        ?>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </th>
                            <?php }    
                        }?>
                    </tr>
                </table>
            </div>
            <a class="see-all" href="../home/all_sport-bras.php">See All ></a>
            
                
            <?php 
                $query = "SELECT * FROM products1";
                $result = mysqli_query($con, $query)or die(mysqli_error($con));
            ?> 
            <a href="../home/all_shorts.php" class="title-heading"><h2 style="margin-top:50px; padding-top:25px; color:#212a2f; font-weight:900;">Women's Shorts</h2></a>
            <p style="padding-top:5px;padding-bottom:5px;color: #212a2f;font-size:16px;font-weight:700;text-decoration:underline;">Featured</p>
            <div class="container-fluid text-center table-responsive text-nowrap">
                <table class="table w-100 table-fixed">
                    <tr>
                        <?php 
                        $number = 0;
                        while($row = mysqli_fetch_array($result)){
                            ++$number;
                            if($row["prod_subcategory"] == "Shorts" && $row["prod_featured"] == "yes")
                            { ?>
                                <th class="th-lg">
                                    <div class="container product-size-form-container" style="width:200px">
                                        <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>">
                                        <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id=<?php echo $row["ProductID"]; ?>" style="margin-top:10px; width:200px !important; height:auto;">
                                        </a>
                                        <div class="caption">
                                            <br>
                                            <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>" style="color:#212a2f; text-decoration: none;">
                                            <h3 class="product-name"><?php echo $row["prod_name"]; ?></h3>
                                            <p>Rs. <?php echo $row["prod_price"]; ?></p>  
                                            </a>
                                            <a class="quick-add" href="#collapse-size-form<?php echo $number; ?>" data-toggle="collapse">Quick Add + </a>
                                            <div class="collapse" id="collapse-size-form<?php echo $number; ?>">
                                                <div class="product-size-form-quick-add">
                                                    <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                        <div class="form-group sizes">
                                                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                            <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                                <span class="size-list-span">S</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                                <span class="size-list-span">M</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                                <span class="size-list-span">L</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                                <span class="size-list-span">XL</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                                <span class="size-list-span">XXL</span>
                                                            </label>
                                                            <?php } ?>
                                                        </div> 
                                                        <br>
                                                        <?php 
                                                            if (!isset($_SESSION['email'])) 
                                                            { ?>
                                                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                            <?php
                                                            } 
                                                            else 
                                                            {
                                                                if (check_if_added_to_cart($row["ProductID"]))
                                                                { 
                                                                    echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                                } 
                                                                else 
                                                                {
                                                            ?>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="product-size-form">
                                                <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                    <div class="form-group sizes">
                                                        <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                        <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                            <span class="size-list-span">XS</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                            <span class="size-list-span">S</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                            <span class="size-list-span">M</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                            <span class="size-list-span">L</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                            <span class="size-list-span">XL</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                            <span class="size-list-span">XXL</span>
                                                        </label>
                                                        <?php } ?>
                                                    </div> 
                                                    <br>
                                                    <?php 
                                                        if (!isset($_SESSION['email'])) 
                                                        { ?>
                                                            <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                        <?php
                                                        } 
                                                        else 
                                                        {
                                                            if (check_if_added_to_cart($row["ProductID"]))
                                                            { 
                                                                echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                            } 
                                                            else 
                                                            {
                                                        ?>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </th>
                            <?php }    
                        }?>
                    </tr>
                </table>
            </div>
            <a class="see-all" href="../home/all_shorts.php">See All ></a>
            
            
            <?php 
                $query = "SELECT * FROM products1";
                $result = mysqli_query($con, $query)or die(mysqli_error($con));
            ?> 
            <a href="../home/all_joggers.php" class="title-heading"><h2 style="margin-top:50px; padding-top:25px; color:#212a2f; font-weight:900;">Women's Joggers</h2></a>
            <p style="padding-top:5px;padding-bottom:5px;color: #212a2f;font-size:16px;font-weight:700;text-decoration:underline;">Featured</p>
            <div class="container-fluid text-center table-responsive text-nowrap">
                <table class="table w-100 table-fixed">
                    <tr>
                        <?php 
                        $number = 0;
                        while($row = mysqli_fetch_array($result)){
                            ++$number;
                            if($row["prod_subcategory"] == "Joggers" && $row["prod_featured"] == "yes")
                            { ?>
                                <th class="th-lg">
                                    <div class="container product-size-form-container" style="width:200px">
                                        <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>">
                                        <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id=<?php echo $row["ProductID"]; ?>" style="margin-top:10px; width:200px !important; height:auto;">
                                        </a>
                                        <div class="caption">
                                            <br>
                                            <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>" style="color:#212a2f; text-decoration: none;">
                                            <h3 class="product-name"><?php echo $row["prod_name"]; ?></h3>
                                            <p>Rs. <?php echo $row["prod_price"]; ?></p>  
                                            </a>
                                            <a class="quick-add" href="#collapse-size-form<?php echo $number; ?>" data-toggle="collapse">Quick Add + </a>
                                            <div class="collapse" id="collapse-size-form<?php echo $number; ?>">
                                                <div class="product-size-form-quick-add">
                                                    <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                        <div class="form-group sizes">
                                                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                            <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                                <span class="size-list-span">S</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                                <span class="size-list-span">M</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                                <span class="size-list-span">L</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                                <span class="size-list-span">XL</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                                <span class="size-list-span">XXL</span>
                                                            </label>
                                                            <?php } ?>
                                                        </div> 
                                                        <br>
                                                        <?php 
                                                            if (!isset($_SESSION['email'])) 
                                                            { ?>
                                                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                            <?php
                                                            } 
                                                            else 
                                                            {
                                                                if (check_if_added_to_cart($row["ProductID"]))
                                                                { 
                                                                    echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                                } 
                                                                else 
                                                                {
                                                            ?>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="product-size-form">
                                                <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                    <div class="form-group sizes">
                                                        <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                        <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                            <span class="size-list-span">XS</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                            <span class="size-list-span">S</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                            <span class="size-list-span">M</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                            <span class="size-list-span">L</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                            <span class="size-list-span">XL</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                            <span class="size-list-span">XXL</span>
                                                        </label>
                                                        <?php } ?>
                                                    </div> 
                                                    <br>
                                                    <?php 
                                                        if (!isset($_SESSION['email'])) 
                                                        { ?>
                                                            <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                        <?php
                                                        } 
                                                        else 
                                                        {
                                                            if (check_if_added_to_cart($row["ProductID"]))
                                                            { 
                                                                echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                            } 
                                                            else 
                                                            {
                                                        ?>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </th>
                            <?php }    
                        }?>
                    </tr>
                </table>
            </div>
            <a class="see-all" href="../home/all_joggers.php">See All ></a>
            
            
            <?php 
                $query = "SELECT * FROM products1";
                $result = mysqli_query($con, $query)or die(mysqli_error($con));
            ?> 
            <a href="../home/all_tank-tops.php" class="title-heading"><h2 style="margin-top:50px; padding-top:25px; color:#212a2f; font-weight:900;">Women's Tank-Tops</h2></a>
            <p style="padding-top:5px;padding-bottom:5px;color: #212a2f;font-size:16px;font-weight:700;text-decoration:underline;">Featured</p>
            <div class="container-fluid text-center table-responsive text-nowrap">
                <table class="table w-100 table-fixed">
                    <tr>
                        <?php 
                        $number = 0;
                        while($row = mysqli_fetch_array($result)){
                            ++$number;
                            if($row["prod_subcategory"] == "Tank-Top" && $row["prod_featured"] == "yes")
                            { ?>
                                <th class="th-lg">
                                    <div class="container product-size-form-container" style="width:200px">
                                        <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>">
                                        <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id=<?php echo $row["ProductID"]; ?>" style="margin-top:10px; width:200px !important; height:auto;">
                                        </a>
                                        <div class="caption">
                                            <br>
                                            <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>" style="color:#212a2f; text-decoration: none;">
                                            <h3 class="product-name"><?php echo $row["prod_name"]; ?></h3>
                                            <p>Rs. <?php echo $row["prod_price"]; ?></p>  
                                            </a>
                                            <a class="quick-add" href="#collapse-size-form<?php echo $number; ?>" data-toggle="collapse">Quick Add + </a>
                                            <div class="collapse" id="collapse-size-form<?php echo $number; ?>">
                                                <div class="product-size-form-quick-add">
                                                    <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                        <div class="form-group sizes">
                                                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                            <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                                <span class="size-list-span">S</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                                <span class="size-list-span">M</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                                <span class="size-list-span">L</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                                <span class="size-list-span">XL</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                                <span class="size-list-span">XXL</span>
                                                            </label>
                                                            <?php } ?>
                                                        </div> 
                                                        <br>
                                                        <?php 
                                                            if (!isset($_SESSION['email'])) 
                                                            { ?>
                                                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                            <?php
                                                            } 
                                                            else 
                                                            {
                                                                if (check_if_added_to_cart($row["ProductID"]))
                                                                { 
                                                                    echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                                } 
                                                                else 
                                                                {
                                                            ?>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="product-size-form">
                                                <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                    <div class="form-group sizes">
                                                        <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                        <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                            <span class="size-list-span">XS</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                            <span class="size-list-span">S</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                            <span class="size-list-span">M</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                            <span class="size-list-span">L</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                            <span class="size-list-span">XL</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                            <span class="size-list-span">XXL</span>
                                                        </label>
                                                        <?php } ?>
                                                    </div> 
                                                    <br>
                                                    <?php 
                                                        if (!isset($_SESSION['email'])) 
                                                        { ?>
                                                            <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                        <?php
                                                        } 
                                                        else 
                                                        {
                                                            if (check_if_added_to_cart($row["ProductID"]))
                                                            { 
                                                                echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                            } 
                                                            else 
                                                            {
                                                        ?>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </th>
                            <?php }    
                        }?>
                    </tr>
                </table>
            </div>
            <a class="see-all" href="../home/all_tank-tops.php">See All ></a>
            
            
            <?php 
                $query = "SELECT * FROM products1";
                $result = mysqli_query($con, $query)or die(mysqli_error($con));
            ?> 
            <a href="../home/all_jackets.php" class="title-heading"><h2 style="margin-top:50px; padding-top:25px; color:#212a2f; font-weight:900;">Women's Jackets</h2></a>
            <p style="padding-top:5px;padding-bottom:5px;color: #212a2f;font-size:16px;font-weight:700;text-decoration:underline;">Featured</p>
            <div class="container-fluid text-center table-responsive text-nowrap">
                <table class="table w-100 table-fixed">
                    <tr>
                        <?php 
                        $number = 0;
                        while($row = mysqli_fetch_array($result)){
                            ++$number;
                            if($row["prod_subcategory"] == "Jacket" && $row["prod_featured"] == "yes")
                            { ?>
                                <th class="th-lg">
                                    <div class="container product-size-form-container" style="width:200px">
                                        <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>">
                                        <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id=<?php echo $row["ProductID"]; ?>" style="margin-top:10px; width:200px !important; height:auto;">
                                        </a>
                                        <div class="caption">
                                            <br>
                                            <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>" style="color:#212a2f; text-decoration: none;">
                                            <h3 class="product-name"><?php echo $row["prod_name"]; ?></h3>
                                            <p>Rs. <?php echo $row["prod_price"]; ?></p>  
                                            </a>
                                            <a class="quick-add" href="#collapse-size-form<?php echo $number; ?>" data-toggle="collapse">Quick Add + </a>
                                            <div class="collapse" id="collapse-size-form<?php echo $number; ?>">
                                                <div class="product-size-form-quick-add">
                                                    <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                        <div class="form-group sizes">
                                                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                            <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                                <span class="size-list-span">S</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                                <span class="size-list-span">M</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                                <span class="size-list-span">L</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                                <span class="size-list-span">XL</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                                <span class="size-list-span">XXL</span>
                                                            </label>
                                                            <?php } ?>
                                                        </div> 
                                                        <br>
                                                        <?php 
                                                            if (!isset($_SESSION['email'])) 
                                                            { ?>
                                                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                            <?php
                                                            } 
                                                            else 
                                                            {
                                                                if (check_if_added_to_cart($row["ProductID"]))
                                                                { 
                                                                    echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                                } 
                                                                else 
                                                                {
                                                            ?>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="product-size-form">
                                                <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                    <div class="form-group sizes">
                                                        <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                        <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                            <span class="size-list-span">XS</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                            <span class="size-list-span">S</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                            <span class="size-list-span">M</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                            <span class="size-list-span">L</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                            <span class="size-list-span">XL</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                            <span class="size-list-span">XXL</span>
                                                        </label>
                                                        <?php } ?>
                                                    </div> 
                                                    <br>
                                                    <?php 
                                                        if (!isset($_SESSION['email'])) 
                                                        { ?>
                                                            <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                        <?php
                                                        } 
                                                        else 
                                                        {
                                                            if (check_if_added_to_cart($row["ProductID"]))
                                                            { 
                                                                echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                            } 
                                                            else 
                                                            {
                                                        ?>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </th>
                            <?php }    
                        }?>
                    </tr>
                </table>
            </div>
            <a class="see-all" href="../home/all_jackets.php">See All ></a>
            
            
            <?php 
                $query = "SELECT * FROM products1";
                $result = mysqli_query($con, $query)or die(mysqli_error($con));
            ?> 
            <a href="../home/all_sweatshirts.php" class="title-heading"><h2 style="margin-top:50px; padding-top:25px; color:#212a2f; font-weight:900;">Women's Sweat-Shirts</h2></a>
            <p style="padding-top:5px;padding-bottom:5px;color: #212a2f;font-size:16px;font-weight:700;text-decoration:underline;">Featured</p>
            <div class="container-fluid text-center table-responsive text-nowrap">
                <table class="table w-100 table-fixed">
                    <tr>
                        <?php 
                        $number = 0;
                        while($row = mysqli_fetch_array($result)){
                            ++$number;
                            if($row["prod_subcategory"] == "Sweatshirt" && $row["prod_featured"] == "yes")
                            { ?>
                                <th class="th-lg">
                                    <div class="container product-size-form-container" style="width:200px">
                                        <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>">
                                        <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id=<?php echo $row["ProductID"]; ?>" style="margin-top:10px; width:200px !important; height:auto;">
                                        </a>
                                        <div class="caption">
                                            <br>
                                            <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row["prod_color"]; ?>" style="color:#212a2f; text-decoration: none;">
                                            <h3 class="product-name"><?php echo $row["prod_name"]; ?></h3>
                                            <p>Rs. <?php echo $row["prod_price"]; ?></p>  
                                            </a>
                                            <a class="quick-add" href="#collapse-size-form<?php echo $number; ?>" data-toggle="collapse">Quick Add + </a>
                                            <div class="collapse" id="collapse-size-form<?php echo $number; ?>">
                                                <div class="product-size-form-quick-add">
                                                    <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                        <div class="form-group sizes">
                                                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                            <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                                <span class="size-list-span">S</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                                <span class="size-list-span">M</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                                <span class="size-list-span">L</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                                <span class="size-list-span">XL</span>
                                                            </label>
                                                            <?php } ?>
                                                            <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                            <label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                                <span class="size-list-span">XXL</span>
                                                            </label>
                                                            <?php } ?>
                                                        </div> 
                                                        <br>
                                                        <?php 
                                                            if (!isset($_SESSION['email'])) 
                                                            { ?>
                                                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                            <?php
                                                            } 
                                                            else 
                                                            {
                                                                if (check_if_added_to_cart($row["ProductID"]))
                                                                { 
                                                                    echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                                } 
                                                                else 
                                                                {
                                                            ?>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="product-size-form">
                                                <form method="post" action="../includes/cart-add.php?id=<?php echo $row["ProductID"]; ?>">
                                                    <div class="form-group sizes">
                                                        <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>
                                                        <?php if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                            <span class="size-list-span">XS</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                            <span class="size-list-span">S</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                            <span class="size-list-span">M</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                            <span class="size-list-span">L</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                            <span class="size-list-span">XL</span>
                                                        </label>
                                                        <?php } ?>
                                                        <?php if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {?>
                                                        <label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                            <span class="size-list-span">XXL</span>
                                                        </label>
                                                        <?php } ?>
                                                    </div> 
                                                    <br>
                                                    <?php 
                                                        if (!isset($_SESSION['email'])) 
                                                        { ?>
                                                            <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>
                                                        <?php
                                                        } 
                                                        else 
                                                        {
                                                            if (check_if_added_to_cart($row["ProductID"]))
                                                            { 
                                                                echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                            } 
                                                            else 
                                                            {
                                                        ?>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </th>
                            <?php }    
                        }?>
                    </tr>
                </table>
            </div>
            <a class="see-all" href="../home/all_sweatshirts.php">See All ></a>
            
            
            
        </div>
        <div id="footer">
            <?php
                include("../includes/footer.php");
            ?>
        </div>     
    </body>
</html>