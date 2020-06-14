<?php
    require("../includes/connect.php");
    include("../includes/check_if_added.php");
    require("../includes/connect2.php");
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
        <title>BLOC36</title>
    </head>
    <body>
        <?php
        include("../includes/header.php");
        ?>
        <div class="container-fluid" style="margin-top: 60px; padding: 0px;">
            <div class="row no-gutters">
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="prod-women-image">
                        <img class="prod-women-image-2" src="../images/shorts-banner.jpg" alt="BLOC36">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 prod-women-banner">
                    <div style='padding:16%'>
                        <h1 style='font-size: 1.5rem'> Women's Shorts </h1>
                        <h4 style='font-size: 0.9rem'> The world’s most comfortable shorts made from premium materials go perfectly with your daily escapades. </h4>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="container" style="padding:0;">
                <center>
                <ul class="mr-auto filter">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Color</a>
                        <div class="dropdown-menu">
                            <div style="width: 200px; height: auto; overflow-y: auto; overflow-x: hidden;">
                            <?php
                                $sql="SELECT DISTINCT prod_color FROM products1 WHERE prod_subcategory='Shorts' ORDER BY prod_color";
                                $result=$conn->query($sql);
                                while($row=$result->fetch_assoc()){
                                ?>
                                <br>
                                <div class="checkbox" style="margin-left:10px;">
                                    <label>
                                        <input type="checkbox" class="product_check" value="<?= $row['prod_color']; ?>" id="color" style="display:inline; vertical-align:-2px;"><p style="white-space:nowrap; display:inline; padding:5px;"><?= $row['prod_color']; ?></p>
                                    </label>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Fit</a>
                        <div class="dropdown-menu">
                            <div style="width: 200px; height: auto; overflow-y: auto; overflow-x: hidden;">
                            <?php
                            $sql="SELECT DISTINCT prod_fit FROM products1 WHERE prod_subcategory='Shorts' ORDER BY prod_fit";
                            $result=$conn->query($sql);
                            while($row=$result->fetch_assoc()){
                            ?>
                                <br>
                                <div class="checkbox" style="margin-left:10px;">
                                    <label>
                                        <input type="checkbox" class="product_check" value="<?= $row['prod_fit']; ?>" id="fit" style="display:inline; vertical-align:-2px;"><p style=" white-space:nowrap; display:inline; padding:5px;"><?= $row['prod_fit']; ?></p>
                                    </label>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Material</a>
                        <div class="dropdown-menu">
                            <div style="width: 200px; height: auto; overflow-y: auto; overflow-x: hidden;">
                            <?php
                            $sql="SELECT DISTINCT prod_material FROM products1 WHERE prod_subcategory='Shorts' ORDER BY prod_material";
                            $result=$conn->query($sql);
                            while($row=$result->fetch_assoc()){
                            ?>
                                <br>
                                <div class="checkbox" style="margin-left:10px;">
                                    <label>
                                        <input type="checkbox" class="product_check" value="<?= $row['prod_material']; ?>" id="material" style="display:inline; vertical-align:-2px;"><p style="white-space:nowrap; display:inline; padding:5px;"><?= $row['prod_material']; ?></p>
                                    </label>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Length</a>
                        <div class="dropdown-menu">
                            <div style="width: 200px; height: auto; overflow-y: auto; overflow-x: hidden;">
                            <?php
                            $sql="SELECT DISTINCT prod_length FROM products1 WHERE prod_subcategory='Shorts' ORDER BY prod_length";
                            $result=$conn->query($sql);
                            while($row=$result->fetch_assoc()){
                            ?>
                                <br>
                                <div class="checkbox" style="margin-left:10px;">
                                    <label>
                                        <input type="checkbox" class="product_check" value="<?= $row['prod_length']; ?>" id="length" style="display:inline; vertical-align:-2px;"><p style="white-space:nowrap; display:inline; padding:5px;"><?= $row['prod_length']; ?></p>
                                    </label>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </li>
                </ul>
                </center>
            </div>
        </div>
        
        <div class="container"> 
            <h2 style="margin-top:50px;padding-top:25px;color:#212a2f; font-weight:900;">Women's Shorts</h2>
            <p id="textChange" style="padding-top:5px;padding-bottom:5px;color: #212a2f;font-size:16px;font-weight:700;text-decoration:underline;">All Items</p>
            <hr>
        </div>
        
        <div class="container" style="margin-bottom:130px;padding-bottom:25px;">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <img src="../images/loader.gif" id="loader" width="250"  style="display:none;">
                    </div>
                    <div class="row text-center" id="result">
                        <?php
                            $number=0;
                            $sql="SELECT * FROM products1 WHERE prod_subcategory='Shorts'";
                            $result=$conn->query($sql);
                            while($row = $result->fetch_assoc())
                            {
                                ++$number;
                        ?>
                                <div class="col col-xs-6 col-lg-3" style="margin-top: 50px;">
                                    <div class="container product-size-form-container">
                                        <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row['prod_color']; ?>">
                                        <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id=<?php echo $row["ProductID"]; ?>" style="width:200px !important;height:auto;">
                                        </a>
                                        <div class="caption">
                                            <a href="../home/product.php?styleCode=<?php echo $row["styleCode"]; ?>&color=<?php echo $row['prod_color']; ?>" style="color:#212a2f; text-decoration: none;">
                                            <h3 class="product-name"><?php echo $row["prod_name"]; ?></h3>
                                            <p style="font-weight:bold;">Rs. <?php echo $row["prod_price"]; ?></p>  
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
                                                    <div class="form-group">
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
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                
                $(".product_check").click(function(){
                    $("#loader").show();
                    var action = 'data';
                    var product = 'Shorts';
                    var color = get_filter_text('color');
                    var fit = get_filter_text('fit');
                    var material = get_filter_text('material');
                    var length = get_filter_text('length');
                   
                    $.ajax({
                        url: '../includes/fetch_products.php',
                        method: 'POST',
                        data:{action:action, product:product, color:color, fit:fit, material:material, length:length},
                        success:function(data){
                            $("#result").html(data);
                            $("#loader").hide();
                            $("#textChange").text("Filtered Products");
                        }
                    });
                });
                
                function get_filter_text(text_id){
                    var filterData = [];
                    $('#'+text_id+':checked').each(function(){
                        filterData.push($(this).val());
                    });
                    return filterData;
                };
                
            });
        </script>
    </body>
</html>
