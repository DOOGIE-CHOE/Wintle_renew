<?php
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
    <link rel="stylesheet" type="text/css" href="javascript.fullPage.css"/>
    <link rel="stylesheet" href="css/style.css">

    <script>
        function hash(){
            var textarea = document.getElementById("displayhash");
            var submithash = document.getElementById("submithash");

            <?php
            $string = " ";

            foreach($_SESSION['hash'] as $item=>$value){
                $string .= $value;
            }

            ?>
            if(submithash.value == "Add"){
                textarea.style.display = '';
                textarea.value = '<?php  echo $string;?>';
                alert('<?php echo $string ?>');
                submithash.value = "Submit";
            }
            else if(submithash.value == "Submit"){
                textarea.style.display = 'none';
                submithash.value = "Add";
            }
        }

    </script>

    <style>
        #section {
            float: left;
            width:80%;
            padding:10px;
        }
        #section .table{
            margin: 50px auto;
            width: 80%;
            border: 3px solid #73AD21;
            padding: 10px;
        }
        .Row
        {
            display: table-row;
        }
        .Cell
        {
            display: table-cell;
            border: solid;
            border-width: thin;
            padding-left: 5px;
            padding-right: 5px;
        }
        /* hide input file button*/
        .image-upload > input
        {
            display: none;
        }
    </style>

</head>
<?php include_once 'header.php'?>
<?php include_once 'leftsidebar.php'?>

<body>


<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $permitted = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $folder = "ProfileImages/";

    $count = 0;
    //get extension
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    foreach($permitted as $extension){
        if($extension == $ext)
            $count++;
    }

    if($count != 1){
        echo "<script>alert('You can only upload image file.')</script>";
        echo "<script>window.location='mypage.php';</script>";
        exit;
    }

    //get random number and date
    $time = getdate();
    $ran = rand(1000,9999);

    /* $base = new Imagick('original.jpg');
     $mask = new Imagick('mask.png');

     $base->compositeImage($mask, Imagick::COMPOSITE_COPYOPACITY, 0, 0);
     $base->writeImage('result.png');*/

    $refilename = $time['year'].$time['mon'].$time['mday'].$time['hours'].$time['minutes'].$time['seconds'].$ran.'.'.$ext;
    $filepath = $folder.$refilename;

    try{
        $db = new DatabaseHandler();
        if($db->ConnectDB()){
            //if the photo's existing, delete it
            if($db->isPhotoExists($_SESSION['email_address'])){
                $db->DeleteProfilePhoto($_SESSION['email_address']);
            }
            //file upload
            move_uploaded_file($file_tmp, $filepath);
            $db->UploadProfilePhoto($_SESSION['email_address'], $filepath);
            $db->DisconnectDB();
        }
    }catch(Exception $e){
        $db->DisconnectDB();
        Failed($e->getMessage());
    }
}
?>

<div id="section">
    <div class="table">
        <div class="Row">
            <div class="Cell">
                <form action = "" method = "POST" enctype="multipart/form-data">
                    <div class="image-upload">
                        <label for="file-input">
                            <?php
                            $path =  "img/defaultprofile.png"; //set default image
                            try{
                                $db = new DatabaseHandler();
                                if($db->ConnectDB()){
                                    if($db->isPhotoExists($_SESSION['email_address'])){
                                        //if profile photo's found, set path as it's
                                        $path = $db->GetProfilePhoto($_SESSION['email_address']);
                                    }
                                }
                                $db->DisconnectDB();
                            }catch(Exception $e){
                                $db->DisconnectDB();
                                Failed($e->getMessage());
                            }
                            //display it
                            echo "<img src='$path'/>";
                            ?>
                        </label>
                        <input id="file-input" type="file"  name="image"  onchange="this.form.submit()"/>
                    </div>
                </form>
            </div>
            <div class="Cell">
                <?php
                $username = $_SESSION['valid_user'];
                echo $username;

                try{
                    $db = new DatabaseHandler();
                    if($db->ConnectDB()){
                        $list = $db->GetHashTags($_SESSION['email_address']);
                        $_SESSION['hash'] = $list;
                        foreach($list as $hash){
                            echo $hash;
                            echo "&nbsp;";
                        }
                    }
                    $db->DisconnectDB();
                }catch(Exception $e){
                    $db->DisconnectDB();
                }
                ?>
                <textarea id="displayhash" rows="5" cols="40" style="display: none"></textarea>
                <input type="button" id="submithash" value="Add" onclick="hash()">

            </div>
        </div>
    </div>
</div>

</body>

</html>