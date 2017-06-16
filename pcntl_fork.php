<?php
/**
 * Created by PhpStorm.
 * User: XD
 * Date: 2017/6/16
 * Time: 16:16
 */
$parentPid = getmypid();
$pid = pcntl_fork();
if ($pid == -1) {
    echo $pid;
    die('fork disabled');
} elseif ($pid == 0) {
    $cpid = getmypid();
    echo 'current pid is '.$cpid ."<br/>". "my father pid is ".$parentPid;
} else {
    echo "im father now  my child's pid is $pid and mine is ".$parentPid;
}