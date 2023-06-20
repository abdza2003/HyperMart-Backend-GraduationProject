<?php
include '../Function/requestInfo.php';
include '../Constant/AuthExeption.php';
include '../Controller/insert.php';
include '../Controller/read.php';
include '../Function/SendEmail.php';
header('Content-type: application/json',    'Accept:application/json',);




$user_name = requestInfo('user_name');
$user_email = requestInfo('user_email');
$user_password = requestInfo('user_password');
$user_verifycode = rand(10000, 99999);

define('table', 'users');

$userInfo = array(
    'user_name' => $user_name,
    'user_email' => $user_email,
    'user_password' => $user_password,
    'user_verifycode' => $user_verifycode,
    
);
$readEmail = read(table, where: "user_email = '$user_email'");

if (empty($user_email) || empty($user_password) || empty($user_name)) {

    echo json_encode(array('STATUS' => AuthExeption::INVALID_INPUT));
} else if (!strstr($user_email, '@gmail.com')) {

    echo json_encode(array('STATUS' => AuthExeption::INVALID_EMAIL));
} else if (strlen($user_password) < 6) {

    echo json_encode(array('STATUS' => AuthExeption::WEAK_PASSWORD));
} else if ($readEmail['STATUS'] == 'SUCCESSFUL') {

    echo json_encode(array('STATUS' => AuthExeption::EMAIL_EXISTS));
} else if ($readEmail['STATUS'] == 'FAIL') {


    $newUser = insert(table, $userInfo);
    $sendEmail = sendVerifyCodeToEmail($user_email, $user_verifycode);

    echo json_encode(array('STATUS' => $newUser['STATUS'], 'SEND_EMAIL' => $sendEmail['SEND_EMAIL']));


}




