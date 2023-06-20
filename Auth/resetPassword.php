<?php
include '../Function/requestInfo.php';
include '../Controller/update.php';
include '../Constant/AuthExeption.php';
$user_email = requestInfo('user_email');
$user_password = requestInfo('user_password');
$confirm_user_password = requestInfo('confirm_user_password');
define('table', 'users');
$newInfo = array(
    'user_password' => "$user_password",
);
header('Content-type: application/json',    'Accept:application/json',);

if (empty($user_password) || empty($confirm_user_password)) {
    echo json_encode(array('STATUS' => AuthExeption::INVALID_INPUT));
} else if ($user_password == $confirm_user_password) {
    if (strlen($user_password) < 6) {

        echo json_encode(array('STATUS' => AuthExeption::WEAK_PASSWORD));
    } else {
        $updateInfo = update(table, $newInfo, where: "user_email = '$user_email'");
        echo json_encode($updateInfo);
    }
} else {
    echo json_encode(array('STATUS' => AuthExeption::NOT_MATCH_PASSWORD));
}
