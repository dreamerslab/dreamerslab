<div class="wrap">
<h2><?php _e('qTranslate META Plugin &mdash; Settings', 'qtranslate-meta'); ?></h2>

<?php
//Is there some postback info?
if ($_REQUEST['qtrans_meta_convert']) {
	global $qtransMETA;
	$qtransMETA->convert_posts();
	echo '<div class="updated below-h2"><p>' . __('Posts converted', 'qtranslate-meta') . '</p></div>';
}
?>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

	<h3 style="margin-bottom:0;"><?php _e('Browser title', 'qtranslate-meta'); ?></h3>
	<table class="form-table">
		<tr valign="top">
		<th scope="row"><?php _e('Title suffix', 'qtranslate-meta'); ?></th>
		<td>
			<input type="text" name="qtrans_meta_title_suffix" value="<?php echo get_option('qtrans_meta_title_suffix'); ?>" size="50" /><br/>
			<em><?php _e('Appended to every page browser title' , 'qtranslate-meta'); ?></em>
		</td>
		</tr>
		<tr valign="top">
		<th scope="row"><?php _e('Title hook', 'qtranslate-meta'); ?></th>
		<td>
			<input type="text" name="qtrans_meta_title_hook" value="<?php echo get_option('qtrans_meta_title_hook'); ?>" size="50" /><br/>
			<em><?php printf(__('Default: %s.' , 'qtranslate-meta'), '<code>single_post_title</code>'); ?></em>
			<em><?php printf(__('You may need to use %s if you have a static front page.' , 'qtranslate-meta'), '<code>wp_title</code>'); ?></em>
		</td>
		</tr>
	</table>
		 
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="qtrans_meta_title_suffix,qtrans_meta_title_hook" />

	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'qtranslate-meta'); ?>" />
	</p>

</form>
</div>
