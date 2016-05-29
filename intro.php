<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src='https://www.google.com/recaptcha/api.js'></script> <!-- google ReCAPTCHA include-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>wintle</title>
    <!--	<meta name="author" content="Alvaro Trigo Lopez" />
        <meta name="description" content="fullPage plugin by Alvaro Trigo. Pure javascript version of full screen slider." />
        <meta name="keywords"  content="fullpage,jquery,alvaro,trigo,plugin,fullscren,screen,full,iphone5,apple,pure,javascript,slider,hijacking" />
        <meta name="Resource-type" content="Document" />-->
    <!--	<link rel="shortcut icon" href="img/pavicon/logo.ico" charset="utf-8">
    -->
    <link rel="stylesheet" type="text/css" href="javascript.fullPage.css"/>
    <link rel="stylesheet" href="css/style.css">
    <script>

        // check email based on standard expression
        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }


        function check() {
            var email = document.getElementById("email_address");
            if (!validateEmail(email.value)) {
                document.getElementById("email_wrong").style.display = '';
               /* email.style.borderTop = '2px solid #ff0000';
                email.style.borderBottom = '2px solid #ff0000';
                email.style.borderRight = ' border-right: 1px solid #ff0000';
                email.style.borderLeft = ' border-right: 1px solid #ff0000';*/
                email.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';

                return false;
            }
            else{
                document.getElementById("email_wrong").style.display = 'none';
            }


            return false;
            return true;
        }
    </script>

    <style>
        /* background video
         * --------------------------------------- */
        #video {
            position: fixed;
            top: 0px;
            left: 0px;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            overflow: hidden;
        }

        /* Section 1
         * --------------------------------------- */
        .intro {
            position: absolute;
            margin: auto;
            padding-bottom: 50px;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 25%;
            height: auto;
            z-index: -1;
        }

        .paper_cap {
            position: absolute;
            bottom: 0;
            float: left;
            width: 100%;
        }

        #section0 {
            background: none;
        }

        #section0 h1 {
            color: #444;
        }

        #section0 p {
            color: #333;
            opacity: 0.4;
        }

        /* Section 2
         * --------------------------------------- */
        #section1 {
            background-color: rgb(255, 255, 255);
        }

        #section1 h1 {
            color: #fff;
        }

        #section1 p {
            opacity: 0.8;
        }

        /* Section 3
         * --------------------------------------- */
        #section2 {
            background-color: #2C3E50;
        }

        #section2 h1 {
            color: #F2F2F2;
        }

        #section2 p {
            opacity: 0.6;
        }

        /* popup control*/
        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }

        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: auto;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 20px;
            background: lightskyblue;
            border-radius: 5px;
            height: 600px;
            width: 360px;
            position: absolute;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }

        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .close:hover {
            color: orange;
        }

        .popup .content {
            max-height: 500px;
            overflow: auto;
        }

        /*------------ signup part ------------*/

        .SignUp input {
            border: none;
            height: 48px;
            outline: none;
            margin-top: 10px;
        }

        .SignUp span img {
            display: block;
            height: 30px;
            width: 30px;
            position: absolute;
            text-align: center;
            margin-top: 20px;
            margin-left: 6px;
        }

        .SignUp span[name="wrong"]{
            display: block;
            height: 30px;
            width: 30px;
            position: absolute;
            text-align: center;
            margin-left: 300px;
        }

        .SignUp input[type="text"],
        .SignUp input[type="password"] {
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
            width: 300px;
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

        .SignUpText {
            color: black;
            text-align: center;
            margin-top: 10px;
            font-size: 15px;
        }

        .backboard {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-right: 3px;
            width: 350px;
            background-color: whitesmoke;
            border: 1px solid #2c90c6;
            border-radius: 15px;
            -moz-border-radius: 15px;
            -webkit-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
        }

        .g-recaptcha {
            margin: 7px 0 7px 25px;
        }

    </style>
</head>
<body>

<header>
    <div class="contaner">
			<span class="company">
				<a href="intro.php">
					<img id="headerlogo" src="img/logo_s.png" alt="company_logo" title="홈으로 가기"/>
				</a>
			</span>
			<span class="login">
				<a href="signin.php">로그인</a>
				<a href="#popup1">&nbsp;&nbsp;회원가입</a>
			</span>
    </div>
</header>


<video id="video" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
    <source src="./background/file.webm">
</video>
<div id="fullpage">
    <div class="section " id="section0">
        <div class="content">
            <div class="contaner">
                <img class="intro" src="./PAGE/main_logo.png"/>
            </div>
        </div>
        <img class="paper_cap" src="./PAGE/Cloud_paper_top.png" alt=""/>
    </div>
    <div class="section" id="section1">
        <div class="slide" id="slide1">
            <div class="content">
                <h1>No need for jQuery</h1>
                <p>
                    5 Kb gzipped!!
                </p>
                <p>
                    Improve the loading time of your site!
                </p>
            </div>
        </div>
        <div class="slide" id="slide2">
            <div class="content">
                <h1>Slides too!</h1>
            </div>
        </div>
        <div class="slide" id="slide2">
            <div class="content">
                <h1>More slides!</h1>
            </div>
        </div>
    </div>
    <div class="section" id="section2">
        <div class="content">
            <h1>Compatible</h1>
            <p>IE 8+ support.</p>
        </div>
    </div>
</div>

<script type="text/javascript" src="javascript.fullPage.js"></script>
<script type="text/javascript">
    fullpage.initialize('#fullpage', {
        anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', 'lastPage'],
        menu: '#menu',
        css3: true
    });

</script>


<div id="popup1" class="overlay">
    <form action="" method="post">
        <div class="popup">
            <h2 style="color:white">Sign up for Wintle</h2>
            <a class="close" href="#">×</a>
            <br><br>
            <div class="backboard">
                <div class="SignUp">
                    <span><img src="img/username.png"></span><span  name="wrong" id="username_wrong" style="display: none"><img src="img/x.png"></span><input type="text" id="username" required
                                                                    placeholder="User name" autocomplete="off">

                    <span><img src="img/email.png"></span><span name="wrong" id="email_wrong" style="display: none"><img src="img/x.png"></span><input type="text" id="email_address" required
                                                                 placeholder="Your email address" autocomplete="off">

                    <span><img src="img/password.png"></span><span  name="wrong" id="password_wrong" style="display: none"><img src="img/x.png"></span><input type="password" id="password" required
                                                                    placeholder="Enter a password" autocomplete="off">

                    <span><img src="img/password.png"></span><span  name="wrong" id="password_wrong" style="display: none"><img src="img/x.png"></span><input type="password" id="repassword" required
                                                                    placeholder="Re-enter a password"
                                                                    autocomplete="off">

                    <p class="SignUpText">Use at least one letter<br> one numeral, and seven characters.</p>

                    <div class="g-recaptcha" data-sitekey="6LcZwyATAAAAACFru_oAaZX_UCjGySRbcPFiN9Ye"></div>

                    <input type="submit" name="submit" value="Sign Up for Wintle" onclick="return check()">
                </div>
            </div>
        </div>
    </form>
</div>


</body>
</html>
