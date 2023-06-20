<?php
function read($tableName, $where = null)
{
    include '../Sql/connectionToServer.php';

    if ($where == null) {

        $readInfo = $getSql->prepare('SELECT * FROM ' . $tableName);
    }else{
        $readInfo = $getSql->prepare("SELECT * FROM  $tableName WHERE $where");

    }
    $readInfo->execute();
    $fetchAll = $readInfo->fetch(PDO::FETCH_ASSOC);
    $count = $readInfo->rowCount();
    if ($count != 0) {
        return array('STATUS' => 'SUCCESSFUL', 'INFO' => $fetchAll);
    }else{
        return array('STATUS' => 'FAIL');
    }
}
