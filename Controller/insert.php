<?php

function insert($table, $info)
{

    include '../Sql/connectionToServer.php';
    $getKeys = implode(', ', array_keys($info));
    $allInfo = array();
    foreach ($info as $value) {
        array_push($allInfo, '\'' . $value . '\'');
    }
    $getVlues =  implode(', ', $allInfo);


    $insertInfo = $getSql->prepare("INSERT INTO $table($getKeys) VALUES ($getVlues)");
    $insertInfo->execute();
    $rowCount = $insertInfo->rowCount();
    if ($rowCount != 0) {
        return array('STATUS' => 'SUCCESSFUL');
    } else {
        return array('STATUS' => 'FAIL');
    }
}
