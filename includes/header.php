<?php
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid" id="header">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2 text-center">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link women" href="../home/index.php">HOME</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle women" href="#" id="navbardrop" data-toggle="dropdown">SHOP </a>
                <div class="dropdown-menu header-shop-menu">
                    <h3 class="shop-header">SHOP BY CATEGORY</h3>
                    <div class="row" style="width:auto; height:400px; overflow-y:auto; overflow-x:hidden;">
                        <div class="col-xs-12 col-lg-4 text-center">
                            <hr>
                            <h6 class="subheader-shop-menu">Top-Wear</h6> 
                            <hr>
                            <div class="container cat-shop-menu">
                                <a href="../home/all_sport-bras.php">
                                    <img class="img-thumbnail" src="../images/SBR1.jpeg" style=" width:70px; height:auto; display:inline;">
                                    <p style="padding-left:10px; display:inline;">Sport-Bras</p>
                                </a>
                            </div>
                            <div class="container cat-shop-menu">
                                <a href="../home/all_tank-tops.php">
                                    <img class="img-thumbnail" src="../images/TKT1.jpeg" style=" width:70px; height:auto; display:inline;">
                                    <p style="padding-left:10px; display:inline;">Tank-Tops</p>
                                </a>
                            </div>
                            <div class="container cat-shop-menu">
                                <a href="../home/all_t-shirts.php">
                                    <img class="img-thumbnail" src="../images/TSH1.jpeg" style=" width:70px; height:auto; display:inline;">
                                    <p style="padding-left:10px; display:inline;">T-Shirts</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-4 text-center">
                            <hr>
                            <h6 class="subheader-shop-menu">Bottom-Wear</h6>
                            <hr>
                            <div class="container cat-shop-menu">
                                <a href="../home/all_leggings.php">
                                    <img class="img-thumbnail" src="../images/LEG1.jpeg" style=" width:70px; height:auto; display:inline;">
                                    <p style="padding-left:10px; display:inline;">Leggings</p>
                                </a>
                            </div>
                            <div class="container cat-shop-menu">
                                <a href="../home/all_shorts.php">
                                    <img class="img-thumbnail" src="../images/SHR1.jpeg" style=" width:70px; height:auto; display:inline;">
                                    <p style="padding-left:10px; display:inline;">Shorts</p>
                                </a>
                            </div>
                            <div class="container cat-shop-menu">
                                <a href="../home/all_joggers.php">
                                    <img class="img-thumbnail" src="../images/JGR1.jpeg" style=" width:70px; height:auto; display:inline;">
                                    <p style="padding-left:10px; display:inline;">Joggers</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-4 text-center">
                            <hr>
                            <h6 class="subheader-shop-menu">Outer-Wear</h6>
                            <hr>
                            <div class="container cat-shop-menu">
                                <a href="../home/all_sweatshirts.php">
                                    <img class="img-thumbnail" src="../images/SWS1.jpeg" style=" width:70px; height:auto; display:inline;">
                                    <p style="padding-left:10px; display:inline;">Sweat-Shirts</p>
                                </a>
                            </div>
                            <div class="container cat-shop-menu">
                                <a href="../home/all_jackets.php">
                                    <img class="img-thumbnail" src="../images/JKT1.jpeg" style=" width:70px; height:auto; display:inline;">
                                    <p style="padding-left:10px; display:inline;">Jackets</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link women" href="../home/about.php">ABOUT</a>
            </li>
        </ul>
    </div>
    <div class="container-fluid order-0 mid-div" style="width: 100%; justify-content: space-between; padding-left:5px; padding-right:5px;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2" style="padding-bottom:0px;padding-top:6px;">
            <span id="navbar-burger-menu" class="material-icons" onclick="menuclosefunc()" style="color:black;font-size:37px;">menu</span>
        </button>
        <script>
            function menuclosefunc()
            {
                var x = document.getElementById("navbar-burger-menu").innerText;
                if(x == 'menu')
                {
                    document.getElementById("navbar-burger-menu").innerHTML="close";
                    document.getElementById("navbar-burger-menu").style.color="black";
                }
                else
                {
                    document.getElementById("navbar-burger-menu").innerHTML="menu";
                    document.getElementById("navbar-burger-menu").style.color="black";
                }
            }
        </script>
        <a class="navbar-brand" href="../home/index.php"><img src="../images/logo1.png" alt="BLOC36" style="width:100px;height:50px;"></a>
        <?php if (isset($_SESSION['email'])) { ?>
        <div style="display:flex;">
            <a class="cart" href="../home/cart.php" title="My Cart">
                <span class="material-icons" style="padding-top:8px;">shopping_cart</span>
            </a>
            <a class="cart" href="../home/cart.php" title="My Cart">
                <p style="font-size:12px;margin-bottom:0px;"><?php echo $_SESSION['total'] ?></p>
            </a>
        </div>
        <?php } else { ?>
            <a class="cart" href="../home/login.php" title="Login/Signup"><span class="material-icons" style="padding-top:9px;">person</span></a>
        <?php } ?>    
    </div>
    <div class="navbar-collapse collapse w-10 order-3 dual-collapse2">
        <ul class="navbar-nav flex-row ml-md-auto d-md-flex" style="justify-content: space-around;">
            <?php if (isset($_SESSION['email'])) { ?> 
            <li class="nav-item">
                <a class="nav-link" href="../home/my_account.php" title="My Account"><span class="material-icons">account_circle</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../home/logout.php" title="Logout"><img src="../images/signout2.png" style="width:24px; height:20px;"></a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>