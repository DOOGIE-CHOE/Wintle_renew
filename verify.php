<?php

class GoogleRecaptcha
{
    /* Google recaptcha API url */
    private $google_url = "https://www.google.com/recaptcha/api/siteverify";
    private $secret = '6LcZwyATAAAAAFzPeCoBRL-ptF9gnGs-tP5-Bdik';

    public function VerifyCaptcha($response)
    {
        $url = $this->google_url."?secret=".$this->secret."&response=".$response;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $curlData = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($curlData, TRUE);
        if($res['success'] == 'true')
            return TRUE;
        else
            return FALSE;
    }

}

$message = 'Google reCaptcha';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $response = $_POST['g-recaptcha-response'];

    if(!empty($response))
    {
        $cap = new GoogleRecaptcha();
        $verified = $cap->VerifyCaptcha($response);

        if($verified) {
            $message = "Captcha Success!";
            echo 'sasd';

        } else {
            $message = "Please reenter captcha";

        }
    }
    return false;
    /*header("Location: {$_SERVER['HTTP_REFERER']}");*/
    echo 'here';
}
/*
$dbservername = "localhost";
$dbusername = "pollo112";
$dbpassword = "wintle1091!";
$dbname = "pollo112";

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//get input data from form Post style
$username = $_POST["username"];
$email_address = $_POST["email_address"];
$password = $_POST["password"];

//set cost (higher number, higher security but slow processing time
$cost = 10;

// Create a random salt
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

// Prefix information about the hash so PHP knows how to verify it later.
// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
$salt = sprintf("$2a$%02d$", $cost) . $salt;

// Hash the password with the salt
$hash = crypt($password, $salt);

$sql = "INSERT INTO users (username, email_address, password)
VALUES ('$username', '$email_address', '$hash')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();*/
?>

