<?php
define('MB', 1048576);
function imageUpload($imageRequest)
{
    global $msgError;
    $randNumber = rand(1, 10000);
    $imageName = $randNumber . $_FILES[$imageRequest]['name'];
    $imagetemp = $_FILES[$imageRequest]['tmp_name'];
    $imagesize = $_FILES[$imageRequest]['size'];
    $allFileType = array("jpg", "png", "gif", "mp3", "jpeg");
    $strToArray = explode(".", $imageName);
    $ext = end($strToArray);
    $ext = strtolower($ext);
    if (!empty($imageName) && !in_array($ext, $allFileType)) {
        $msgError[] = "EXT";
    }
    if ($imagesize > 2 * MB) {
        $msgError[] = "SIZE";
    }
    if (empty($msgError)) {
        move_uploaded_file($imagetemp, "../upload/" . $imageName);
        return "$imageName";
    } else {
        return array('STATUS' => "$msgError");
    }
}
