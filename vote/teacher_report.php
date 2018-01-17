<?php
/**
 * Created by PhpStorm.
 * User: dong
 * Date: 2018/1/14
 * Time: 19:58
 */
require ('models/teacher.class.php');
$t_model = new TeacherVote();
$teachers = json_decode(file_get_contents('public/teachers.json'), true);

$records = $t_model->getVoteRecords();
$votes = [];
$supports = 0;
while ($row = $records->fetch_assoc()) {
    $votes[$row['candidate']] = [
        'name' => $teachers[$row['candidate']]['name'],
        'support' => $row['support']
    ];
    $supports += $row['support'];
}

$tableStr = "";
foreach ($votes as $id => $vote) {
    $tableStr .= "<tr><td>{$vote['name']}</td><td>{$vote['support']}</td></tr>";
}
$all = $t_model->getAllVoters();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>投票结果 - 浙江大学农学院第二届“我最喜爱的老师”评选</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">

    <script type="text/javascript" src="public/jquery.min.js"></script>
    <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <h1>浙江大学农学院第二届“我最喜爱的老师”评选 活动 - 投票结果 </h1>
    总投票人数：<span class="label label-info"> <?=$all->fetch_assoc()['voters']?></span>
    总投票数：<span class="label label-info"> <?=$supports?></span>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>老师姓名</th>
                <th>获得票数</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($tableStr == "") echo "<tr ><td colspan='2'>暂无数据</td></tr>"; else echo $tableStr?>
        </tbody>
    </table>
</div>
</body>
</html>


