<?php
    require("../includes/connect.php");
    include("../includes/fetch_css.php");
?>   

<?php
    $email = $_SESSION['email'];
    $confirm = "";
    
    $query = "SELECT Address1, Address2, Address3 FROM user WHERE Email='$email'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    while($row = mysqli_fetch_array($result))
    {
        $Address1 = $row['Address1'];
        $Address2 = $row['Address2'];
        $Address3 = $row['Address3'];
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
                <a href="../home/manage_details.php"> < Go Back</a>
            </div>
            <h2 style="margin-top:50px; text-decoration:underline; margin-bottom:75px;">Manage Addresses</h2>
            
            <?php
            if($Address1 != NULL)
            {
            ?>
            <div class="container" style="text-align:left;">
                <div class="container" style="padding:10px; border: 0.5px solid #c4c1c0;background-color:#ebebeb;">
                    <h6><b>Saved Address 1</b></h6>
                    <hr>
                    <h6 style="margin:15px 0px 15px 0px;"><?php echo $Address1; ?></h6>
                    <hr>
                    <form method="POST" action="../home/edit_address_1.php" style="margin:8px 0px 0px 0px;">
                        <div class="container-fluid" style="display:flex; flex-direction:row;">
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="EDIT" name="EDIT"><span>EDIT</span></button>
                            &emsp;
                            &emsp;
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="DELETE" name="DELETE"><span>DELETE</span></button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            }
            ?>
            
            <?php
            if($Address2 != NULL)
            {
            ?>
            <br>
            <br>
            <br>
            <div class="container" style="text-align:left;">
                <div class="container" style="padding:10px; border: 0.5px solid #c4c1c0;background-color:#ebebeb;">
                    <h6><b>Saved Address 2</b></h6>
                    <hr>
                    <h6 style="margin:15px 0px 15px 0px;"><?php echo $Address2; ?></h6>
                    <hr>
                    <form method="POST" action="../home/edit_address_2.php" style="margin:8px 0px 0px 0px;">
                        <div class="container-fluid" style="display:flex; flex-direction:row;">
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="EDIT" name="EDIT"><span>EDIT</span></button>
                            &emsp;
                            &emsp;
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="DELETE" name="DELETE"><span>DELETE</span></button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            }
            ?>
            
            <?php
            if($Address3 != NULL)
            {
            ?>
            <br>
            <br>
            <br>
            <div class="container" style="text-align:left;">
                <div class="container" style="padding:10px; border: 0.5px solid #c4c1c0;background-color:#ebebeb;">
                    <h6><b>Saved Address 3</b></h6>
                    <hr>
                    <h6 style="margin:15px 0px 15px 0px;"><?php echo $Address3; ?></h6>
                    <hr>
                    <form method="POST" action="../home/edit_address_3.php" style="margin:8px 0px 0px 0px;">
                        <div class="container-fluid" style="display:flex; flex-direction:row;">
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="EDIT" name="EDIT"><span>EDIT</span></button>
                            &emsp;
                            &emsp;
                            <button type="submit" class="button10 button105" style="vertical-align:middle" id="DELETE" name="DELETE"><span>DELETE</span></button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            }
            ?>
            
            <br>
            <br>
            <br>
            <br>
            
            <?php
            if($Address1 == NULL)
            {
            ?>
            <center>
                <a href="../home/edit_address_1.php?EDIT=1" style="text-decoration:none !important;"><h6 style="font-weight:bold; text-decoration:underline;">Add an Address</h6></a>
            </center>
            <?php
            }
            else
            {
                if($Address2 == NULL)
                {
            ?>
                <center>
                    <a href="../home/edit_address_2.php?EDIT=1" style="text-decoration:none !important;"><h6 style="font-weight:bold; text-decoration:underline;">Add another Address</h6></a>
                </center>
            <?php
                }
                else
                {
                    if($Address3 == NULL)
                    {
            ?>        
                    <center>
                        <a href="../home/edit_address_3.php?EDIT=1" style="text-decoration:none !important;"><h6 style="font-weight:bold; text-decoration:underline;">Add another Address</h6></a>
                    </center>
            <?php
                    }
                }
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