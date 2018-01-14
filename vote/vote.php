<?php
session_start();
require 'helper.php';
$cfg = require('config.php');
try {
    $info = getAuthInfo($cfg);
} catch (Exception $exception) {
    $fp = fopen('log.txt', 'a+');
    fwrite($fp, "[".date('Y-m-d H:i:s')."]" . $exception);
    fclose($fp);
    if (!$cfg['debug']) {
        header('location:' . getAuthorizenUrl($cfg));
        exit();
    }
}
require('choiceType.php');
?>

