<?php
require_once 'autologin_db.inc.php';
$alert = '';
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $q = sprintf("INSERT INTO `user_login` (`username`, `password`, `autologin`) VALUES ('%s', '%s', 0)",
        mysqli_real_escape_string($db, $username), mysqli_real_escape_string($db, $password)
        );
    $r = mysqli_query($db, $q) or die(mysqli_error($db));
    $alert = '添加成功';
}



?>

<!
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<div id="alert"><?=$alert?></div>
<form method="post" action="<?= $_SERVER['PHP_SELF']?>">
<table cellspacing="0" cellpadding="20" border="0">
    <tr>
        <td>用户名</td>
        <td><input name="username" type="text"></td>
    </tr>
    <tr>
        <td>密码</td>
        <td><input name="password" type="password"></td>
    </tr>
    <tr><td colspan="2"><input type="submit" value="注册"></td></tr>
</table>
</form>

</body>
</html>