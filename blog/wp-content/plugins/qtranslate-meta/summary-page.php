<div class="wrap">
<h2><?php _e('Multilingual META Summary Page', 'qtranslate-meta'); ?></h2>
<!--div class="below-h2"><p>
	<?php _e('This table shows the META tags in each language set for each page in the site.', 'qtranslate-meta'); ?><br/>
	<?php _e('Hover the cursor over the flags to view the actual content.', 'qtranslate-meta'); ?>
</p></div-->

<?php
global $qtransMETA;
global $q_config;

//Get languages
$languages = qtrans_getSortedLanguages();

//Check for & set view
if (isset($_REQUEST['qtm_view'])) $_SESSION['qtm_view'] = filter_var($_REQUEST['qtm_view'], FILTER_SANITIZE_STRING);
$_view = $_SESSION['qtm_view'] ? $_SESSION['qtm_view'] : 'flags';

//Check for & set lang
if (isset($_REQUEST['qtm_lang'])) $_SESSION['qtm_lang'] = filter_var($_REQUEST['qtm_lang'], FILTER_SANITIZE_STRING);
$_lang = $_SESSION['qtm_lang'] ? $_SESSION['qtm_lang'] : qtrans_getLanguage();

?>

<form method="post" action="">
<div class="tablenav">
	<div class="alignleft actions">	
		<?php _e('View', 'qtranslate-meta'); ?>:
		<select name="qtm_view" onchange="this.form.submit()">
			<option value="flags" <?php if ($_view=='flags') echo 'selected="selected"' ?>><?php _e('Flags', 'qtranslate-meta'); ?>&nbsp;</option>
			<option value="text" <?php if ($_view=='text') echo 'selected="selected"' ?>><?php _e('Text', 'qtranslate-meta'); ?>&nbsp;</option>
		</select>
		
		<select name="qtm_lang" onchange="this.form.submit()">
		<?php
			foreach($languages as $lang) {
				$style = "style=\"padding-left:24px; background: url('".WP_PLUGIN_URL.'/qtranslate/flags/'.$q_config['flag'][$lang]."') no-repeat scroll 2px 3px transparent; \"";
				$selected = ($_lang == $lang) ? 'selected="selected"' : '';
				echo "<option value=\"$lang\" $selected $style>".qtrans_getLanguageName($lang).'</option>';
			}
		?>
		</select>
		
		<?php
			$excel_url = WP_PLUGIN_URL.'/qtranslate-meta/download.php?qtm_format=excel&qtm_lang='.$_lang;
		?>
		<input type="button" value="<?php _e('Download as Excel Spreadsheet', 'qtranslate-meta'); ?>" class="button-primary" onclick="window.location='<?php echo $excel_url ?>'" />
	</div>
</div>
</form>

<table class="widefat qtrans_meta_summary">
	<thead>
	<tr>
		<th><?php _e('Post Title', 'qtranslate-meta'); ?> (<?php echo qtrans_getLanguageName($_lang); ?>)</th>
		<?php foreach ($qtransMETA->field_names as $field => $field_label) echo '<th>'.esc_html($field_label).'</th>'; ?>
	</tr>
	</thead>
	<tfoot>
	<tr>
		<th><?php _e('Post Title', 'qtranslate-meta'); ?> (<?php echo qtrans_getLanguageName($_lang); ?>)</th>
		<?php foreach ($qtransMETA->field_names as $field => $field_label) echo '<th>'.esc_html($field_label).'</th>'; ?>
	</tr>
	</tfoot>

<?php
$pages = $qtransMETA->get_post_meta('page');
foreach ($pages as $post): ?>
	<tr>
	<td class="page-name">
		<a title="<?php _e('Edit Page', 'qtranslate-meta') ?>" href="<?php bloginfo('wpurl') ?>/wp-admin/page.php?action=edit&post=<?php echo $post->ID ?>">
			<?php echo str_repeat('&mdash;', $post->qtm_depth) . '&nbsp;' . qtrans_use($_lang, $post->post_title); ?>
		</a>
	</td>
	<?php
	foreach($qtransMETA->field_names as $field => $field_label) {
		echo '<td>';
		switch ($_view) {
			case 'flags':
				foreach (qtrans_split(get_post_meta( $post->ID, "qtrans_meta:{$field}", true )) as $lang=>$f) {
					$class = ($f) ? 'present' : 'not-present';
					$title = ($f) ? $f : '(empty)';
					echo '<img src="'.WP_PLUGIN_URL.'/qtranslate/flags/'.$q_config['flag'][$lang].'" alt="'.strtoupper($lang).'" class="'.$class.'" title="'.$title.'" /> ';
				}
				break;
			case 'text':
				echo qtrans_use($_lang, get_post_meta( $post->ID, "qtrans_meta:{$field}", true ));
				break;
		}
		echo '</td>';
	}
	echo '</tr>';
endforeach;
?>

</table>

</div>
