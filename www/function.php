<?php
include_once '../pls-config.php';

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 6/5/2016
 * Time: 7:46 PM
 */
class DatabaseHandler
{
    private $conn;

    function ConnectDB()
    {
        // Create connection
        $this->conn = new mysqli(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME);
        // Check connection
        if ($this->conn->connect_error) {
            // die("Connection failed: " . $conn->connect_error);
            throw new Exception ("Something went wrong.. :( Please, try it later");
        } else {
            return true;
        }
    }
    
    function DisconnectDB(){
        if(!empty($this->conn)){
            $this->conn->close();
        }
    }

    function CheckId()
    {
        //get input data from form Post style
        $email_address = $_POST["email_address"];

        $sql = "SELECT count(email_address) as emailnumber from users where email_address = '$email_address'";

        $result = $this->conn->query($sql);

        $data = $result->fetch_assoc();

        if ($data['emailnumber'] == 1) {
            return true;
        } else {
            throw new Exception("Username or password is wrong. Please, check it again");
        }

    }

    function CheckPassword()
    {
        $email_address = $_POST["email_address"];
        $password = $_POST["password"];

        $sql = "SELECT password from users where email_address = '$email_address'";

        $result = $this->conn->query($sql);

        $data = $result->fetch_assoc();

        if ($data['password'] != null) {
            $tmp = $this->GetHashCode($password, $data['password']);
            if ($tmp == $data['password']) {
                return true;
            }
        }
        throw new Exception("Username or password is wrong. Please, check it again");
    }

    function GetUsernameByEmail($email_address){

        $sql = "SELECT username from users where email_address = '$email_address'";

        $result = $this->conn->query($sql);

        $data = $result->fetch_assoc();

        if($data['username'] != null){
            return $data['username'];
        }
    }

    function VerifyUsername()
    {
        //get input data from form Post style
        $username = $_POST["username"];

        $sql = "SELECT count(username) as usernumber from users where username = '$username'";

        $result = $this->conn->query($sql);

        $data = $result->fetch_assoc();

        if ($data['usernumber'] == 0) {
            return true;
        } else {
            throw new Exception("username already exists. please use other username");
        }
    }

    function VerifyEmail()
    {
        //get input data from form Post style
        $email_address = $_POST["email_address"];


        $sql = "SELECT count(email_address) as emailnumber from users where email_address = '$email_address'";

        $result = $this->conn->query($sql);

        $data = $result->fetch_assoc();

        if ($data['emailnumber'] == 0) {
            return true;
        } else {
            throw new Exception("Email address already exists. please use other Email");
        }
    }

    function GetHashCode($password, $salt = false)
    {
        //set cost (higher number, higher security but slow processing time
        $cost = 10;

        if ($salt == false) {
            // Create a random salt
            $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

            // Prefix information about the hash so PHP knows how to verify it later.
            // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.

            $salt = sprintf("$2a$%02d$", $cost) . $salt;
        }

        // Hash the password with the salt
        $hash = crypt($password, $salt);

        return $hash;
    }

    function RegisterUser()
    {
        $username = $_POST["username"];
        $email_address = $_POST["email_address"];
        $password = $_POST["password"];

        $hash = $this->GetHashCode($password);

        $sql = "INSERT INTO users (username, email_address, password)
                VALUES ('$username', '$email_address', '$hash')";

        if ($this->conn->query($sql) === TRUE) {
            echo "<script>alert('Sign up successfully')</script>";
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            throw new Exception("Failed to sign up,.. :( Please, try it later");
        }
    }

    function isPhotoExists($email_address){

        $sql = "SELECT count(email_address) as emailnumber from profilephoto where email_address = '$email_address'";

        $result = $this->conn->query($sql);

        $data = $result->fetch_assoc();

        if ($data['emailnumber'] >= 1) {
            return true;
        } else {
            return false;
        }
    }

    function DeleteProfilePhoto($email_address){

        $sql = "SELECT image  from profilephoto where email_address = '$email_address'";

        $result = $this->conn->query($sql);

        $data = $result->fetch_assoc();

        $tmp = $data['image'];

        if(file_exists($tmp)){
            if(unlink($tmp)){
                $sql = "DELETE from profilephoto where email_address = '$email_address'";
                if($this->conn->query($sql)){
                    return true;
                }
                else
                    throw new Exception("Error occurs during deleting existing profile photo");
            }
        }
    }

    function UploadProfilePhoto($email_address, $image){
        $sql = "INSERT INTO profilephoto(email_address, image)
                VALUES ('$email_address','$image')";

        if ($this->conn->query($sql) === TRUE) {

        } else {
            throw new Exception("Failed to upload profile photo.. :( Please, try it later");
        }
    }
}

function Failed($message){
    echo "<script>alert('$message')</script>";
    exit;
}

function FailedOnSignUp($message)
{
    echo "<script>alert('$message')</script>";

    $username = $_POST["username"];
    $email_address = $_POST["email_address"];
    $password = $_POST["password"];

    //header("Location : index.php#popup1");

    echo "<script>
            document.getElementById('username').value = '$username';
            document.getElementById('email_address').value = '$email_address';
            document.getElementById('password').value ='$password';
            document.getElementById('repassword').value ='$password';
            </script>";

    exit;
}
