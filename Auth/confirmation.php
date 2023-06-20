<?php

include '../Function/requestInfo.php';
include '../Controller/read.php';
include '../Controller/update.php';
include '../Constant/AuthExeption.php';
header('Content-type: application/json',    'Accept:application/json',);

$user_email = requestInfo('user_email');
$user_verifycode = requestInfo('user_verifycode');
define('table', 'users');
$readInfo = read(table, "user_email = '$user_email'");
$newInfo = array(
    'user_approve' => 1,
);
if ($readInfo['STATUS'] == 'SUCCESSFUL') {
    if ($readInfo['INFO']['user_verifycode'] == $user_verifycode) {
        if ($readInfo['INFO']['user_approve'] == 1) {
            echo json_encode(array('STATUS' => 'SUCCESSFUL'));
        } else {
            $updateInfo = update(table, $newInfo, "user_email = '$user_email'");
            echo json_encode($updateInfo);
        }
    } else {
        echo json_encode(array('STATUS' => 'FAILURE_CONFIRMATION_CODE'));
    }
} else {
    echo json_encode(array('STATUS' => 'FAIL'));
}
