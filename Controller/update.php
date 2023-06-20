<?php

function update($table, $info, $where)
{
    include '../Sql/connectionToServer.php';

    $getInfo = array();
    foreach ($info as $keys => $values) {
        array_push($getInfo, "$keys = '$values'");
    }
    $newInfo   = implode(', ', $getInfo);

    $updateInfo = $getSql->prepare("UPDATE $table SET $newInfo WHERE $where");
    $updateInfo->execute();
    $count = $updateInfo->rowCount();
    if ($count != 0) {
        return array('STATUS' => 'SUCCESSFUL');
    } else {
        return array('STATUS' => 'FAIL');
    }
}
