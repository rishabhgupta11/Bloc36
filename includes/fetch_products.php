<?php
require("../includes/connect2.php");
include("../includes/check_if_added.php");

if(isset($_POST['action'])){
    $product = $_POST['product'];
    $sql= "SELECT * FROM products1 WHERE prod_subcategory='$product'";
    
    if(isset($_POST['color'])){
        $color = implode("','", $_POST['color']);
        $sql .= "AND prod_color IN('".$color."')";
    }
    if(isset($_POST['fit'])){
        $fit = implode("','", $_POST['fit']);
        $sql .= "AND prod_fit IN('".$fit."')";
    }
    if(isset($_POST['material'])){
        $material = implode("','", $_POST['material']);
        $sql .= "AND prod_material IN('".$material."')";
    }
    if(isset($_POST['length'])){
        $length = implode("','", $_POST['length']);
        $sql .= "AND prod_length IN('".$length."')";
    }
    $number=0;
    $result = $conn->query($sql);
    $output = '';
    
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            ++$number;
            $output.='  <div class="col col-xs-6 col-lg-3" style="margin-top: 50px;">
                            <div class="container product-size-form-container">
                                <a href="../home/product.php?styleCode='.$row["styleCode"].'&color='.$row['prod_color'].'">
                                <img class="img-fluid img-thumbnail women-prod-image" src="../includes/image_view_1.php?id='.$row["ProductID"].'" style="width:200px !important;height:auto;">
                                </a>
                                <div class="caption">
                                    <a href="../home/product.php?styleCode='.$row["styleCode"].'&color='.$row['prod_color'].'" style="color:#212a2f; text-decoration: none;">
                                    <h3 class="product-name">'.$row["prod_name"].'</h3>
                                    <p style="font-weight:bold;">Rs. '.$row["prod_price"].'</p>  
                                    </a>
                                    <a class="quick-add" href="#collapse-size-form'.$number.'" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse-size-form">Quick Add  +</a>
                                    <div class="collapse" id="collapse-size-form'.$number.'">
                                        <div class="product-size-form-quick-add">
                                            <form method="post" action="../includes/cart-add.php?id='.$row["ProductID"].'">
                                                <div class="form-group sizes">
                                                    <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>';
                                                    if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {
                                                    $output.='<label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                              </label>';
                                                    } 
                                                    if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {
                                                    $output.='<label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                                <span class="size-list-span">S</span>
                                                              </label>';
                                                    }
                                                    if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {
                                                    $output.='<label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                                <span class="size-list-span">M</span>
                                                              </label>';
                                                    }
                                                    if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {
                                                    $output.='<label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                                <span class="size-list-span">L</span>
                                                              </label>';
                                                    }
                                                    if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {
                                                    $output.='<label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                                <span class="size-list-span">XL</span>
                                                              </label>';
                                                    }
                                                    if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {
                                                    $output.='<label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                                <span class="size-list-span">XXL</span>
                                                              </label>';
                                                    }
                                      $output.='</div> 
                                                <br>';
                                                    if (!isset($_SESSION['email'])) 
                                                    {
                                                        $output.='<a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>';
                                                    
                                                    } 
                                                    else 
                                                    {
                                                        if (check_if_added_to_cart($row["ProductID"]))
                                                        { 
                                                            echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                        } 
                                                        else 
                                                        {
                                                    
                                                  $output.='<div class="form-group">
                                                                <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                            </div>';
                                                    
                                                        }
                                                    }
                                  $output.='</form>
                                        </div>
                                    </div>
                                    <div class="product-size-form">
                                        <form method="post" action="../includes/cart-add.php?id='.$row["ProductID"].'">
                                            <div class="form-group">
                                                <h4 style="letter-spacing: 1.5px; font-size: 15px; font-weight:700; color:#212a2f;">Size</h4>';
                                                if($row["prod_size_xs"] == 'yes' && $row["inventory_size_xs"] > 3) {
                                                    $output.='<label>
                                                                <input class="size-list-input" type="radio" name="size" id="size" value="XS" checked>
                                                                <span class="size-list-span">XS</span>
                                                              </label>';
                                                } 
                                                if($row["prod_size_s"] == 'yes' && $row["inventory_size_s"] > 3) {
                                                $output.='<label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="S">
                                                            <span class="size-list-span">S</span>
                                                          </label>';
                                                }
                                                if($row["prod_size_m"] == 'yes' && $row["inventory_size_m"] > 3) {
                                                $output.='<label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="M">
                                                            <span class="size-list-span">M</span>
                                                          </label>';
                                                }
                                                if($row["prod_size_l"] == 'yes' && $row["inventory_size_l"] > 3) {
                                                $output.='<label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="L">
                                                            <span class="size-list-span">L</span>
                                                          </label>';
                                                }
                                                if($row["prod_size_xl"] == 'yes' && $row["inventory_size_xl"] > 3) {
                                                $output.='<label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XL">
                                                            <span class="size-list-span">XL</span>
                                                          </label>';
                                                }
                                                if($row["prod_size_xxl"] == 'yes' && $row["inventory_size_xxl"] > 3) {
                                                $output.='<label>
                                                            <input class="size-list-input" type="radio" name="size" id="size" value="XXL">
                                                            <span class="size-list-span">XXL</span>
                                                          </label>';
                                                }
                                  $output.='</div> 
                                            <br>';
                                                if (!isset($_SESSION['email'])) 
                                                {
                                                    $output.='<a href="../home/login.php"><button type="button" class="button1" style="vertical-align:middle">Cart</button></a>';

                                                } 
                                                else 
                                                {
                                                    if (check_if_added_to_cart($row["ProductID"]))
                                                    { 
                                                        echo '<a><button type="button" class="button1" style="vertical-align:middle" disabled>In Cart</button></a>';
                                                    } 
                                                    else 
                                                    {

                                              $output.='<div class="form-group">
                                                            <button type="submit" class="button1" style="vertical-align:middle" id="add_cart" name="add_cart"><span>Cart</span></button>
                                                        </div>';

                                                    }
                                                }
                              $output.='</form>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
    }
    else{
        $output= "<h3>No Products Found.</h3>";
    }
    echo $output;
}

?>

