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
        
        header('location: ../home/product.php?id='.$item_id);
    }
}
?>