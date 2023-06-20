<?php

include '../Function/requestInfo.php';
include '../Function/sendVerifyCode.php';
$user_email = requestInfo('user_email');
define('table', 'users');

if (!empty($user_email)) {
    $sendNewVerifyCode = sendVerifyCode(table, $user_email);
    echo json_encode($sendNewVerifyCode);
} else {
include '../Constant/AuthExeption.php';

    echo json_encode(array('STATUS' => AuthExeption::INVALID_INPUT));
}
