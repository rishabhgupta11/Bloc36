<?php
    require("../includes/connect.php");
?>   

<?php
    $email = $_SESSION['email'];
    $confirm = "";
    if(isset($_REQUEST['changeContact'])) 
    {
        $code='+91';
        $contact = mysqli_real_escape_string($con, $_REQUEST['contact']);
        $email = $_SESSION['email'];
        $full_contact = $code.$contact;
        $query = "UPDATE user SET Contact = '$full_contact' WHERE Email='$email'";
        $query1 = "UPDATE user_products SET Contact = '$full_contact' WHERE Email='$email'";
  	mysqli_query($con, $query1);
        if(mysqli_query($con, $query))
        {
            $confirm = "Contact Number Changed Successfully!";
        }
        else
        {
            $confirm = "Contact Number Change Failed!";
        }
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
                <a href="../home/manage_details.php"> < Go Back</a>
            </div>
            <h2 style="margin-top:50px; text-decoration:underline; margin-bottom:75px;">Change Contact Number</h2>
            <form method="POST" action="">
                <div class="form-group" style="display:flex; justify-content:center;">
                    <input type="text" value="+91" class="form-control" style="width:55px; margin-right:0;" readonly>
                    &nbsp;
                    <input type="tel" minlength="8" maxlength="10" style="width:175px;" class="form-control" name="contact" id="contact" placeholder="Enter 10-Digit Number" required>
                </div>
                <div class="form-group">    
                    <button type="submit" class="button10 button105" style="vertical-align:middle" id="changeContact" name="changeContact"><span>UPDATE</span></button>
                </div>
            </form>
            <?php
            if($confirm != "Contact Number Changed Successfully!")
            {
                echo "<p style='font-size:14px;color:red;'><b>$confirm</b></p>"; 
            }
            else
            {
                echo "<p style='font-size:14px;color:blue;'><b>$confirm</b></p>"; 
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
