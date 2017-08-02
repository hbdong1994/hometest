<?php
/**
 * Created by Etekcity.
 * User: Dean.Dong
 * Date: 2017/7/14
 * Time: 15:47
 */
date_default_timezone_set('Canada/Pacific');
$data = 'Sun Aug 20 2017 15:00:00 GMT+0800';

$datetime = new DateTime($data);
var_dump($datetime->format('Y-m-d H:i:s'));

$data = [
    'trans' => '2.9',
    'charge' => '',
];