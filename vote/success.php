<?php

require ('models/teacher.class.php');
require ('models/student.class.php');
require ('helper.php');
$cfg = require ('config.php');

$type = $_GET['type'] ? : 'teach';

if ($type == 'stu') {
    $model = new StudentVote();
    $title = '浙江大学农学院十佳学子评选';
    $time = 'stu_time';
} else {
    $model = new TeacherVote();
    $title = '浙江大学农学院第二届“我最喜爱的老师”评选';
    $time = 'teach_time';
}

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
            <span class="btn " >获得票数: <span class="btn btn-info">%d</span> </span>
            </p>
        </div>
    </div>
</div>
row;

$loop = 0;
foreach ($teachers as $key => $teacher) {
    $showStr .= sprintf($row, $key, $teacher['image'], $teacher['name'], $key, $teacher['name'], $votes[$key]);
    $loop++;
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>投票结果 - <?=$title?></title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">

    <script type="text/javascript" src="public/jquery.min.js"></script>
    <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <!--    <div class="alert alert-danger" role="alert"> </div>-->
    <div class="page-header">
        <h2 style="text-align: center"><?=$title?> - 投票结果</h2>
    </div>
    <form method="post" action="postVote.php" id="postVoteForm">

        <div class="row">
            <?php echo $showStr;?>
        </div>
    </form>

</div>

<script type="text/javascript" src="public/postVote.js"></script>

</body>
</html>






