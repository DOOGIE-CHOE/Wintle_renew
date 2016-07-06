<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 7/5/2016
 * Time: 1:11 AM
 */

$form_data = array();

$a = $_POST['InputTitle'];
if($a == "title"){
    $form_data['success'] = true;
}
else{
    $form_data['success'] = false;
}

echo json_encode($form_data);

?>