<?php
session_start();
require 'helper.php';
$cfg = require('config.php');
try {
    if (getSessionUser() === null) {
        $info = getAuthInfo($cfg);
    }
} catch (Exception $exception) {
    $fp = fopen('log.txt', 'a+');
    fwrite($fp, "[".date('Y-m-d H:i:s')."]" . $exception);
    fclose($fp);
    if (!$cfg['debug']) {
        header('location:' . getAuthorizenUrl($cfg));
        exit();
    }
}
$state = isset($_GET['state']) ? $_GET['state'] : null;
if ($state !== null) {
    $state == 'stu' ? header('location:students.php') : header('location:teachers.php');
} else {
    require('choiceType.php');
}
?>

