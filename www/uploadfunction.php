<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 7/6/2016
 * Time: 8:00 PM
 */

session_start();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){

} else{
    exit;
}

include_once 'function.php';

$data = array();
$data['success'] = false;
$hashtags = explode(',',$_POST['HashTags']);

try{
    $db = new DatabaseHandler();
    if($db->ConnectDB()){
        $contentid = CreateContentID("lyrics");
        if($db->RegisterContentID($_SESSION['email_address'],$contentid)){
            if($db->UploadLyrics($contentid, $_POST['InputTitle'] , $_POST['InputContents'],$hashtags )){
                $data['success'] = true;
            }
        }
    }
}catch(Exception $e){
    $db->DisconnectDB();
    echo json_encode($data);
    exit;
}

echo json_encode($data);

?>