<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/9/009
 * Time: 16:15
 */
ini_set('default_socket_timeout', -1);
require_once 'redis.inc.php';

//普通键值存储

//$redis->set('php_set', '11234441');
//$redis->expire('php_set', 10); //过期时间，超时自动消失

$channel = "test_publish_subscribe";

$redis->publish($channel, "this is come from {$channel}'s message");
$redis->publish($channel, 'this is come 2');
echo "{$channel} 推送成功";
$redis->close();


