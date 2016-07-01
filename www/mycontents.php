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
    <link rel="stylesheet" type="text/css" href="css/javascript.fullPage.css"/>
    <link rel="stylesheet" href="css/style.css">

    <!-- default theme -->
    <link href="css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">

<!--
    flick theme
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
    <link href="css/jquery.tagit.css" rel="stylesheet" type="text/css">
-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/tag-it.js" type="text/javascript" charset="utf-8"></script>

    <script>
        //tag-it
        $(function() {
            $('#HashTags').tagit({
                //evert for after putting tags
                afterTagAdded: function(evt, ui) {
                    var tags = $('#HashTags').tagit("assignedTags");
                    //check whether the first charactor is #
                    if(tags[tags.length-1].charAt(0) != '#'){

                        //put # charactor at first then replace it with without-sharp tag
                        var tagswithsharp = '#'+tags[tags.length-1];
                        $('#HashTags').tagit("removeTagByLabel",tags[tags.length-1]);
                        $("#HashTags").tagit("createTag",tagswithsharp);
                    }
            }
            });
        });
    </script>

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

$b = CreateContentID("lyrics");
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
                    <input type="text" name="InputTitle" style="font-size: 20px; padding: 15px 15px 15px 15px; margin: 10px 10px 10px 10px" required placeholder="Title">
                    <textarea class="InputContents" name="InputContents" rows="10" cols="40" required placeholder="Contents"></textarea>
                    <input name="tags" id="HashTags" value="" required placeholder="Add hashtags">
                    <input type="submit" name="submit" value="Upload">
                </div>
            </div>
        </div>
    </form>
</div>




</body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
try{
    $db = new DatabaseHandler();
    if($db->ConnectDB()){
        $contentid = CreateContentID("lyrics");
        if($db->RegisterContentID($_SESSION['email_address'],$contentid)){
            if($db->UploadLyrics($contentid, $_POST['InputTitle'] , $_POST['InputContents'] )){
                echo "<script>window.location='mycontents.php';</script>";
            }
        }
    }else{
        $db->DisconnectDB();
    }

}catch(Exception $e){
    $db->DisconnectDB();
    Failed($e->getMessage());
}

}

?>





