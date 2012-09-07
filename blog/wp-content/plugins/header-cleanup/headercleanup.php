<?php
/*
Plugin Name: Head Cleanup
Plugin URI: http://binarym.com/2010/wordpress-head-cleanup-plugin/
Description: Remove extraneous head tags from WordPress.
Version: 0.0.6
Author: Matt McInvale - BinaryM Inc.
Author URI: http://binarym.com/

	To Do:	
		Get tacos for lunch
*/

if (!is_admin()) add_action('init', 'removeJankFromHeader', 99999);

function removeJankFromHeader() {
	$binaryheadercleanup = get_option('binaryheadercleanup');

	// remove junk from head
	if ($binaryheadercleanup['rsdlink']) remove_action('wp_head', 'rsd_link');
	if ($binaryheadercleanup['wpgenerator']) remove_action('wp_head', 'wp_generator');
	if ($binaryheadercleanup['feedlinks']) remove_action('wp_head', 'feed_links', 2);
	if ($binaryheadercleanup['indexrel']) remove_action('wp_head', 'index_rel_link');
	if ($binaryheadercleanup['wlwmanifest']) remove_action('wp_head', 'wlwmanifest_link');
	if ($binaryheadercleanup['feedlinksextra']) remove_action('wp_head', 'feed_links_extra', 3);
	if ($binaryheadercleanup['startpostrellink']) {
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'start_post_rel_link_wp_head', 10, 0);
	}
	if ($binaryheadercleanup['parentpostrellink']) remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	if ($binaryheadercleanup['adjacentpostsrellink']) {
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	}
	if ($binaryheadercleanup['relcanonical']) remove_action('wp_head', 'rel_canonical');
	if ($binaryheadercleanup['noindex']) remove_action('wp_head', 'noindex', 1);
	if ($binaryheadercleanup['recentcommentsstyle']) headerCleanupKillCommentsStyle();
	if ($binaryheadercleanup['shortlink']) {
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
		remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
	}
	if ($binaryheadercleanup['commentsrss']) {
		add_filter('post_comments_feed_link','headerCleanupKillCommentsRSS');
	}

	if ($binaryheadercleanup['passivejs']) {
		wp_deregister_script('l10n');
	}



}

function headerCleanupKillCommentsRSS( $for_comments ) {
    return;
}


function headerCleanupKillCommentsStyle() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

add_action('admin_menu', 'headerCleanupMenu');

function headerCleanupMenu() {
	add_submenu_page('options-general.php', 'Head Cleanup', 'Head Cleanup', 'manage_options', 'binaryheadercleanup', 'binaryHeaderAdminPage');
}

function binaryHeaderAdminPage () {

	if ($_POST['update']) {
		update_option('binaryheadercleanup', $_POST['binaryheadercleanup']);
		echo '<p class="updated">Your head options have been saved. Please review your site to confirm everything is working as expected.</p>';
	}

	$binaryheadercleanup = get_option('binaryheadercleanup');
	
?>
<div class="wrap">
	<h2>Head Cleanup</h2>

	<p>Select the options you want to <strong>remove</strong> from your site's head area.</p>

	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="binaryheadercleanup" />

		<table class="form-table">
			<tr valign="top">
				<th scope="row">Passive Localization JavaScript</th>
				<td><input type="checkbox" name="binaryheadercleanup[passivejs]" value="1" <?php if ($binaryheadercleanup['passivejs']) echo 'checked="checked"'; ?>/></td>
			<tr valign="top">
				<th scope="row">RSD Link</th>
				<td><input type="checkbox" name="binaryheadercleanup[rsdlink]" value="1" <?php if ($binaryheadercleanup['rsdlink']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Comments RSS</th>
				<td><input type="checkbox" name="binaryheadercleanup[commentsrss]" value="1" <?php if ($binaryheadercleanup['commentsrss']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">WordPress Version</th>
				<td><input type="checkbox" name="binaryheadercleanup[wpgenerator]" value="1" <?php if ($binaryheadercleanup['wpgenerator']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Feed Links</th>
				<td><input type="checkbox" name="binaryheadercleanup[feedlinks]" value="1" <?php if ($binaryheadercleanup['feedlinks']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Index Rel</th>
				<td><input type="checkbox" name="binaryheadercleanup[indexrel]" value="1" <?php if ($binaryheadercleanup['indexrel']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">WLW Manifest</th>
				<td><input type="checkbox" name="binaryheadercleanup[wlwmanifest]" value="1" <?php if ($binaryheadercleanup['wlwmanifest']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Extra Feed Links</th>
				<td><input type="checkbox" name="binaryheadercleanup[feedlinksextra]" value="1" <?php if ($binaryheadercleanup['feedlinksextra']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Start Post Rel</th>
				<td><input type="checkbox" name="binaryheadercleanup[startpostrellink]" value="1" <?php if ($binaryheadercleanup['startpostrellink']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Parent Post Rel</th>
				<td><input type="checkbox" name="binaryheadercleanup[parentpostrellink]" value="1" <?php if ($binaryheadercleanup['parentpostrellink']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Adjacent Post Rel</th>
				<td><input type="checkbox" name="binaryheadercleanup[adjacentpostsrellink]" value="1" <?php if ($binaryheadercleanup['adjacentpostsrellink']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Canonical *</th>
				<td><input type="checkbox" name="binaryheadercleanup[relcanonical]" value="1" <?php if ($binaryheadercleanup['relcanonical']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Robots Index/Noindex *</th>
				<td><input type="checkbox" name="binaryheadercleanup[noindex]" value="1" <?php if ($binaryheadercleanup['noindex']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Recent Comments CSS</th>
				<td><input type="checkbox" name="binaryheadercleanup[recentcommentsstyle]" value="1" <?php if ($binaryheadercleanup['recentcommentsstyle']) echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr valign="top">
				<th scope="row">Shortlink</th>
				<td><input type="checkbox" name="binaryheadercleanup[shortlink]" value="1" <?php if ($binaryheadercleanup['shortlink']) echo 'checked="checked"'; ?>/></td>
			</tr>
		</table>

		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>

	</form>

	<p><em>* You might want to keep this. We included the option just to give you more control over your site.</em></p>

</div>
<?php
}

// do you like dagz?
// ohhhhh, daaawwwwwgs!
// 01101101

?>
