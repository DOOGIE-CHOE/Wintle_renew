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

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/javascript.fullPage.css"/>
    <link rel="stylesheet" href="css/style.css">
    <title>Wintle</title>

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
    </style>
</head>
<body>
<?php include 'header.php'?>

<video id="video" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
    <source src="./background/file.webm">
</video>
<div id="fullpage">
    <div class="section " id="section0">
       <div class="content">
            <div class="contaner">
                <img class="intro" src="img/PAGE/main_logo.png"/>
            </div>
        </div>
        <img class="paper_cap" src="img/PAGE/Cloud_paper_top.png" alt=""/>
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

<script type="text/javascript" src="js/mainpage/javascript.fullPage.js"></script>
<script type="text/javascript">
    fullpage.initialize('#fullpage', {
        anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', 'lastPage'],
        menu: '#menu',
        css3: true
    });

</script>
</body>
</html>