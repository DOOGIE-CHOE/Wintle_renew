<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 6/13/2016
 * Time: 1:44 PM
 */
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/javascript.fullPage.css"/>
    <link rel="stylesheet" href="css/style.css">

    <style>

        a:link { color: white; text-decoration: none;}
        a:visited { color: white; text-decoration: none;}
        a:hover { color: white; text-decoration: underline;}

        html, body{
            height:100%;
            margin:0;
            padding:0;
        }
        .alignleft{
            float:left;
            height:100%;
            width:200px;
            list-style :none;
            margin: 0;
            padding : 100px 0 0 0;
            background :black;
        }
        ul li{
            padding : 25px 25px 25px 25px;
        }
        ul li img{
            width:100px;
            height:100px;
        }

        ul li:hover{
            background :white;
        }
    </style>
</head>

<body>
<ul class="alignleft">
    <li><a href="mypage.php">Profile</a></li>
    <li><a href="mycontents.php">Contents</a></li>
    <li><a href="#">Projects</a></li>
    <li><a href="#">Incomes</a></li>
</ul>

</body>
</html>
