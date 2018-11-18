<?php
    include('captcha.php');

    $response['image'] = captcha::image();
	$response['hash'] = captcha::$hash;

    echo json_encode($response);
?>