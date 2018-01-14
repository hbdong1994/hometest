
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>选择投票活动</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="public/jquery.min.js"></script>
    <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="panel panel-warning">
            <div class="panel-heading"><h4>Tips:</h4></div>
            <div class="panel-body">
                <ul style="font-size: 13px">
                    <li>浙江大学农学院院全体学生具有投票权</li>
                    <li>投票人可从评选老师中至多选择10位进行投票</li>
                    <li>每日限投一次，每次最多选择10位人选投票</li>
                    <li>
                        如对候选人及投票工作有异议，可通过电话或邮件向评选工作委员会反映：
                        <p>施伊晟 15157774875   yisheng30000@163.com</p>
                        <p>闫睿 18069869805   425589969@qq.com</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row col-sm-10 col-md-8 col-lg-8">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
            <div class="thumbnail">
                <div class="caption">
                    <h3>浙江大学农学院第二届“我最喜爱的老师”评选</h3>
                    <p><a href="teachers.php" class="btn btn-primary" role="button">进入投票</a></p>
                    <p>投票时间: <?=$cfg['teach_time']['start']?> - <?=$cfg['teach_time']['end']?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
            <div class="thumbnail">
                <div class="caption">
                    <h3>浙江大学农学院十佳学子评选</h3>
                    <p><a href="students.php" class="btn btn-primary" role="button">进入投票</a></p>
                    <p>投票时间: <?=$cfg['stu_time']['start']?> - <?=$cfg['stu_time']['end']?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php