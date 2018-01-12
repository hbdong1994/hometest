<?php
require 'helper.php';
$cfg = require('config.php');
try {
    $info = getAuthInfo($cfg);
    var_dump($info);
} catch (Exception $exception) {
    $fp = fopen('log.txt', 'a+');
    fwrite($fp, $exception);
    fclose($fp);
    echo $exception->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>投票首页</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">

    <script type="text/javascript" src="public/jquery.min.js"></script>
    <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="alert alert-danger" role="alert"> 错误 </div>
    <div class="row">
        <div class="col-sm-4 col-xs-6 col-md-2">
            <div class="thumbnail">
                <a href="detail.php?uid=111111" class="thumbnail">
                <img src="public/image/xiezhedong.jpg" alt="六十成">
                </a>
                <div class="caption">
                    <a href="detail.php?uid=111111">
                    <h4>六十成</h4>
                    </a>
                    <p>...</p>
                    <p><input type="radio" value="10001" name="vote"> 投票</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6 col-md-2">
            <div class="thumbnail">
                <a href="detail.php?uid=111111" class="thumbnail">
                    <img src="public/image/xiezhedong.jpg" alt="六十成">
                </a>
                <div class="caption">
                    <a href="detail.php?uid=111111">
                        <h4>六十成</h4>
                    </a>
                    <p>...</p>
                    <p><input type="radio" value="10001" name="vote"> 投票</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6 col-md-2">
            <div class="thumbnail">
                <a href="detail.php?uid=111111" class="thumbnail">
                    <img src="public/image/xiezhedong.jpg" alt="六十成">
                </a>
                <div class="caption">
                    <a href="detail.php?uid=111111">
                        <h4>六十成</h4>
                    </a>
                    <p>...</p>
                    <p><input type="radio" value="10001" name="vote"> 投票</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6 col-md-2">
            <div class="thumbnail">
                <a href="detail.php?uid=111111" class="thumbnail">
                    <img src="public/image/xiezhedong.jpg" alt="六十成">
                </a>
                <div class="caption">
                    <a href="detail.php?uid=111111">
                        <h4>六十成</h4>
                    </a>
                    <p>...</p>
                    <p><input type="radio" value="10001" name="vote"> 投票</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6 col-md-2">
            <div class="thumbnail">
                <a href="detail.php?uid=111111" class="thumbnail">
                    <img src="public/image/xiezhedong.jpg" alt="六十成">
                </a>
                <div class="caption">
                    <a href="detail.php?uid=111111">
                        <h4>六十成</h4>
                    </a>
                    <p>...</p>
                    <p><input type="radio" value="10001" name="vote"> 投票</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-6 col-md-2">
            <div class="thumbnail">
                <a href="detail.php?uid=111111" class="thumbnail">
                    <img src="public/image/xiezhedong.jpg" alt="六十成">
                </a>
                <div class="caption">
                    <a href="detail.php?uid=111111">
                        <h4>六十成</h4>
                    </a>
                    <p>...</p>
                    <p><input type="radio" value="10001" name="vote"> 投票</p>
                </div>
            </div>
        </div>
    </div>

    <div class="ali"><button class="btn btn-primary" id="voteBtn">投票</button></div>
</div>

<script>
    $(function() {
        $("#voteBtn").click(function () {
            var vote = $('input[name="vote"][checked]').val();
            console.log(vote);
            if (vote == 'undefined') {
                alert('需要选择一位教师投票');
            }
        });
    })
</script>

</body>
</html>






