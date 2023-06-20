<?php
include '../Function/requestInfo.php';
include '../Function/sendVerifyCode.php';
include '../Constant/AuthExeption.php';
include '../Controller/read.php';
header('Content-type: application/json',    'Accept:application/json',);

$user_email = requestInfo('user_email');
$user_password = requestInfo('user_password');
define('table', 'users');

$readEmail = read(table, where: "user_email = '$user_email'");

if (empty($user_email) || empty($user_password)) {

    echo json_encode(array('STATUS' => AuthExeption::INVALID_INPUT));
} else if (!strstr($user_email, '@gmail.com')) {

    echo json_encode(array('STATUS' => AuthExeption::INVALID_EMAIL));
} else if ($readEmail['STATUS'] == 'SUCCESSFUL') {

    $readInfo = read(table, where: "user_email = '$user_email' AND user_password = '$user_password'");

    if ($readInfo['STATUS'] == 'SUCCESSFUL') {
        if($readInfo['INFO']['user_approve'] == 0){
            sendVerifyCode(table, $user_email);
            echo json_encode(array('STATUS' => 'SEND_VERIFYCODE'));
        }else{

            echo  json_encode($readInfo, JSON_PRETTY_PRINT);
        }
    } else {

        echo json_encode(array('STATUS' => AuthExeption::INVALID_PASSWORD));
    }
} else {

    echo json_encode(array('STATUS' => AuthExeption::NOT_FOUND_EMAIL));
}
