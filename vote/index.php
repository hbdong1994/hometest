<?php
$cfg = require('config.php');

$auth_url = "https://zjuam.zju.edu.cn/cas/oauth2.0/authorize";
$auth_url .= "?response_type=code&client_id={$cfg['app_key']}&redirect_uri={$cfg['redirect_uri']}";

header('location:'.$auth_url);

