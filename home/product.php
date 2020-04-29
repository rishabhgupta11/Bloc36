<?php
    require("../includes/connect.php");
    include("../includes/check_if_added.php");
    include("../includes/image_exist.php");
?>   

<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
?>
<?php 
if (isset($_GET['id'])) {  
    $id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
    $query = "SELECT * FROM products1 WHERE ProductID='$id' LIMIT 1";
    $result = mysqli_query($con, $query)or die(mysqli_error($con));
    $productCount = mysqli_num_rows($result);
    if ($productCount > 0) {
        while($row = mysqli_fetch_array($result)){ 
            $name = $row["prod_name"];
            $price = $row["prod_price"];
            $details = $row["prod_details"];
            $category = $row["prod_category"];
            $subcategory = $row["prod_subcategory"];
            $color = $row["prod_color"];
            $fit = $row["prod_fit"];
            $material = $row["prod_material"];
            $length = $row["prod_length"];
            $size_xs = $row["prod_size_xs"];
            $size_s = $row["prod_size_s"];
            $size_m = $row["prod_size_m"];
            $size_l = $row["prod_size_l"];
            $size_xl = $row["prod_size_xl"];
            $size_xxl = $row["prod_size_xxl"];
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
            <div class="row" style="margin-top:40px;">
                <h2 style="letter-spacing: 1.5px; text-decoration:underline; margin-left:10%; font-size:18px; font-weight:600; display:inline;"> <?php echo $category; ?> </h2>
                <h2 style="letter-spacing: 1.5px; margin-left:1%; font-size:18px; font-weight:600; display:inline;"> > </h2>
                <h2 style="letter-spacing: 1.5px; text-decoration:underline; margin-left:1%; font-size:18px; font-weight:600; display:inline;"> <?php echo $subcategory; ?> </h2>
            </div>
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
                    <h1 style="white-space:nowrap; letter-spacing: 1.5px; font-size: 30px; font-weight:900;"><?php echo $name; ?></h1>
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
                    <br>
                    <h4 style="margin-top:20px; letter-spacing: 1.5px; font-size: 15px; font-weight:700;">Description:</h4>
                    <h2 style="letter-spacing: 0.75px; font-size:15px; font-weight:300"> <?php echo $details; ?> </h2>
                    <br>
                    <form method="post" action="../includes/cart-add.php?id=<?php echo $id; ?>">
                        <div class="form-group">
                            <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700;">Size</h4>
                            <select class="form-control" id="size" name="size">
                                <?php if($size_xs == 'yes') {?>
                                <option> XS </option>
                                <?php } ?>
                                <?php if($size_s == 'yes') {?>
                                <option> S </option>
                                <?php } ?>
                                <?php if($size_m == 'yes') {?>
                                <option> M </option>
                                <?php } ?>
                                <?php if($size_l == 'yes') {?>
                                <option> L </option>
                                <?php } ?>
                                <?php if($size_xl == 'yes') {?>
                                <option> XL </option>
                                <?php } ?>
                                <?php if($size_xxl == 'yes') {?>
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
                            { ?>
                                <a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Add to Cart</button></a>
                            <?php
                            } else {
                                if (check_if_added_to_cart($id))
                                    { 
                                        echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>Added to Cart</button></a>';
                                    } else {
                                    ?>
                                        <div class="form-group">
                                            <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Add to Cart </span></button>
                                        </div>
                                    <?php
                                            }
                                    }?>
                    </form>
                </div> 
                <br>
                <div class="col-lg"></div>
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
