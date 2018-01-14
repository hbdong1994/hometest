<?php
$teachers = json_decode(file_get_contents('public/teachers.json'), true);
$showStr = '';
$row = <<<row
<div class="col-sm-4 col-xs-6 col-md-2">
    <div class="thumbnail">
        <a target="_blank" href="detail.php?uid=%s" class="thumbnail">
            <img src="%s" alt="%s" style="width: 360px;height: 250px">
        </a>
        <div class="caption">
            <a target="_blank" href="detail.php?uid=%s">
                <h4>%s</h4>
            </a>
            <p><input type="checkbox" value="%s" name="support[]"> 投票</p>
        </div>
    </div>
</div>
row;

foreach ($teachers as $key => $teacher) {
    $showStr .= sprintf($row, $key, $teacher['image'], $teacher['name'], $key, $teacher['name'], $key);
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
    <form method="post" action="postVote.php" id="postVoteForm">

    <div class="row">
        <?php echo $showStr;?>
    </div>
    </form>

    <div class="ali"><button class="btn btn-primary" id="voteBtn">投票</button></div>
</div>

<script>
    $(function() {
        $("#voteBtn").click(function () {
            var checked = $('input[type="checkbox"]:checked');
            var  post = true;
            if (checked.length == 0) {
                post = false;
                alert('需要选择一位教师投票!');
            }
            if (checked.length > 10) {
                post = false;
                alert('最多只能选择10位投票!');
            }
            if (post) {
                document.getElementById('postVoteForm').submit();
            }

        });
    })

</script>

</body>
</html>