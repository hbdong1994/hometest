<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2018/1/14
 * Time: 3:17
 */
session_start();
require ('models/teacher.class.php');
require ('helper.php');

$teacher_model = new TeacherVote();

$supports = $_POST['support'];
$date = date('Y-m-d H:i:s');
if ($teacher_model->getCfg('teacher_start') > $date) {
    exit('<script>alert("活动未开始!");window.history.back();</script>');
}
if ($teacher_model->getCfg('teacher_end') < $date) {
    exit('<script>alert("活动已结束!");window.history.back();</script>');
}
$info = getSessionUser();
echo $_SESSION['info'] . "<br/>";
$_SESSION['a'] = 1;
echo $_SESSION['a'];

if ($teacher_model->isVoted($info['id'])) {
    exit('<script>alert("此账户今日已投票！");window.history.back();</script>');
}
$teacher_model->recordVoted($info['id']);
$teacher_model->insertVoteList($info['id'], $supports);
exit('<script>alert("投票成功！");window.history.back();</script>');





