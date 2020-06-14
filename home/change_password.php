<?php
    require("../includes/connect.php");
?>   

<?php
    $email = $_SESSION['email'];
    $confirm = "";
    if(isset($_REQUEST['changePassword'])) 
    {
        $query = "SELECT Password FROM user WHERE Email='$email'";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result))
        {
            $old_password = $row['Password'];
        }
        $oldPassword = mysqli_real_escape_string($con, $_REQUEST['oldPassword']);
        $newPassword = mysqli_real_escape_string($con, $_REQUEST['newPassword']);
        $confirmNewPassword = mysqli_real_escape_string($con, $_REQUEST['confirmNewPassword']);
        if($old_password==md5($oldPassword) && $newPassword==$confirmNewPassword)
        {
            $new_password = md5($newPassword);
            $query1 = "UPDATE user SET Password = '$new_password' WHERE Email='$email'";
            if(mysqli_query($con, $query1))
            {
                $confirm = "Password Changed Successfully!";
            }
            else
            {
                $confirm = "Password Change Failed!";
            }
        }
        else
        {
            if($old_password!=md5($oldPassword))
            {
                $confirm = "Old Password Incorrect";
            }
            else
            {
                if($newPassword!=$confirmNewPassword)
                {
                    $confirm = "New Passwords Don't Match";
                }
            }
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
            <h2 style="margin-top:50px; text-decoration:underline; margin-bottom:75px;">Change Password</h2>
            <form method="POST" action="">
                <label>Enter Old Password</label>
                <div class="form-group" style="display:flex; justify-content:center;">
                    <input type="password" style="width:225px;" class="form-control" id="oldPassword" name="oldPassword" required>
                </div>
                <label>Enter New Password</label>
                <div class="form-group" style="display:flex; justify-content:center;">
                    <input type="password" style="width:225px;" class="form-control" id="newPassword" name="newPassword" required>
                </div>
                <label>Confirm New Password</label>
                <div class="form-group" style="display:flex; justify-content:center;">
                    <input type="password" style="width:225px;" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                </div>
                <div class="form-group">    
                    <button type="submit" class="button10 button105" style="vertical-align:middle" id="changePassword" name="changePassword"><span>UPDATE</span></button>
                </div>
            </form>
            <?php
            if($confirm != "Password Changed Successfully!")
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
