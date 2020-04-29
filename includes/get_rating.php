<?php

require('../includes/connect.php');

if(isset($_POST['action'])){
    $_SESSION['rating'] = $_POST['ratedIndex'];
    echo $_SESSION['rating'];
}
?>