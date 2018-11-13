<?php
    $ERROR_CAPTCHA_NO_MATCH = 'A kód nem egyezik.';
    $response = [];

    try {        
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $clientCaptcha = $_POST['captcha'];

        if (isset($_SESSION['__captcha__'])){ //&& strtolower($_SESSION['__captcha__']) != strtolower($clientCaptcha)) {
            throw new Exception($ERROR_CAPTCHA_NO_MATCH);
        }

        $message =
            '<b>E-mail cím:</b> '.$email.'<br><br>'.
            '<b>Üzenet:</b><br>'.wordwrap($message, 80);

        //$to = 'matyas.margareta@tm.org';
        $to = 'marosvolgyi.gergely@gmail.com';
        $subject = $fullName.' írt a weblapon keresztül';

        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $headers .= "From: ".$email;
        
        //mail($to, $subject, $message, $headers);

        $response['status'] = 'success';
        $response['message'] = 'Az e-mail küldése sikeres volt.';
    } catch (Exception $ex) {
        $response['status'] = 'error';
        $response['message'] = 'Az e-mail küldése közben hiba történt. Hibaüzenet: '.$ex->getMessage();
    }

    echo json_encode($response);
?>