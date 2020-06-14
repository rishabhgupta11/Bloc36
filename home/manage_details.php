<?php
    require("../includes/connect.php");
?>   

<?php
    $email = $_SESSION['email'];
    $query = "SELECT Password FROM user WHERE Email='$email'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    while($row = mysqli_fetch_array($result))
    {
        $password = $row['Password'];
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
        
        <div class="container-fluid product_page text-center">
            <div class="container-fluid cart-content" style="margin-top:10px;margin-bottom:50px;text-align:left;width:100%;">
                <a href="../home/my_account.php"> < Go Back</a>
            </div>
            <h2 style="margin-top:50px; text-decoration:underline; margin-bottom:75px;">Account Details</h2>
            <a class="my_acc_set_link" href="../home/change_name.php">
                <h6 class="my_acc_set">Change Name <b>></b> </h6>
            </a>
            <a class="my_acc_set_link" href="../home/change_contact.php">
                <h6 class="my_acc_set">Change Contact Number <b>></b> </h6>
            </a>
            <a class="my_acc_set_link" href="../home/manage_addresses.php">
                <h6 class="my_acc_set">Manage Saved Addresses <b>></b> </h6>
            </a>
            <?php
            if($password != NULL)
            {
            ?>
            <a class="my_acc_set_link" href="../home/change_password.php">
                <h6 class="my_acc_set">Change Account Password <b>></b> </h6>
            </a>
            <?php
            }
            ?>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>    

        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>  

    </body>
</html>


