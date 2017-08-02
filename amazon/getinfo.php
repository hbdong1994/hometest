<?php
/**
 * Created by PhpStorm.
 * User: deandong
 * Date: 17/8/2
 * Time: 23:57
 */
ini_set('memory_limit', '1024M');
require_once 'ParserDom.php';
require_once 'curl_func.php';

$start = time();
$asin = $_GET['asin'] ?: die('asin is empty');

$url = 'https://www.amazon.com/dp/'.$asin;

$content = curlGet($url);
//$content = file_get_contents('amazon.txt');
$html = new \HtmlParser\ParserDom($content);

//
$title = $html->find('span#productTitle', 0);
$desc_dom = $html->find('#feature-bullets', 0);
$desc_li = $desc_dom->find('li');
$desc ='';
$price = substr(
    $html->find('span#priceblock_ourprice',0)->getPlainText(),
    1
);
foreach ($desc_li as $li) {
    $desc .= trim($li->find('span',0)->getPlainText()) ." \n";
}



//file_put_contents('fetch.txt', $html->innertext);
$info['title'] = trim($title->getPlainText());
$info['desc'] = $desc;
$info['price'] = $price;
$end = time();
var_dump($info);
echo bcsub($end, $start);


