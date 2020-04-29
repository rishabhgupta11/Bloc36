<?php
    require("../includes/connect.php");
    if(isset($_REQUEST['id'])) 
    {
        $id =  $_REQUEST["id"];
        $query = "SELECT prod_img_2 FROM product_images WHERE ProductID='$id'";
        $result = mysqli_query($con, $query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($con));
        $row = mysqli_fetch_array($result);
        header("content-type: image/jpeg");
        echo $row["prod_img_2"];
    }
    else
    {
        echo "error";
    }
?>

