<?php
    require("../includes/connect.php");
    include("../includes/fetch_css.php");
?>   

<?php
    $email = $_SESSION['email'];
    
    if(isset($_REQUEST['DELETE']))
    {
        $query = "UPDATE user SET Address3='', PinCode3='' WHERE Email='$email'";
        mysqli_query($con, $query);
        header('location: ../home/manage_addresses.php');
    }
    
    if(isset($_REQUEST['updateAddress']))
    {
        $address1 = mysqli_real_escape_string($con, $_REQUEST['address11']);
        $address2 = mysqli_real_escape_string($con, $_REQUEST['address12']);
        $address3 = mysqli_real_escape_string($con, $_REQUEST['address13']);
        $address4 = mysqli_real_escape_string($con, $_REQUEST['address14']);
        $address5 = mysqli_real_escape_string($con, $_REQUEST['address15']);
        $address6 = mysqli_real_escape_string($con, $_REQUEST['address16']);
        $commaspace = ', ';
        $email = $_SESSION['email'];
        $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
        $result = mysqli_query($con, $user_check_query);
        $userCount = mysqli_num_rows($result);

        if ($userCount > 0) 
        {
            $query = "UPDATE user SET Address3 = '$address1"
                    . "$commaspace"
                    . "$address2"
                    . "$commaspace"
                    . "$address3"
                    . "$commaspace"
                    . "$address4"
                    . "$commaspace"
                    . "$address5"
                    . "$commaspace"
                    . "$address6', PinCode3='$address6' WHERE Email='$email'";
            mysqli_query($con, $query);
            header('location: ../home/manage_addresses.php');
        }
    }
    $query = "SELECT Address3 FROM user WHERE Email='$email'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    while($row = mysqli_fetch_array($result))
    {
        $Address1 = $row['Address3'];
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link href="<?php echo $cssfilename; ?>" rel="stylesheet" type="text/css">
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
                <a href="../home/manage_addresses.php"> < Go Back</a>
            </div>
            <?php
            if(isset($_REQUEST['EDIT']))
            {
            ?>
            <h2 style="margin-top:50px; text-decoration:underline; margin-bottom:75px;">Update Address</h2>
            
            <form style="width:30%; display:inline-block; text-align:center;" method="post" action="">
                <div class="form-group">
                    <label>House No./Building</label>
                    <input type="text" maxlength="900" class="form-control" name="address11" id="address11" required>
                    <br>
                    <label>Street Address</label>
                    <input type="text" maxlength="900" class="form-control" name="address12" id="address12" required>
                    <br>
                    <label>Landmark</label>
                    <input type="text" maxlength="200" class="form-control" name="address13" id="address13" required>
                    <br>
                    <label>City</label>
                    <input type="text" maxlength="900" class="form-control" name="address14" id="address14" required>
                    <br>
                    <label>State</label>
                    <input type="text" maxlength="900" class="form-control" name="address15" id="address15" required>
                    <br>
                    <label>PIN Code</label>
                    <input type="text" maxlength="6" class="form-control" name="address16" id="address16" required>
                    <br>
                    <button type="submit" class="button10 button105" style="vertical-align:middle" id="updateAddress" name="updateAddress"><span>SAVE</span></button>
                </div>
            </form>
            <?php
            }
            else
            {
            ?>
            <br>
            <br>
            <br>
            <br>
            <center><h5>Invalid Request</h5></center>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <?php
            }
            ?>
        </div>    

        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>  

    </body>
</html>