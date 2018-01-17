<?php
session_start();
require ('helper.php');
require ('models/teacher.class.php');

$cfg = require ('config.php');
if (getSessionUser() === null) {
    header('location:'.getAuthorizenUrl($cfg));
    exit();
}

$model = new TeacherVote();

$records = $model->getVoteRecords();
while ($row = $records->fetch_assoc()) {
    $votes[$row['candidate']] = $row['support'];
}


$teachers = json_decode(file_get_contents('public/teachers.json'), true);
$showStr = '';
$row = <<<row
<div class="col-sm-4 col-xs-6 col-md-2">
    <div class="thumbnail">
        <a target="_blank" href="detail.php?uid=%s" class="thumbnail">
            <img src="%s" alt="%s" style="width: 360px;height: 220px">
        </a>
        <div class="caption">
            <a target="_blank" href="detail.php?uid=%s">
                <h4 style="text-align: center">%s</h4>
            </a>
            <p><input type="checkbox" value="%s" name="support[]" id="support%d"> 
            <label for="support%d"><span class="btn btn-sm btn-info">投票</span></label> 
            <a href="detail.php?uid=%s" target="_blank" class="btn btn-sm ">查看详情</a>
            <span class="btn btn-xs bottom-right"><span class="btn btn-success right">%s</span> 票</span>
            </p>
        </div>
    </div>
</div>
row;

$loop = 0;
foreach ($teachers as $key => $teacher) {
    $showStr .= sprintf($row, $key, $teacher['image'], $teacher['name'], $key, $teacher['name'], $key, $loop, $loop, $key, array_key_exists($key, $votes)? $votes[$key]: 0);
    $loop++;
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>浙江大学农学院第二届“我最喜爱的老师”评选</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">

    <script type="text/javascript" src="public/jquery.min.js"></script>
    <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
<!--    <div class="alert alert-danger" role="alert"> </div>-->
    <div class="page-header">
        <h3 style="text-align: center">浙江大学农学院第二届“我最喜爱的老师”评选活动</h3>
    </div>
    <div class="row">
        <div class="panel panel-warning">
            <div class="panel-heading"><h4>投票说明:</h4></div>
            <div class="panel-body">
                <ul style="font-size: 13px">
                    <li>浙江大学农学院全体学生具有投票权</li>
                    <li>投票人需从候选老师中至少选择5位，至多选择10位进行投票，每个账号限投一次；评选老师按照姓氏笔画排序</li>
                    <li>投票时间：<?=date('Y年m月d日 H点' , strtotime($cfg['teach_time']['start']))?> - <?=date('Y年m月d日 H点', strtotime($cfg['teach_time']['end']))?></li>
                    <li>
                        如对候选人及投票工作有异议，可通过电话或邮件向评选工作委员会反映：
                        <br/>施伊晟 15157774875   yisheng30000@163.com
                        <br/>闫睿 18069869805   425589969@qq.com
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="post" action="postVote.php" id="postVoteForm">

    <div class="row">
        <?php echo $showStr;?>
    </div>
    </form>

    <div class="ali"><span> 已选择 <span id="support_num" class="label label-info" >0</span> 位</span><button class="btn btn-primary btn-lg center-block" id="voteBtn">投票</button> </div>
</div>

<script type="text/javascript" src="public/postVote.js"></script>

</body>
</html>
