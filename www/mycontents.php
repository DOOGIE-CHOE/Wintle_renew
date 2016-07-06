<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 6/27/2016
 * Time: 8:42 PM
 */

include_once '../GlobalData.php';
include_once 'function.php';

session_start();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){

} else{
    echo "<script>alert('Please Sign in first')</script>";
    echo "<script>window.location='signin.php';</script>";
    exit;
}

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

        function isEmpty( el ){
            return $.trim(el.html());
        }

        //tag-it
        $(function() {
            //hashtag events
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
            /*$("#button").click(function(){
             if (isEmpty($("#InputTitle")) || isEmpty($("#InputContents")) || isEmpty($("#hashtags"))) {
             alert('Fill out the form');
             }else{
             alert('good');
             }
             });*/

            var request;
            $("#submitform").submit(function(event){

                //abort any request before get started
                if(request){
                    request.abort();
                }

                //get variables
                var $form = $(this);

                var $inputs = $form.find("input, textarea");

                //Serialize variables to send
                var serializedData = $form.serialize();

                //Block any inputs during working ajax
                $inputs.prop("disabled",true);

                //send ajax request
                request = $.ajax({
                    url:"uploadfunction.php",
                    type:"post",
                    data : serializedData,
                    dataType : "json",
                    success : function(data){
                        if(data.success){
                            alert("Uploaded");
                            window.location.replace("mycontents.php");
                        }else{
                            alert("Something went wrong. Sorry for inconvenience Please try it later :( ");
                        }
                    }
                });

                request.always(function () {
                    // Reenable the inputs
                    $inputs.prop("disabled", false);
                });

                // Prevent default posting of form
                event.preventDefault();
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

    <?
    $b = CreateContentID("lyrics");
    echo $b;

    ?>
</div>
<div id="popup2" class="overlay" >
    <form id="submitform">
        <div class="popup" style="height:600px; width:800px">
            <h2 style="color:white">Write your story</h2>
            <a class="close" href="#">×</a>
            <br><br>
            <div class="backboard" style="height:500px; width:780px">
                <div class="SignUp">
                    <input type="text" id="InputTitle" name="InputTitle" style="font-size: 20px; padding: 15px 15px 15px 15px; margin: 10px 10px 10px 10px" required placeholder="Title">
                    <textarea class="InputContents" id="InputContents" name="InputContents" rows="10" cols="40" required placeholder="Contents"></textarea>
                    <input name="HashTags" id="HashTags" required placeholder="Add hashtags">
                    <input type="submit" name="submit" value="Upload">
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>




