<?php
require("../includes/connect.php");

if(isset($_REQUEST['id'])){
    if(isset($_REQUEST['save_review'])){
        $item_id = $_REQUEST['id'];
        $email = $_SESSION['email'];
        $title = mysqli_real_escape_string($con, $_REQUEST['title']);
        $comment = mysqli_real_escape_string($con, $_REQUEST['comment']);
        $rating = $_SESSION['rating'];
        $rating++;
        
        $query = "INSERT INTO user_ratings (Email, ProductID, rating, title, comment) VALUES('$email', '$item_id', '$rating', '$title', '$comment')";
        mysqli_query($con, $query);
        
        $query2 = "SELECT styleCode, prod_color FROM products1 WHERE ProductID='$item_id' LIMIT 1";
        $result = mysqli_query($con, $query2);
        $row = mysqli_fetch_array($result);
        
        header('location: ../home/product.php?styleCode='.$row['styleCode'].'&color='.$row['prod_color']);
    }
}
?>