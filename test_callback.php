<?php

$out_trade_no = '2018011304161752609';
$amt = '1.00';
$key = 'rangerdongsign';


$params = [
    'out_trade_no' => $out_trade_no,
    'total_fee' => $amt,
    'return_code' => 1,
    'sign' => md5($out_trade_no.$amt."1".$key)
];

header('location:'. "http://hd.495833.com/vippay/returnotify.aspx?" .http_build_query($params));
