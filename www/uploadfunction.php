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

try{
    $db = new DatabaseHandler();
    if($db->ConnectDB()){
        $contentid = CreateContentID("lyrics");
        $result = $db->UploadLyrics($_SESSION['email_address'], $contentid,$_POST['InputTitle'] ,$_POST['InputContents'] , $_POST['HashTags']);
        if($result == 0){
            $data['success'] = true;
        }
        else{
            $data['success'] = false;
        }
    }
}catch(Exception $e){
    exit;
}finally{
    $db->DisconnectDB();
    echo json_encode($data);
}

?>