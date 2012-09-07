<?php

function get_count_notice()
{
    return "You have <span style='color:red;font-weight:bolder;'>" .
    " " . get_my_posts() . " " .
    "</span> posts." .
    "<br />" .
    "Since you started using Better Delete Revision, " .
    "<span id='revs_no' style='color:red;font-weight:bolder;'>" .
    " " . get_option('bdel_revision_no') . " " .
    "</span> redundant post revisions have been removed!";
}

function get_bdr_footer()
{
    $returnString = "";
    $returnString .= '<br /><div class="widget"><div style="margin:12px; line-height: 1.5em">';
    $returnString .= 'Post Revisions are a feature introduced in Wordpress 2.6. ';
    $returnString .= 'Whenever you or Wordpress saves a post or a page, a ';
    $returnString .= 'revision is automatically created and stored in your ';
    $returnString .= 'Wordpress database. Each additional revision will slowly ';
    $returnString .= 'increase the size of your database. If you save a post or ';
    $returnString .= 'page multiple times, your number of revisions will greatly ';
    $returnString .= 'increase overtime. For example, if you have 100 posts and ';
    $returnString .= 'each post has 10 revisions you could be storing up to ';
    $returnString .= '1,000 copies of older data!<br /><br />';
    $returnString .= 'The Better Delete Revision ';
    $returnString .= 'plugin is your #1 choice to quickly and easily removing ';
    $returnString .= 'revision from your Wordpress database. Try it out today to ';
    $returnString .= 'see what a lighter and smaller Wordpress database can do for you!<br /><br />';
    $returnString .= 'Thank you for using this plugin! I hope you enjoy it!<br /><br />';
    $returnString .= 'Author: ';
    $returnString .= '<A href="http://www.1e2.it" target="_blank">http://www.1e2.it</a></div></div>';
    
    return $returnString;
}
function get_bdr_version()
{
    return '1.2';
}

function get_my_posts()
{
	global $wpdb;	
	$sql = "SELECT ID
            FROM ($wpdb->posts)
            WHERE `post_type` = 'post'";
	$results = $wpdb -> get_results($sql);
	return count($results);
}