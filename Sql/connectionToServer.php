<?php
$dsn = 'mysql:host=localhost;dbname=hypermart';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
);

try {
    $getSql = new PDO($dsn, $user, $pass, $option);
    $getSql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo $e->getMessage();
}
 