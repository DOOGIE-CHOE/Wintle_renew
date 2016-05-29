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
</head>
<body>
<!--<div>
    <iframe src="header.html" width="100%" frameBorder="0" scrolling="no" onload="resizeIframe(this)"></iframe>
</div>-->
<div class="main">
    <div class="header">
        <a href="intro.php"><img src="img/logo_black.png"></a>
    </div>
    <div>
        <p id="sigInTitle"> Sign In for Wintle </p>
    </div>
    <div class="backboard">
        <div class="SignUp">
            <span><img src="img/email.png"></span><input type="text" name="email" id="email" required placeholder="Email address" autocomplete="off">

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
</body>
</html>