<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 6/5/2016
 * Time: 10:40 PM
 */

session_start();

$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
session_destroy();

if(!empty($old_user)){
    echo '<script>alert("Logged out")</script>';
    echo "<script>window.location='index.php'</script>";
}else{
    echo '<script>alert("Wrong access !!")</script>';
    echo "<script>window.location='index.php'</script>";
}
?>