<?php
    require("../includes/connect.php");
    include("../includes/google_signin.php");
    include("../includes/facebook_signin.php");
?>    
<html>
    <head>
        <title>BLOC36</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
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
                                    <p class="create-acc">LOGIN</p>
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
                                    <p class="create-acc">OR LOGIN WITH</p>
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
                                    <p class="create-acc">CREATE AN ACCOUNT</p>
                                    <p>We never save credit card information.</p>
                                    <p>Registering makes checkout fast and easy and saves your order information in your account.</p>
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

