<?php
include_once 'function.php';


session_start();

$top_fst_text = "Sign In";
$top_snd_text = "Sign Up";
$top_fst_link = "signin.php";
$top_snd_link = "#popup1";

if(isset($_SESSION['valid_user'])){
    $top_fst_text = $_SESSION['valid_user'];
    $top_snd_text = "Sign Out";
    $top_fst_link = "";
    $top_snd_link = "signout.php";
}

?>
<html>
<head>
    <script src='https://www.google.com/recaptcha/api.js'></script> <!-- google ReCAPTCHA include-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="javascript.fullPage.css"/>
    <link rel="stylesheet" href="css/style.css">
    <script>

        // check email based on regular expression
        function isValidEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function isValidUsername(username) {
            return /^\w+$/.test(username);
        }

        function isValidPassword(password, repassword) {
            var errors = [];
            if (password.length < 8) {
                errors.push("Your password must be at least 8 characters");
            }
            if (password.search(/[a-z]/i) < 0) {
                errors.push("Your password must contain at least one letter.");
            }
            if (password.search(/[0-9]/) < 0) {
                errors.push("Your password must contain at least one digit.");
            }
            if (password != repassword) {
                errors.push("Check your password");
            }
            if (errors.length > 0) {
                return false;
            }
            return true;
        }


        // mark red if condition doesn't match
        function mark(oj, id, tf) {
            if (tf == false) {
                document.getElementById(id).style.display = '';
                oj.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
            }
            else {
                oj.style.backgroundColor = 'rgba(0, 0, 0, 0)';
                document.getElementById(id).style.display = 'none';
            }
        }


        //sign up conditions
        function check() {
            //get all elements we need
            var username = document.getElementById("username");
            var email = document.getElementById("email_address");
            var password = document.getElementById("password");
            var repassword = document.getElementById("repassword");


            //username
            if (!isValidUsername(username.value)) {
                mark(username, 'username_wrong', false);
                return false;
            }
            else {
                mark(username, 'username_wrong', true);
            }

            //email
            if (!isValidEmail(email.value)) {
                mark(email, 'email_wrong', false);
                return false;
            }
            else {
                mark(email, 'email_wrong', true);
            }

            //password
            if (!isValidPassword(password.value, repassword.value)) {
                mark(password, 'password_wrong', false);
                mark(repassword, 'repassword_wrong', false);
                return false;
            }
            else {
                mark(password, 'password_wrong', true);
                mark(repassword, 'repassword_wrong', true);
            }


            //reCAPTCHA by google
            var response = grecaptcha.getResponse();
            if (response <= 0) {
                alert("check if you are a robot");
                return false;
            }


            return true;
        }
    </script>
    <style>
        /* ------------ popup control -----------*/
        .overlay {
            position: fixed;
            z-index: 100;
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
            height: 550px;
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

        .SignUp span[name="wrong"] {
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

<header>
    <div class="contaner">
			<span class="company">
				<a href="index.php">
					<img id="headerlogo" src="img/logo_s.png" alt="company_logo" title="홈으로 가기"/>
				</a>
			</span>
			<span class="login">
				<a href="<?php echo $top_fst_link?>" id="top_login"><?php echo $top_fst_text?></a>
				<a href="<?php echo $top_snd_link?>" id="top_signup">&nbsp;&nbsp;<?php echo $top_snd_text?></a>
			</span>
    </div>
</header>


<div id="popup1" class="overlay">
    <form action="" method="post">
        <div class="popup">
            <h2 style="color:white">Sign up for Wintle</h2>
            <a class="close" href="#">×</a>
            <br><br>
            <div class="backboard">
                <div class="SignUp">
                    <span><img src="img/username.png"></span><span name="wrong" id="username_wrong"
                                                                   style="display: none"
                                                                   onclick="document.getElementById('username').value =''"><img
                            src="img/x.png"></span><input type="text" name="username" id="username" required
                                                          placeholder="User name" autocomplete="off">

                    <span><img src="img/email.png"></span><span name="wrong" id="email_wrong" style="display: none"
                                                                onclick="document.getElementById('email_address').value =''"><img
                            src="img/x.png"></span><input type="text" name="email_address" id="email_address" required
                                                          placeholder="Your email address" autocomplete="off">

                    <span><img src="img/password.png"></span><span name="wrong" id="password_wrong"
                                                                   style="display: none"
                                                                   onclick="document.getElementById('password').value =''"><img
                            src="img/x.png"></span><input type="password" name="password" id="password" required
                                                          placeholder="Enter a password" autocomplete="off">

                    <span><img src="img/password.png"></span><span name="wrong" id="repassword_wrong"
                                                                   style="display: none"
                                                                   onclick="document.getElementById('repassword').value =''"><img
                            src="img/x.png"></span><input type="password" name="repassword" id="repassword" required
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



</html>


<?php

class Verification
{
    /* Google recaptcha API url */
    private $google_url = "https://www.google.com/recaptcha/api/siteverify";
    private $secret = '6LcZwyATAAAAAFzPeCoBRL-ptF9gnGs-tP5-Bdik';

    public function VerifyCaptcha($response)
    {
        $url = $this->google_url . "?secret=" . $this->secret . "&response=" . $response;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $curlData = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($curlData, TRUE);
        if ($res['success'] == 'true')
            return TRUE;
        else
            return FALSE;
    }


}
//starts from here when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $response = $_POST['g-recaptcha-response'];
    try {
        //check reCAPTCHA verification
        if (!empty($response)) {
            $cap = new Verification();
            $verified = $cap->VerifyCaptcha($response);

            //if reCAPTCHA is verified
            if ($verified) {
                $db = new DatabaseHandler();
                if ($db->ConnectDB()) {
                    if ($db->VerifyUsername()) {
                        if ($db->VerifyEmail()) {
                            $db->RegisterUser();
                            $db->DisconnectDB();
                            echo "<script>window.location='index.php';</script>";
                            /* 2015 06 01 by Daniel
                             * i used script at the middle of php because
                             * php header('Lcation : index.php') is not working.
                             * and i don't think it's a good idea to use script here.
                             * if someone knows why, please fix it.
                             * */
                            exit;
                        }
                    }
                }
            } else {
                throw new Exception("Our system recognized you as a robot.");
            }
        }
    } catch (Exception $e) {
        $db->DisconnectDB();
        Failed($e->getMessage());
    }
}
?>