<?php
/**
 * Created by PhpStorm.
 * User: deandong
 * Date: 17/8/3
 * Time: 00:16
 * @param $url
 * @return mixed
 */


function curlGet($url)
{
    $ch = curl_init();
    $header = array("Content-Type: text/html;charset=utf-8");
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {        //是否有user_agent信息
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR,1);
    //https
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (isset($user_agent)) {
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    }

    $res = curl_exec($ch);
//    file_put_contents('amazon.txt', $res);
    curl_close($ch);
    return $res;
}


