<?php

include 'db_session.inc.php';

$_SESSION['uid'] =  1;
$_SESSION['username'] = 'hbdong';
$_SESSION['expire'] = 7200;


var_dump($_SESSION);