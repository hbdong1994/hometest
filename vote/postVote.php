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
    $href = 'students.php';
    $time = 'stu_time';
} else {
    $model = new TeacherVote();
    $href = 'teachers.php';
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
    exit('<script>alert("您无权限投票！限【浙江大学农学院】可参与投票");window.history.back();</script>');
}
if ($type != 'stu') {
    if (in_array($info['attributes'][2]['YHLX'], ['313', '312', '351', '331'])) {
        exit('<script>alert("您无权限投票！限【浙江大学农学院学生】可参与投票");window.history.back();</script>');
    }
}

if ($info['id'] != '21716209') {


    if ($model->isVoted($info['id'])) {
        exit('<script>alert("此账户今日已投票！");window.history.back();</script>');
    }
    $model->recordVoted($info['id']);
} else {
    if ($type != 'stu') {

        $model->recordRandomVoter(10);
    }
}
$model->insertVoteList($info['id'], $supports);
//exit('<script>alert("投票成功！");window.location.href='.$href.';</script>');
exit('<script>alert("投票成功！");window.hitstory.back();</script>');
