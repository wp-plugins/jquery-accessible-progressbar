<?php
/*
Plugin Name: JQuery Accessible Progressbar
Plugin URI: http://wordpress.org/extend/plugins/jquery-accessible-progressbar/
Description: WAI-ARIA Enabled Progressbar Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 3.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "JQueryAccessibleProgressbar_init");
function JQueryAccessibleProgressbar_init() {
    register_sidebar_widget(__('JQuery Accessible Progressbar'), 'widget_JQueryAccessibleProgressbar');
    register_widget_control(   'JQuery Accessible Progressbar', 'JQueryAccessibleProgressbar_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_JQueryAccessibleProgressbar') ) {
        wp_register_style('jquery.ui.all', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-progressbar/lib/jquery-ui/themes/base/jquery.ui.all.css'));
        wp_enqueue_style('jquery.ui.all');

        wp_deregister_script('jquery');

        // add your own script
        wp_register_script('jquery-1.6.4', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-progressbar/lib/jquery-ui/jquery-1.6.4.js'));
        wp_enqueue_script('jquery-1.6.4');

        wp_register_script('jquery.ui.core', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-progressbar/lib/jquery-ui/ui/jquery.ui.core.js'));
        wp_enqueue_script('jquery.ui.core');

        wp_register_script('jquery.ui.widget', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-progressbar/lib/jquery-ui/ui/jquery.ui.widget.js'));
        wp_enqueue_script('jquery.ui.widget');

        wp_register_script('jquery.ui.button', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-progressbar/lib/jquery-ui/ui/jquery.ui.button.js'));
        wp_enqueue_script('jquery.ui.button');

        wp_register_script('jquery.ui.accordion', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-progressbar/lib/jquery-ui/ui/jquery.ui.accordion.js'));
        wp_enqueue_script('jquery.ui.accordion');

        wp_register_script('jquery.ui.progressbar', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-progressbar/lib/jquery-ui/ui/jquery.ui.progressbar.js'));
        wp_enqueue_script('jquery.ui.progressbar');

        wp_register_style('demos', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-progressbar/lib/jquery-ui/demos.css'));
        wp_enqueue_style('demos');

        wp_register_script('jquery-accessible-progressbar', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-progressbar/lib/jquery-accessible-progressbar.js'));
        wp_enqueue_script('jquery-accessible-progressbar');
    }
}

function widget_JQueryAccessibleProgressbar($args) {
    extract($args);

    $options = get_option("widget_JQueryAccessibleProgressbar");
    if (!is_array( $options )) {
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

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    JQueryAccessibleProgressbarContent();
    echo $after_widget;
}

function JQueryAccessibleProgressbarContent() {
    $options = get_option("widget_JQueryAccessibleProgressbar");
    if (!is_array( $options )) {
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

    echo '<div class="demo" role="application">
    <form id="formContainer">
    <div id="radioProgressbar">
        <input type="radio" id="radio1" name="radioProgressbar" value="archives" /><label for="radio1">' . $options['archives'] . '</label>
        <input type="radio" id="radio2" name="radioProgressbar" value="posts" /><label for="radio2">' . $options['posts'] . '</label>
        <input type="radio" id="radio3" name="radioProgressbar" value="comments" /><label for="radio3">' . $options['comments'] . '</label>
    </div>
    </form>
    <br />
    <div id="progressContainer">
        <div id="progressbar"></div>
    </div>
    <br />
    <div id="accordion_withProgressbar">
	<h3><a class="areaA" href="#">' . $options['recent'] . '...</a></h3>
	<div class="areaB">
            <ul>
                <li>' . $options['text'] . '</li>
            </ul>
	</div>
    </div>
</div>';
}

function JQueryAccessibleProgressbar_control() {
    $options = get_option("widget_JQueryAccessibleProgressbar");
    if (!is_array( $options )) {
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

    if ($_POST['JQueryAccessibleProgressbar-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['JQueryAccessibleProgressbar-WidgetTitle']);
        update_option("widget_JQueryAccessibleProgressbar", $options);
    }
    if ($_POST['JQueryAccessibleProgressbar-SubmitArchives']) {
        $options['archives'] = htmlspecialchars($_POST['JQueryAccessibleProgressbar-WidgetArchives']);
        update_option("widget_JQueryAccessibleProgressbar", $options);
    }
    if ($_POST['JQueryAccessibleProgressbar-SubmitRecent']) {
        $options['recent'] = htmlspecialchars($_POST['JQueryAccessibleProgressbar-WidgetRecent']);
        update_option("widget_JQueryAccessibleProgressbar", $options);
    }
    if ($_POST['JQueryAccessibleProgressbar-SubmitPosts']) {
        $options['posts'] = htmlspecialchars($_POST['JQueryAccessibleProgressbar-WidgetPosts']);
        update_option("widget_JQueryAccessibleProgressbar", $options);
    }
    if ($_POST['JQueryAccessibleProgressbar-SubmitComments']) {
        $options['comments'] = htmlspecialchars($_POST['JQueryAccessibleProgressbar-WidgetComments']);
        update_option("widget_JQueryAccessibleProgressbar", $options);
    }
    if ($_POST['JQueryAccessibleProgressbar-SubmitText']) {
        $options['text'] = htmlspecialchars($_POST['JQueryAccessibleProgressbar-WidgetText']);
        update_option("widget_JQueryAccessibleProgressbar", $options);
    }
    if ($_POST['JQueryAccessibleProgressbar-SubmitFetching']) {
        $options['fetching'] = htmlspecialchars($_POST['JQueryAccessibleProgressbar-WidgetFetching']);
        update_option("widget_JQueryAccessibleProgressbar", $options);
    }
    if ($_POST['JQueryAccessibleProgressbar-SubmitWait']) {
        $options['wait'] = htmlspecialchars($_POST['JQueryAccessibleProgressbar-WidgetWait']);
        update_option("widget_JQueryAccessibleProgressbar", $options);
    }
    ?>
    <p>
        <label for="JQueryAccessibleProgressbar-WidgetTitle">Widget Title: </label>
        <input type="text" id="JQueryAccessibleProgressbar-WidgetTitle" name="JQueryAccessibleProgressbar-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="JQueryAccessibleProgressbar-SubmitTitle" name="JQueryAccessibleProgressbar-SubmitTitle" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleProgressbar-WidgetArchives">Translation for "Archives": </label>
        <input type="text" id="JQueryAccessibleProgressbar-WidgetArchives" name="JQueryAccessibleProgressbar-WidgetArchives" value="<?php echo $options['archives'];?>" />
        <input type="hidden" id="JQueryAccessibleProgressbar-SubmitArchives" name="JQueryAccessibleProgressbar-SubmitArchives" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleProgressbar-WidgetPosts">Translation for "Posts": </label>
        <input type="text" id="JQueryAccessibleProgressbar-WidgetPosts" name="JQueryAccessibleProgressbar-WidgetPosts" value="<?php echo $options['posts'];?>" />
        <input type="hidden" id="JQueryAccessibleProgressbar-SubmitPosts" name="JQueryAccessibleProgressbar-SubmitPosts" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleProgressbar-WidgetComments">Translation for "Comments": </label>
        <input type="text" id="JQueryAccessibleProgressbar-WidgetComments" name="JQueryAccessibleProgressbar-WidgetComments" value="<?php echo $options['comments'];?>" />
        <input type="hidden" id="JQueryAccessibleProgressbar-SubmitComments" name="JQueryAccessibleProgressbar-SubmitComments" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleProgressbar-WidgetRecent">Translation for "Recent": </label>
        <input type="text" id="JQueryAccessibleProgressbar-WidgetRecent" name="JQueryAccessibleProgressbar-WidgetRecent" value="<?php echo $options['recent'];?>" />
        <input type="hidden" id="JQueryAccessibleProgressbar-SubmitRecent" name="JQueryAccessibleProgressbar-SubmitRecent" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleProgressbar-WidgetText">Translation for "Select the appropriate button": </label>
        <input type="text" id="JQueryAccessibleProgressbar-WidgetText" name="JQueryAccessibleProgressbar-WidgetText" value="<?php echo $options['text'];?>" />
        <input type="hidden" id="JQueryAccessibleProgressbar-SubmitText" name="JQueryAccessibleProgressbar-SubmitText" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleProgressbar-WidgetFetching">Translation for "Fetching": </label>
        <input type="text" id="JQueryAccessibleProgressbar-WidgetFetching" name="JQueryAccessibleProgressbar-WidgetFetching" value="<?php echo $options['fetching'];?>" />
        <input type="hidden" id="JQueryAccessibleProgressbar-SubmitFetching" name="JQueryAccessibleProgressbar-SubmitFetching" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleProgressbar-WidgetWait">Translation for "please wait": </label>
        <input type="text" id="JQueryAccessibleProgressbar-WidgetWait" name="JQueryAccessibleProgressbar-WidgetWait" value="<?php echo $options['wait'];?>" />
        <input type="hidden" id="JQueryAccessibleProgressbar-SubmitWait" name="JQueryAccessibleProgressbar-SubmitWait" value="1" />
    </p>
    
    <?php
}

?>
