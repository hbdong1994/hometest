<?php
$uid = $_GET['uid'];
$teachers = json_decode(file_get_contents('public/teachers.json'), true);
$teacher = $teachers[$uid];
if ( ! array_key_exists($uid, $teachers)) {
    $errors = "<div class=\"alert alert-danger\" role=\"alert\"> 暂无此用户信息 </div>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$teacher['name']?> - 浙江大学农学院第二届“我最喜爱的老师”评选</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="public/jquery.min.js"></script>
    <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">

    </style>
</head>
<body>
<div class="container-fluid">
    <?php
        if (isset($errors)) {
            echo $errors;
        } else {
            ?>
            <div class="jumbotron col-md-12">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="<?= $teacher['image'] ?>" alt="<?=$teacher['name']?>" >
                    </div>
                </div>
                <div class="col-md-8 ol-xs-7 col-sm-7">
                    <h1><?= $teacher['name'] ?></h1>
                    <span id="detail">
                        <?= $teacher['reason'] ?>
                    </span>
                </div>
            </div>
            <?php
        }
    ?>
</div>

</body>
</html>
