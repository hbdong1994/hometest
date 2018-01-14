<?php
session_start();
require ('helper.php');
$cfg = require('config.php');
//var_dump($_SESSION['info']);
//exit;

if (getSessionUser() === null) {
    $auth_url = "https://zjuam.zju.edu.cn/cas/oauth2.0/authorize";
    $auth_url .= "?response_type=code&client_id={$cfg['app_key']}&redirect_uri={$cfg['redirect_uri']}";
    header('location:'.$auth_url);
    exit();
}
header('location:teachers.php');
