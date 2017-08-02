<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/26/026
 * Time: 9:36
 */
require_once 'autologin_db.inc.php';
require_once 'db_session.inc.php';
$alert ='';
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    $username = mysqli_real_escape_string($db, trim($_POST['username']));
    $password = mysqli_real_escape_string($db, trim($_POST['password']));
    $autologin = isset($$_POST['autologin']) ? true : false;

    $q = sprintf("SELECT `password`, `status` FROM `user_login` WHERE `username` = '%s'", $username);
    $r = mysqli_query($db, $q);
    list($verify) = $r == null ? die('用户名不存在') : mysqli_fetch_array($r);
    if ( ! password_hash($password, $verify)) {
        exit('密码不正确');
    }
    if ($autologin) {
        $r = mysqli_query($db, "UPDATE `user_login` SET `autologin` = 1 WHERE `username`= '{$username}'");
        $session_id = session_id();
        setcookie('PHPSESSID', $session_id, time() + 60*60*24*365);

        setcookie('autoLogin');
    }
    $_SESSION['username'] = $username;


    $alert = '登录成功';
}
testSublime();
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
        <tr><td colspan="2"><input type="checkbox" name="autologin"> 自动登录 <input type="submit" value="登录"></td></tr>
    </table>
</form>

</body>
</html>
