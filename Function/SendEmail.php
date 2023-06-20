<?php


function sendEmail($to, $title, $body) {
    $headr = 'From: Abdulrahim Za - abdza2003 < abdza1355@gmail.com >';
    if(mail($to, $title, $body, $headr)){
        return array('SEND_EMAIL' => 'SUCCESSFUL');
    }else{
        return array('SEND_EMAIL' => 'FAIL');
    }   
}

function sendVerifyCodeToEmail($user_email, $user_verifycode){
   return sendEmail($user_email, 'Store App - New Register', "Welcome to app \n VerifyCode -: {$user_verifycode}");
}