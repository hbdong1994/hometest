<?php

$config = require ('config.php');

$postParams = $_POST;
$orderNo = date('YmdHis').substr(time(), -3);
$orderTime = date('YmdHis');

//$postParams['version'] = $config['version'];
$postParams['order_time'] = $orderTime;
$postParams['mch_no'] = $orderNo;
$postParams['mch_code'] = $config['mch_code'];
$postParams['return_url'] = $config['return_url'];
$postParams['callback_url'] = $config['callback_url'];
$postParams['app_id'] = $config['app_id'];
$postParams['version'] = $config['version'];

ksort($postParams);

$signStr = '';
foreach ($postParams as $key => $param) {
    $signStr .= $key .'=' . $param . '&';
}
$sign = md5($signStr . $config['mch_key']);

$postParams['sign'] = $sign;
$form = "<body onload='autoSubmit();'><form id='postForm' action='".$config['gateway_url']."' method='post'>";
foreach ($postParams as $key => $value) {
    $form .= "<input type='hidden' value='{$value}' name='{$key}'>";
}
$form .= '</form></body><script type="text/javascript">function autoSubmit() { document.getElementById("postForm").submit()} </script>';


echo $form;


