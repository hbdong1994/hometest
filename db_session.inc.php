<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/25/025
 * Time: 14:21
 */
$sdbc = null;

function open_session()
{
    global $sdbc;
    $sdbc = mysqli_connect('localhost', 'root', 'root', 'home_test');
    return true;
}

function read_session($sid)
{
    global $sdbc;
    $q = sprintf("SELECT `data` FROM `sessions` WHERE `id`='%s'", mysqli_real_escape_string($sdbc, $sid));
    $r = mysqli_query($sdbc, $q);
    if (mysqli_num_rows($r) == 1) {
        list($data) = mysqli_fetch_array($r);
        return $data;
    } else {
        return null;
    }
}

function write_session($sid, $data)
{
    global $sdbc;
    try {
        $q = sprintf('REPLACE INTO `sessions` (`id`, `data`) VALUES ("%s", "%s")',
            mysqli_real_escape_string($sdbc, $sid), mysqli_real_escape_string($sdbc, $data));
        $r = mysqli_query($sdbc, $q);
    } catch (Exception $exception) {
        file_put_contents('log.txt', sprintf("[%s] write_session_error: %s", date('Y-m-d H:i:s'), $exception->getMessage()));
    }

    return true;
}

function close_session()
{
    global $sdbc;
    return mysqli_close($sdbc);
}

function destroy_session($sid)
{
    global $sdbc;
    $q = sprintf("DELETE FROM `sessions` WHERE `id`= '%s' ", mysqli_real_escape_string($sdbc, $sid));
    $r = mysqli_query($sdbc, $q);
    $_SESSION = array();
    return true;
}

function clean_session($expire)
{
    global $sdbc;
    $q = sprintf("DELETE FROM `sessions` WHERE DATA_ADD(`last_at`, INTERVAL %d SECOND ) < NOW()", (int)$expire);
    $r = mysqli_query($q);
    return true;
}

session_set_save_handler('open_session','close_session', 'read_session', 'write_session', 'destroy_session', 'clean_session');

session_start();