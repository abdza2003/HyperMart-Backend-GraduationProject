<?php

function delete($table, $where)
{
    include '../Sql/connectionToServer.php';
    $deleteInfo = $getSql->prepare("DELETE FROM $table WHERE $where");
    $deleteInfo->execute();
    $count = $deleteInfo->rowCount();
    if ($count != 0) {
        return array('STATUS' => 'SUCCESSFUL');
    } else {
        return array('STATUS' => 'FAIL');
    }
}


