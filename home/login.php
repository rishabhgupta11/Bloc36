<?php
    require("../includes/connect.php");
    include("../includes/google_signin.php");
    include("../includes/facebook_signin.php");
    include("../includes/fetch_css.php");
?>    
<html>
    <head>
        <title>BLOC36</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link href="<?php echo $cssfilename; ?>" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        include("../includes/header.php");
        ?>
        <div>
            <div id="banner-signup">
                <div class="container">
                    <div id="banner-content-signup">
                        <div id="Signup">
                            <div class="row">
                                <?php
                                if(!isset($_SESSION['email']))
                                {
                                ?>
                                <div class="col-md offset-md-1">
                                    <p class="create-acc" style="margin-bottom:20px;">LOGIN</p>
                                    <form method="post" action="../includes/server.php">
                                        <div class="form-group">
                                            <label>EMAIL</label>
                                            <input type="email"  class="form-control" name="email" id="email" required>
                                        </div>
                                        <div class="form-group form-password">
                                            <label>PASSWORD</label>
                                            <input type="password"  class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="forgot-password">
                                            <a href="#">Forgot Password</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="button1" style="vertical-align:middle" id="login_user" name="login_user"><span>SIGN IN </span></button>
                                        </div>
                                    </form>
                                    <br>
                                    <p class="create-acc" style="margin-top:20px;">OR LOGIN WITH</p>
                                    <div class="container or-login-with">
                                    <?php
                                        echo '<i>'.$login_button.'</i>';
                                        if(isset($facebook_login_url))
                                        {
                                            echo '<i>'.$facebook_login_url.'</i>';
                                        }
                                    ?>    
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md offset-md-3">
                                    <p class="create-acc" style="margin-bottom:15px;">CREATE AN ACCOUNT</p>
                                    <p>We never save credit card information.</p>
                                    <p>Registering makes checkout fast and easy.</p>
                                    <br>
                                    <form method="post" action="../includes/server.php">
                                        <div class="form-group">
                                            <label>NAME</label>
                                            <input type="text"  class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>EMAIL</label>
                                            <input type="email"  class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>PASSWORD</label>
                                            <input type="password"  class="form-control" id="password_1" name="password_1" required>
                                        </div>
                                        <div class="form-group">
                                            <label>CONFIRM PASSWORD</label>
                                            <input type="password"  class="form-control" id="password_2" name="password_2" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="button1" style="vertical-align:middle" id="reg_user" name="reg_user"><span>REGISTER </span></button>
                                        </div>
                                    </form>
                                </div>
                                <?php
                                }
                                else
                                {
                                    echo'<div class="offset-md-4 col-md-4 col-xs-12"><center><h3 style="margin:200px 0px 200px 0px;">You are already signed in!</h3></center></div>';
                                }
                                ?>
                            </div>
                        </div> 
                    </div>
                </div>   
            </div>
        </div> 
        <div id="footer">
        <?php
        include("../includes/footer.php");
        ?>
        </div>     
    </body>
</html>

