<?php
/* Plugin Name: Remove the AutoP Filter
 * Plugin URI: http://www.firesidemedia.net/dev/software/wordpress/remove-the-wordpress-autop-filter/
 * Author: Jonathan Dingman
 * Author URI: http://www.firesidemedia.net/dev/
 * Version: 1.2
 * Description: Disables the <p> that is automatically inserted by WordPress
 */

remove_filter('the_content', 'wpautop');

?>
