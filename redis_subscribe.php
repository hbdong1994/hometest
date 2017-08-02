<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/9/009
 * Time: 16:23
 */
/**
 * 一般订阅者以cli形式运行
 */
ini_set('default_socket_timeout', -1);
require_once 'redis.inc.php';
$channel = 'test_publish_subscribe';

echo "订阅这个{$channel}频道, 等待推送······<br/>";
$redis->subscribe([$channel], 'showCallback');

function showCallback($redis, $channel, $msg) { //接收到消息参数后，调用回调函数处理业务逻辑
    $fp = fopen('redis_subscribe.txt', 'a+');
    fwrite($fp, "来自[$channel]的消息:". $msg ."\r\n");
    fclose($fp);
    echo $msg ."\n";
}


