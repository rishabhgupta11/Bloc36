<?php
    require("../includes/connect.php");
    include("../includes/fetch_css.php");
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
        <title>BLOC36 | HOME</title>
    </head>
    <body>
        <?php
        include("../includes/header.php");
        ?>
        <div>
            <div id="banner-image">
                <center>
                <div class="container">
                    <div id="banner-content">
                        <h1>WORKOUT IN STYLE</h1>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <a href="../products/women.php"><button class=" button10 button105">FEATURED PRODUCTS</button></a>
                        </div>
                    </div>    
                </div>
                </center>    
            </div>
        </div>
        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>    
    </body>
</html>
