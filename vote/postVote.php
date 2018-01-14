<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2018/1/14
 * Time: 3:17
 */
session_start();
require ('models/teacher.class.php');
require ('models/student.class.php');
require ('helper.php');
$cfg = require ('config.php');

$type = isset($_POST['type']) ? $_POST['type'] : 'teach';
if ($type == 'stu') {
    $model = new StudentVote();
    $time = 'stu_time';
} else {
    $model = new TeacherVote();
    $time = 'teach_time';
}

$supports = $_POST['support'];
$date = date('Y-m-d H:i:s');
if ( ! $model->getCfg('debug')) {
    if ($model->getCfg($time)['start'] > $date) {
        exit('<script>alert("活动未开始!");window.history.back();</script>');
    }
    if ($model->getCfg($time)['end'] < $date) {
        exit('<script>alert("活动已结束!");window.history.back();</script>');
    }
}
$info = getSessionUser();
if ($info === null) {
    exit('<script>alert("请登陆!");window.location.href="'.getAuthorizenUrl($cfg).'";</script>');
}

if ($info['attributes'][3]['DWH'] != "516000") {
    exit('<script>alert("您无权限投票！限【浙江大学农学院院全体学生】");window.history.back();</script>');
}

if ($model->isVoted($info['id'])) {
    exit('<script>alert("此账户今日已投票！");window.history.back();</script>');
}
$model->recordVoted($info['id']);
$model->insertVoteList($info['id'], $supports);
exit('<script>alert("投票成功！");window.history.back();</script>');





