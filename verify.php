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
        } else {
            $message = "Please reenter captcha";
        }
    }
}
echo "alert (". $message.")";

?>