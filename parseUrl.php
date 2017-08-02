<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/9/009
 * Time: 14:55
 */

/************
 *  常用函数 - 解析get方法传输变量数据包的方法
 *
 * **********
 */

$url = 'http://www.baidu.com/index.php?m=content&c=index&a=lists&catid=6&area=0&author=0&h=0&region=0&s=1&page=1';
$parse_arr = parse_url($url);
var_dump($parse_arr);
$data = convertUrlData($parse_arr['query']);
var_dump($data);

var_dump(parseUrlStr($data));


/**
 * array (size=4)
 * 'scheme' => string 'http' (length=4)
 * 'host' => string 'www.baidu.com' (length=13)
 * 'path' => string '/index.php' (length=10)
 * 'query' => string 'm=content&c=index&a=lists&catid=6&area=0&author=0&h=0&region=0&s=1&page=1' (length=73)
 */

/**
 * @param $parse_query
 * @return array
 */
function convertUrlData($parse_query) {
    $data = [];
    $query = explode('&', $parse_query);
    foreach ($query as $v) {
        $item = explode('=', $v);
        $data[$item[0]] = $item[1];
    }
    return $data;
}

/**
 * @param $data array 传输数组
 * @return bool|string
 */
function parseUrlStr($data) {
    $query_str = '';
    foreach ($data as $k => $v) {
        $key_value = $k. '='. $v;
        $query_str .= $key_value .'&';
    }
    return substr($query_str, 0, -1);
}
