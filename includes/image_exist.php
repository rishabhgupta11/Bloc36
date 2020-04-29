<?php
    function imageexist1($id)
    {
        require("../includes/connect.php");
        $query = "SELECT prod_img_1 FROM product_images WHERE ProductID='$id'";
        $result = mysqli_query($con, $query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($con));
        $row = mysqli_fetch_array($result);
        if($row["prod_img_1"] == NULL)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    } 
    
    
    function imageexist2($id)
    {
        require("../includes/connect.php");
        $query = "SELECT prod_img_2 FROM product_images WHERE ProductID='$id'";
        $result = mysqli_query($con, $query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($con));
        $row = mysqli_fetch_array($result);
        if($row["prod_img_2"] == NULL)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    
    function imageexist3($id)
    {
        require("../includes/connect.php");
        $query = "SELECT prod_img_3 FROM product_images WHERE ProductID='$id'";
        $result = mysqli_query($con, $query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($con));
        $row = mysqli_fetch_array($result);
        if($row["prod_img_3"] == NULL)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    
    function imageexist4($id)
    {
        require("../includes/connect.php");
        $query = "SELECT prod_img_4 FROM product_images WHERE ProductID='$id'";
        $result = mysqli_query($con, $query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($con));
        $row = mysqli_fetch_array($result);
        if($row["prod_img_4"] == NULL)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    
    function imageexist5($id)
    {
        require("../includes/connect.php");
        $query = "SELECT prod_img_5 FROM product_images WHERE ProductID='$id'";
        $result = mysqli_query($con, $query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($con));
        $row = mysqli_fetch_array($result);
        if($row["prod_img_5"] == NULL)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    
    function imageexist6($id)
    {
        require("../includes/connect.php");
        $query = "SELECT prod_img_6 FROM product_images WHERE ProductID='$id'";
        $result = mysqli_query($con, $query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($con));
        $row = mysqli_fetch_array($result);
        if($row["prod_img_6"] == NULL)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
?>
