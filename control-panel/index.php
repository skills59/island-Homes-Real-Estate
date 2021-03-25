<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$email=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
<!DOCTYPE html>
<html lang="en-us" >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>iSland Homes :: Buy, Sell or Rent a Property at a Click!</title>
        <link rel="apple-touch-icon" href="../assets/images/favicon.ico">
        <link media="all" rel="stylesheet" href="assets/css/style.css">
        <link media="all" rel="stylesheet" href="assets/css/bubu.css">
    </head>

    <body class="direction-ltr page-user-login">   
        <div id="wrapper" class="">
            <main id="main" class="full-height">
                <div class="cpanel-login-v3 flex justify-center full-height">
                    <div class="cpanel-login-v3__right full-width">
                        <div id="signup-signin-v3-right-holder" class="hidden">
                            <div class="wrapper">
                                <ul class="bg-bubbles shadow">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        <div class="cpanel-login-v3__left flex justify-center">
                            <div class="cpanel-login-v3-left__content">
                                <br><br>
                                <a href="../search">
                                <img src="../assets/images/logo512.png" alt="logo" style="height:150px;" />
                                <a>
                                <br><br>
                                <h1 class="title-cover-9">🅸🆂🅻🅰🅽🅳 🅷🅾🅼🅴🆂</h1>
                                <div class="flex flex-column justify-content-center">
                                    <div class="log-in-form-v3__left">

                                        <form method="post">
                                            <div class="log-in-form-v3-left__inputs">
                                                <div class="flex flex-column mb-15">
                                                    <input type="text" name="username" class="faq-section__search label-v3 full-width">
                                                </div>
                                                <div class="flex flex-column mb-15">
                                                    <input type="password" name="password" class="faq-section__search label-v3 full-width">
                                                </div>
                                            </div>
                                            <button name="login" type="submit" class="button bg-success full-width">Log In</button>
                                        </form>
                                    </div>
                                </div> 
                            </div>
                        </div>
                </div>
            </main>
        </div>
        <script src="assets/js/main.js" async defer></script>
    </body>
</html>
