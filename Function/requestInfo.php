<?php
function requestInfo($requestName)
{
    return htmlspecialchars(strip_tags($_POST[$requestName]));
}
