<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 6/27/2016
 * Time: 8:42 PM
 */


include_once 'function.php';

/*session_start();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){

} else{
    echo "<script>alert('Please Sign in first')</script>";
    echo "<script>window.location='signin.php';</script>";
    exit;
}*/

?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="javascript.fullPage.css"/>
    <link rel="stylesheet" href="css/style.css">

    <style>

        .InputContents {
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
            padding: 15px 15px 15px 15px;
            margin: 10px 10px 10px 10px;
            width: 700px;
            font-size:20px;
        }
    </style>
</head>

<?php include_once 'header.php'?>
<?php include_once 'leftsidebar.php'?>
<?php include_once 'rightsidebar.php'?>
<body>


<div>
    </br>
    </br>
    </br>

    <a href="#popup2"><button>Click me</button></a>

<?php

$b = GetContentID("lyrics");
echo $b;
?>
</div>
<div id="popup2" class="overlay" >
    <form action="" method="post">
        <div class="popup" style="height:600px; width:800px">
            <h2 style="color:white">Write your story</h2>
            <a class="close" href="#">×</a>
            <br><br>
            <div class="backboard" style="height:500px; width:780px">
                <div class="SignUp">
                    <input type="text" id="InputTitle" style="font-size: 20px; padding: 15px 15px 15px 15px; margin: 10px 10px 10px 10px" required placeholder="Title">
                    <textarea class="InputContents" id="InputContents" rows="10" cols="40" required placeholder="Contents"></textarea>
                    <input type="text" id="InputHash" style=" width : 600px; font-size: 20px; padding: 15px 15px 15px 15px; margin: 10px 10px 10px 10px" required placeholder="Add HashTags">
                    <input type="submit" name="submit" value="Upload" onclick="return check()">
                </div>
            </div>
        </div>
    </form>
</div>




</body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {




}

?>





