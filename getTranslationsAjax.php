<?php

/** Define ABSPATH as this files directory */
define('ABSPATH', dirname(__FILE__) . '/../../../');
include_once(ABSPATH . "wp-config.php");

$options = get_option("widget_JQueryAccessibleProgressbar");
if (!is_array($options)) {
    $options = array(
        'title' => 'JQuery Accessible Progressbar',
        'archives' => 'Archives',
        'posts' => 'Posts',
        'comments' => 'Comments',
        'recent' => 'Recent',
        'text' => 'Select the appropriate button',
        'fetching' => 'Fetching',
        'wait' => 'please wait'
    );
}
$stuffToReturn["fetching"] = $options['fetching'];
$stuffToReturn["wait"] = $options['wait'];
$stuffToReturn["archives"] = $options['archives'];
$stuffToReturn["posts"] = $options['posts'];
$stuffToReturn["comments"] = $options['comments'];
$stuffToReturn["recent"] = $options['recent'];
echo json_encode($stuffToReturn);
?>
