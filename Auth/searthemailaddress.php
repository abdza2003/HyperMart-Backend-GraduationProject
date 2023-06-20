<?php

include '../Function/requestInfo.php';
include '../Controller/read.php';
include '../Function/sendVerifyCode.php';

define('table', 'users');
header('Content-type: application/json',    'Accept:application/json',);

$user_email = requestInfo('user_email');
$readEmail = read(table, where: "user_email = '$user_email'");
if ($readEmail['STATUS'] == 'SUCCESSFUL') {
    sendVerifyCode(table, $user_email);
    echo json_encode(array('STATUS' => 'SUCCESSFUL'));
} else if ($readEmail['STATUS'] == 'FAIL') {

    echo json_encode(array('STATUS' => 'NOT_AVAILAVLE'));
}
