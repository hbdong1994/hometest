<?php
$uid = $_GET['uid'];
$students = json_decode(file_get_contents('public/students.json'), true);
$student = $students[$uid];
if ( ! array_key_exists($uid, $students)) {
    $errors = "<div class=\"alert alert-danger\" role=\"alert\"> 暂无此用户信息 </div>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$student['name']?> - 浙江大学农学院十佳学子评选</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="public/jquery.min.js"></script>
    <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
        span#detail p {
            font-size: 1.2em;
        }
    </style>
</head>
<body style="font-family: 宋体">
<div class="container-fluid">
    <?php
        if (isset($errors)) {
            echo $errors;
        } else {
            ?>
            <div class="jumbotron col-md-12">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="<?= $student['image'] ?>" alt="<?=$student['name']?>" >
                    </div>
                </div>
                <div class="col-md-8 ol-xs-7 col-sm-7">
                    <h2 style="text-align: center"><?= $student['name'] ?></h2>
                    <span id="detail" style="text-indent: 2em">
                        <?= $student['reason'] ?>
                    </span>
                </div>
            </div>
            <?php
        }
    ?>
</div>

</body>
</html>
