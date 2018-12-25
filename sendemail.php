<?php
    include('helpers.php');

    $CAPTCHA_ERROR = "A reCAPTCHA lejárt vagy érvénytelen. Próbálja újra.";
    $response = [];

    try {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // captcha
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $private_key = "6LeBM4QUAAAAALcuRv1w06HmmcZlSmzsGU2M00yl";

        $captcha_response = file_get_contents(
            $url."?secret=".$private_key
                ."&response=".$_POST['g-recaptcha-response']
                ."&remoteip=".$_SERVER['REMOTE_ADDR']);

        $captcha_data = json_decode($captcha_response);

        if (!(isset($captcha_data->success) && $captcha_data->success == true)) {
            throw new Exception($CAPTCHA_ERROR);
        }

        //$to = "matyas.margareta@tm.org";
        $to = "marosvolgyi.gergely@gmail.com";
        
        $subject = $fullName." írt a weblapon keresztül";
        $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $headers .= "From: ".$email; // localhost (debug)
        //$headers .= "From: TM Mindenkinek <noreply@tmmindenkinek.nhely.hu>"; // trial
        //$headers .= "From: TM Mindenkinek <noreply@tmmindenkinek.hu>"; // live
        
        $message = get_email_from_template("emailtemplate.html", array(
            "email" => $email,
            "message" => wordwrap(nl2br($message), 70)
        ));

        mail($to, $subject, $message, $headers);

        $response['status'] = "success";
        $response['message'] = "Az e-mail küldése sikeres volt.";
        $response['captcha'] = $captcha_response;
    } catch (Exception $ex) {
        $response['status'] = "error";
        $response['message'] = "Hiba: ".$ex->getMessage();
    }

    echo json_encode($response);
?>