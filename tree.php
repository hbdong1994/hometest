<?php

$db = mysqli_connect('localhost', 'root', 'root', 'home_test') or die('mysql_connect_error:'.mysqli_error($db));

$tree_id = 0;

$q = sprintf('SELECT `id`, `name`, `parent_id`, `deep` FROM `infinite` ORDER BY `parent_id`, `id` ASC ', mysqli_real_escape_string($db, $tree_id));
$r = mysqli_query($db, $q);
$tasks = [];
while (list($tid, $name, $pid, $deep) = mysqli_fetch_array($r)) {
    $tasks[$pid][$tid] = $name;
    $tasks[$pid]['deep'] = $deep;
}

make_list($tasks[$tree_id]);

function make_list($task)
{
    global $tasks;
    echo '<ul>';
    foreach ($task as $pid => $name) {
        if ($pid != 'deep') {
            echo "<li>$name   -------{$task['deep']}";
        }
        if (isset($tasks[$pid])) {
            make_list($tasks[$pid]);
        }
        echo "</li>";
    }
    echo '</ul>';
}