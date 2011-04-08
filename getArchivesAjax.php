<?php

/** Define ABSPATH as this files directory */
define('ABSPATH', dirname(__FILE__) . '/../../../');
include_once(ABSPATH . "wp-config.php");

$args = array(
    'type' => 'monthly',
    'format' => 'html',
    'show_post_count' => false,
    'echo' => 0);

$archives = wp_get_archives($args);
$output = $archives;

$stuffToReturn = array();
$stuffToReturn["list"] = $output;
echo json_encode($stuffToReturn);
?>
