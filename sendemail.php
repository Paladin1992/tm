<?php
    include('helpers.php');
    include('captcha.php');

    $ERROR_CAPTCHA_NO_MATCH = 'A beírt összeg helytelen. Ha nem tudja elolvasni, a gombra kattintva kérjen új képet.';
    $response = [];

    try {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $userInput = $_POST['captcha'];
        $hash = $_POST['hash'];

        $token = captcha::map($hash[2]).captcha::map($hash[4]).captcha::map($hash[8]).captcha::map($hash[16]);
        $sum = captcha::calculate_sum($token);

        if ($userInput != $sum) {
            throw new Exception($ERROR_CAPTCHA_NO_MATCH);
        }

        $message = get_email_from_template('emailtemplate.html', array(
            'email' => $email,
            'message' => wordwrap(nl2br($message), 80)
        ));

        //$to = 'matyas.margareta@tm.org';
        $to = 'marosvolgyi.gergely@gmail.com';
        $subject = $fullName.' írt a weblapon keresztül';
        $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';

        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $headers .= "From: ".$email;
	//$headers .= "From: TM Mindenkinek <noreply@tmmindenkinek.nhely.hu>"
        
        mail($to, $subject, $message, $headers);

        $response['status'] = 'success';
        $response['message'] = 'Az e-mail küldése sikeres volt.';
    } catch (Exception $ex) {
        $response['status'] = 'error';
        $response['message'] = 'Hiba: '.$ex->getMessage();
    }

    echo json_encode($response);
?>