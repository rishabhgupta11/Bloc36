<?php
    require("../includes/connect.php");
    include("../includes/check_if_added.php");
    include("../includes/image_exist.php");
    require('../includes/delhivery_config.php');
?>   

<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
?>
<?php 
if (isset($_GET['styleCode']) && isset($_GET['color'])) {  
    $styleCode = $_GET['styleCode'];
    $color = $_GET['color'];
    $query = "SELECT * FROM products1 WHERE styleCode='$styleCode' AND prod_color='$color' LIMIT 1";
    $result = mysqli_query($con, $query)or die(mysqli_error($con));
    $productCount = mysqli_num_rows($result);
    if ($productCount > 0) {
        while($row = mysqli_fetch_array($result)){ 
            $id = $row["ProductID"];
            $name = $row["prod_name"];
            $price = $row["prod_price"];
            $details = $row["prod_details"];
            $category = $row["prod_category"];
            $subcategory = $row["prod_subcategory"];
            $fit = $row["prod_fit"];
            $material = $row["prod_material"];
            $length = $row["prod_length"];
            $size_xs = $row["prod_size_xs"];
            $size_s = $row["prod_size_s"];
            $size_m = $row["prod_size_m"];
            $size_l = $row["prod_size_l"];
            $size_xl = $row["prod_size_xl"];
            $size_xxl = $row["prod_size_xxl"];
            $inventory_xs = $row["inventory_size_xs"];
            $inventory_s = $row["inventory_size_s"];
            $inventory_m = $row["inventory_size_m"];
            $inventory_l = $row["inventory_size_l"];
            $inventory_xl = $row["inventory_size_xl"];
            $inventory_xxl = $row["inventory_size_xxl"];
        }
    } 
    else 
    {
        echo "That item does not exist.";
        exit();
    }
} 
else 
{
    echo "Data to render this page is missing.";
    exit();
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
        <div class="container-fluid product_page">
            <div class="row" style="margin:80px 0px 80px 0px;">
                <div class="col-lg"></div>
                <br>
                <div class="col-lg text-center">
                    <div id="carouselExampleIndicators" class="carousel slide product-product-image" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php  
                            if(imageexist1($id) == 0)
                            {
                            ?> 
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <?php
                            }
                            ?>
                            <?php  
                            if(imageexist2($id) == 0)
                            {
                            ?> 
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <?php
                            }
                            ?><?php  
                            if(imageexist3($id) == 0)
                            {
                            ?> 
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <?php
                            }
                            ?><?php  
                            if(imageexist4($id) == 0)
                            {
                            ?> 
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            <?php
                            }
                            ?><?php  
                            if(imageexist5($id) == 0)
                            {
                            ?> 
                            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                            <?php
                            }
                            ?><?php  
                            if(imageexist6($id) == 0)
                            {
                            ?> 
                            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                            <?php
                            }
                            ?>
                            
                        </ol>
                        <div class="carousel-inner">
                            <?php  
                            if(imageexist1($id) == 0)
                            {
                            ?>    
                                <div class="carousel-item active">
                                    <a href="../includes/image_view_1.php?id=<?php echo $id; ?>"> <img src="../includes/image_view_1.php?id=<?php echo $id; ?>" width="280" height="425"> </a><br>
                                </div>
                            <?php
                            }
                            ?>
                            
                            <?php  
                            if(imageexist2($id) == 0)
                            {
                            ?>    
                                <div class="carousel-item">
                                    <a href="../includes/image_view_2.php?id=<?php echo $id; ?>"> <img src="../includes/image_view_2.php?id=<?php echo $id; ?>" width="280" height="425"> </a><br>
                                </div>
                            <?php
                            }
                            ?>
                            
                            <?php  
                            if(imageexist3($id) == 0)
                            {
                            ?>    
                                <div class="carousel-item">
                                    <a href="../includes/image_view_3.php?id=<?php echo $id; ?>"> <img src="../includes/image_view_3.php?id=<?php echo $id; ?>" width="280" height="425"> </a><br>
                                </div>
                            <?php
                            }
                            ?>
                            
                            <?php  
                            if(imageexist4($id) == 0)
                            {
                            ?>    
                                <div class="carousel-item">
                                    <a href="../includes/image_view_4.php?id=<?php echo $id; ?>"> <img src="../includes/image_view_4.php?id=<?php echo $id; ?>" width="280" height="425"> </a><br>
                                </div>
                            <?php
                            }
                            ?>
                            
                            <?php  
                            if(imageexist5($id) == 0)
                            {
                            ?>    
                                <div class="carousel-item">
                                    <a href="../includes/image_view_5.php?id=<?php echo $id; ?>"> <img src="../includes/image_view_5.php?id=<?php echo $id; ?>" width="280" height="425"> </a><br>
                                </div>
                            <?php
                            }
                            ?>
                            
                            <?php  
                            if(imageexist6($id) == 0)
                            {
                            ?>    
                                <div class="carousel-item">
                                    <a href="../includes/image_view_6.php?id=<?php echo $id; ?>" ><img src="../includes/image_view_6.php?id=<?php echo $id; ?>" width="280" height="425"> </a><br>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <br>
                <div class="col-lg"></div>
                <br>
                <div class="col-lg">
                    <br>
                    <div style="display:flex; flex-direction:row; justify-content:flex-start;">
                        <h1 style="white-space:nowrap; letter-spacing: 1.5px; font-size: 30px; font-weight:900;"><?php echo $name; ?></h1>
                        &emsp;
                        <?php
                        if(isset($_SESSION['email']))
                        {
                            if(!check_if_added_to_wishlist($id))
                            {
                            ?>
                                <span title="Wishlist" style="padding-top:10px; font-size:20px; cursor:pointer;" onclick="wishlist_func()" id="wishlist" class="material-icons">favorite_border</span>
                            <?php
                            }
                            else
                            {
                            ?>
                                <span title="Wishlist" style="padding-top:10px; font-size:20px; cursor:pointer; color:red;" onclick="wishlist_func()" id="wishlist" class="material-icons">favorite</span>

                            <?php
                            }
                        }
                        else
                        {
                        ?>
                            <a style="text-decoration:none !important;color:black;" href="../home/login.php"><span title="Wishlist" style="padding-top:10px; font-size:20px; cursor:pointer;" class="material-icons">favorite_border</span></a>
                        <?php
                        }
                        ?>
                        <script>
                            function wishlist_func()
                            {
                                var x = document.getElementById("wishlist").innerText;
                                if(x == 'favorite_border')
                                {
                                    document.getElementById("wishlist").innerHTML="favorite";
                                    document.getElementById("wishlist").style.color="red";
                                    var action = 'action';
                                    $.ajax({
                                        url: '../includes/wishlist-add.php',
                                        method: 'POST',
                                        data:{action:action, ProductID:<?php echo $id;?>},
                                        success:function(data){
                                            console.log(data);
                                        }
                                    });
                                }
                                else
                                {
                                    document.getElementById("wishlist").innerHTML="favorite_border";
                                    document.getElementById("wishlist").style.color="black";
                                    $.ajax({
                                        url: '../includes/wishlist-remove.php',
                                        method: 'POST',
                                        data:{ProductID:<?php echo $id;?>},
                                        success:function(data){
                                            console.log(data);
                                        }
                                    });
                                }
                            }
                        </script>
                    </div>
                    <br>
                    <h2 style="letter-spacing: 1.5px; font-size:18px; font-weight:600"> Rs. <?php echo $price; ?> </h2>
                    <?php
                    $total = 0;
                    $number = 0;
                    $query4 = "SELECT rating FROM user_ratings WHERE ProductID='$id'";
                    $result4 = mysqli_query($con,$query4)or die(mysqli_error($con));
                    $productCount4 = mysqli_num_rows($result4);
                    if ($productCount4 > 0) 
                    {
                        while($row4 = mysqli_fetch_array($result4))
                        {
                            $total += $row4["rating"];
                            $number++;
                        }
                        $rateoProd = 0;
                        $rateoProd = $total/$number;
                        $rounded = round($rateoProd);
                        for($i=1; $i<=$rounded; $i++)
                        {
                            echo"<span style='font-size:15px;' class='material-icons'>star</span>";
                        }
                    }
                    else
                    {
                        echo"<p>No Rating Yet</p>";
                    }
                    ?>
                    <h4 style="margin-top:20px; letter-spacing: 1.5px; font-size: 15px; font-weight:700;">Description:</h4>
                    <h2 style="letter-spacing: 0.75px; font-size:15px; font-weight:300"> <?php echo $details; ?> </h2>
                    <br>
                    <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700;">Color</h4>
                    <?php
                    $color_query = "SELECT DISTINCT prod_color FROM products1 WHERE styleCode='$styleCode'";
                    $color_result = mysqli_query($con, $color_query);
                    ?>
                    <select class="form-control" onchange="location = this.value">
                        <?php
                        while($color_row = mysqli_fetch_array($color_result))
                        {
                        ?>
                        <option value="../home/product.php?styleCode=<?php echo $styleCode; ?>&color=<?php echo $color_row['prod_color']; ?>" <?php if($color == $color_row['prod_color']){ ?> selected <?php } ?>><?php echo $color_row['prod_color']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <form method="post" action="../includes/cart-add.php?id=<?php echo $id; ?>">
                        <div class="form-group">
                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700;">Size</h4>
                            <select class="form-control" id="size" name="size">
                                <?php if($size_xs == 'yes' && $inventory_xs > 3) {?>
                                <option> XS </option>
                                <?php } ?>
                                <?php if($size_s == 'yes' && $inventory_s > 3) {?>
                                <option> S </option>
                                <?php } ?>
                                <?php if($size_m == 'yes' && $inventory_m > 3) {?>
                                <option> M </option>
                                <?php } ?>
                                <?php if($size_l == 'yes' && $inventory_l > 3) {?>
                                <option> L </option>
                                <?php } ?>
                                <?php if($size_xl == 'yes' && $inventory_xl > 3) {?>
                                <option> XL </option>
                                <?php } ?>
                                <?php if($size_xxl == 'yes' && $inventory_xxl > 3) {?>
                                <option> XXL </option>
                                <?php } ?>
                            </select>
                            <p style="letter-spacing: 1px; display: inline; color:#212a2f; font-size:12px; font-weight: 600;"> Confused? </p><a href="#" style="letter-spacing: 1px; text-decoration:underline; color:#212a2f; font-size:12px; font-weight: 600;">View Size Guide</a>
                        </div>    
                        <div class="form-group">
                            <h4 style=" letter-spacing: 1.5px; font-size: 15px; font-weight:700;">Quantity</h4>
                            <select class="form-control" id="quantity" name="quantity">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>  
                        <br>
                        <?php 
                            if (!isset($_SESSION['email'])) 
                            { 
                        ?>
                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Add to Cart</button></a>
                        <?php
                            } 
                            else 
                            {
                                if (check_if_added_to_cart($id))
                                { 
                                    echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>Added to Cart</button></a>';
                                } 
                                else 
                                {
                        ?>
                                    <div class="form-group">
                                        <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Add to Cart </span></button>
                                    </div>
                        <?php
                                }
                            }
                        ?>
                    </form>
                </div> 
                <br>
                <div class="col-lg"></div>
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="container" style="margin-bottom:50px;">
                            <h5 style="text-decoration:underline;">Check Pin-Code Serviceability</h5>
                            <div style="display:flex;">
                                <input style="margin-top:7px;width:200px;" type="text" maxlength="6" class="form-control" name="pincode" id="pincode" value="" placeholder="Enter 6-Digit Pin-Code" required>
                                <img src="../images/loader.gif" id="loader" width="40" style="margin-top:7px;display:none">
                                <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button" name="checkPincode" id="checkPincode" onclick="checkService()" style="cursor:pointer;margin-top:7px;background-color:#b8beff;padding:7px 10px 0px 10px;border-radius:.25rem">search</i>
                            </div>    
                            <br>
                            <p id="service" style="font-size:14px; font-weight:bold;"></p>
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
            </div>
            
            <div class="container">
                <div class="row" style="margin:0px 0px 80px 0px;">
                    <div class="col-lg">
                        <h5 style="text-decoration:underline;">All Reviews</h5><br>
                         <?php
                        $query2 = "SELECT * FROM user_ratings JOIN user ON user_ratings.Email = user.Email WHERE ProductID='$id'";
                        $result2 = mysqli_query($con,$query2)or die(mysqli_error($con));
                        $productCount2 = mysqli_num_rows($result2);
                        if ($productCount2 > 0) 
                        {
                            while($row2 = mysqli_fetch_array($result2))
                            {
                                $uname = $row2["Name"];
                                $rating = $row2["rating"];
                                $title = $row2["title"];
                                $comment = $row2["comment"];
                        ?>   
                        <p style="font-weight:bold; font-size:14px; margin-top:20px; margin-bottom:5px;"><?php echo $uname; ?></p>
                        <?php
                        for($i=1; $i<=$rating; $i++)
                        {
                            echo"<span style='font-size:15px;' class='material-icons'>star</span>";
                        }
                        ?>
                        <p style="font-weight:bold; font-size:13px; margin-top:1rem; margin-bottom:0px;"><?php echo $title; ?></p>
                        <p style="font-size:13px;"><?php echo $comment; ?></p><br><hr>
                        <?php
                            }
                        }
                        else
                        {
                            echo"<h6> No Reviews Yet </h6>";
                        }
                        ?>       
                    </div><br>
                    
                    
                    <div class="col-lg"></div><br>
                    
                    
                    <?php
                    if(isset($_SESSION['email']))
                    {
                        $query3 = 'SELECT * FROM user_ratings WHERE ProductID="'.$id.'" AND Email="'.$_SESSION['email'].'"';
                        $result3 = mysqli_query($con,$query3)or die(mysqli_error($con));
                        $productCount3 = mysqli_num_rows($result3);
                        if ($productCount3 > 0) 
                        {
                            while($row3 = mysqli_fetch_array($result3))
                            {
                                $rating = $row3["rating"];
                                $title = $row3["title"];
                                $comment = $row3["comment"];
                    ?>
                                <div class="col-lg">
                                    <h5 style="text-decoration:underline;">Your Review</h5><br><br>
                                    <?php
                                    for($i=1; $i<=$rating; $i++)
                                    {
                                        echo"<span style='font-size:15px;' class='material-icons'>star</span>";
                                    }
                                    ?>
                                    <p style="font-weight:bold; font-size:13px; margin-top:1rem; margin-bottom:0px;"><?php echo $title; ?></p>
                                    <p style="font-size:13px;"><?php echo $comment; ?></p>
                                </div>
                    <?php
                            }
                        }
                        else
                        {
                    ?>
                            <div class="col-lg">
                                <h5 style="text-decoration:underline;">Leave a Review</h5><br><br>
                                <label>Rating</label>
                                <div>
                                    <i class="fa fa-star" data-index="0"></i>
                                    <i class="fa fa-star" data-index="1"></i>
                                    <i class="fa fa-star" data-index="2"></i>
                                    <i class="fa fa-star" data-index="3"></i>
                                    <i class="fa fa-star" data-index="4"></i>
                                    <br><br>
                                </div>
                                <form method="post" action="../includes/save_review.php?id=<?php echo $id; ?>">

                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" id="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <input type="text" class="form-control" name="comment" id="comment">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="rating" id="rating" value="<?php echo $_SESSION['rating']; ?>" required>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="button10 button105" style="vertical-align:middle" id="save_review" name="save_review"><span>SUBMIT </span></button>
                                    </div>
                                </form>
                            </div><br>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>    
        
        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>  
        
        
        <script>
            var ratedIndex = -1;
            var action = 'data';

            $(document).ready(function(){
                resetStarColors();

                $('.fa-star').on('click', function(){
                    ratedIndex = parseInt($(this).data('index'));
                    $.ajax({
                        url: '../includes/get_rating.php',
                        method: 'POST',
                        data:{action:action, ratedIndex:ratedIndex},
                        success:function(data){
                            console.log(data);
                        }
                    });
                });

                $('.fa-star').mouseover(function(){
                    resetStarColors();
                    var currentIndex = parseInt($(this).data('index'));
                    setStars(currentIndex);
                });

                $('.fa-star').mouseleave(function(){
                    resetStarColors();

                    if (ratedIndex != -1)
                        setStars(ratedIndex);
                });
            });

            function setStars(max) {
                for (var i=0; i <= max; i++)
                    $('.fa-star:eq('+i+')').css('color', 'black');
            }

            function resetStarColors() {
                $('.fa-star').css('color', 'grey');
            }
        </script>
        
    
    </body>
</html>
