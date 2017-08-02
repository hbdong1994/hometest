<?php

$db = mysqli_connect('localhost', 'dean_hometest', 'NxACxrXJnT', 'dean_hometest') or die('error:'.mysqli_error($db));
$mysql = "fecht_error";

$sql = "select * from users where param=:param and search= :spa";


function testSublime() {
    echo "this is test sublime's func";
}