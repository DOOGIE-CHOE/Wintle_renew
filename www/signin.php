<?php
include_once 'function.php';
session_start();

if(isset($_SESSION['valid_user'])){
    echo '<script> alert("Wrong access !!")</script>';
    echo "<script>window.location='intro.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sign In for Wintle</title>
    <link rel="stylesheet" href="css/style.css">

    <style>

        body{
            background-color:lightskyblue;
        }
        .main{
            margin: auto;
            margin-top:100px;
            width:500px;
            border: none;
            padding: 10px;
        }

        div{
            display: block;
            margin-left: auto;
            margin-right: auto;
            text-align:center;
        }
        .header img{
            width:80px;
            height:80px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .SignUp input {
            border: none;
            height: 48px;
            outline: none;
            margin-top:10px;
        }


        .SignUp span img{
            display: block;
            height: 30px;
            width: 30px;
            position: absolute;
            text-align: center;
            margin-top:20px;
            margin-left: 34px;
        }

        .SignUp input[type="text"],
        .SignUp input[type="password"]
        {
            background-color: #fff;
            border-top: 2px solid #2c90c6;
            border-right: 1px solid #000;
            border-left: 1px solid #000;
            border-bottom: 2px solid #2c90c6;
            border-radius: 5px 5px 5px 5px;
            -moz-border-radius: 5px 5px 5px 5px;
            -webkit-border-radius: 5px 5px 5px 5px;
            -o-border-radius: 5px 5px 5px 5px;
            -ms-border-radius: 5px 5px 5px 5px;
            color: #363636;
            padding-left: 40px;
            width:300px;
        }


        .SignUp input[type="submit"] {
            background-color: #2c90c6;
            border: 1px solid #2c90c6;
            border-radius: 15px;
            -moz-border-radius: 15px;
            -webkit-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            color: #fff;
            font-weight: bold;
            line-height: 48px;
            text-align: center;
            text-transform: uppercase;
            width: 340px;
        }

        #sigInTitle{
            margin-top: 10px;
            margin-bottom:10px;
            align:center;
            font-size:20px;
            font-weight: bold;
            color:white;
        }

        .divider {
            width:100%;
            text-align:center;
            margin-top:20px;
        }

        .divider hr {
            margin-left:auto;
            margin-right:auto;
            width:40%;

        }

        .left {
            float:left;
        }

        .right {
            float:right;
        }

        .backboard{
            padding-top: 20px;
            padding-bottom: 20px;
            width:400px;
            background-color: whitesmoke;
            border: 1px solid #2c90c6;
            border-radius: 15px;
            -moz-border-radius: 15px;
            -webkit-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
        }

        .otherSignIn img{
            width:300px;
        }

    </style>

    <script>
        function isValidEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function check(){
            var email = document.getElementById("email_address");
            if(!isValidEmail(email.value)){
                alert("Check your email address");
                return false;
            }

            return true;
        }

    </script>
</head>
<body>

<form action="" method = "post">
<div class="main">
    <div class="header">
        <a href="intro.php"><img src="img/small_logo_black.png"></a>
    </div>
    <div>
        <p id="sigInTitle"> Sign In for Wintle </p>
    </div>
    <div class="backboard">
        <div class="SignUp">
            <span><img src="img/email.png"></span><input type="text" name="email_address" id="email_address" required placeholder="Email address" autocomplete="off">

            <span><img src="img/password.png"></span><input type="password" name="password" id="password" required placeholder="Create a password" autocomplete="off">

            <input type="submit" name="submit" value="Sign In" title="Sign In">
        </div>
        <div class="divider">
            <hr class="left"/>OR<hr class="right" />
        </div>
        <div class="otherSignIn">
            <img src="img/g_signin.png">
        </div>
    </div>
</div>

</form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new DatabaseHandler();
    try {
        if ($db->ConnectDB()) {
            if($db->CheckId()){
                if($db->CheckPassword()){
                    $_SESSION['valid_user'] = $db->GetUsernameByEmail($_POST['email_address']);
                    $db->DisconnectDB();
                    echo "<script>alert('Signed in successfully')</script>";
                    echo "<script>window.location='intro.php'</script>";
                    /* 2015 06 05 by Daniel
                     * i used script at the middle of php because
                     * php header('Lcation : intro.php') is not working.
                     * and i don't think it's a good idea to use script here.
                     * if someone knows why, please fix it.
                     * */
                    exit;
                }
            }
        }
        $db->DisconnectDB();
        exit;
    } catch(Exception $e){
        Failed($e->getMessage());
    }
}
?>



