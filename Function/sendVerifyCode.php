<?php


function sendVerifyCode($table, $user_email)
{
    include_once '../Controller/update.php';
    include_once '../Function/SendEmail.php';
    include_once '../Controller/read.php';
    include_once '../Constant/AuthExeption.php';
    $user_verifycode = rand(10000, 99999);
    $newInfo = array(
        'user_verifycode' => $user_verifycode
    );

    $readInfo = read($table, "user_email = '$user_email'");

    if ($readInfo['STATUS'] == 'SUCCESSFUL') {
        $sendEmail = sendVerifyCodeToEmail($user_email, $user_verifycode);
        $updateInfo = update($table, $newInfo, "user_email = '$user_email'");

        return array('STATUS' => $updateInfo['STATUS'], 'SEND_EMAIL' => $sendEmail['SEND_EMAIL']);
    } else {
        return array('STATUS' => AuthExeption::NOT_FOUND_EMAIL, 'SEND_EMAIL' => AuthExeption::FAIL);
    }
}
