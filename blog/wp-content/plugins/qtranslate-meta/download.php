<?php
/* For outputting in Excel format */
// Intensive English	Интенсивный Курс Английского языка на Мальте - just to make sure the file stays unicode...

//Need to load wordpress & get basics
include '../../../wp-load.php';
global $qtransMETA;
global $q_config;
$languages = qtrans_getSortedLanguages();

//Get params
$lang = filter_input(INPUT_GET, 'qtm_lang', FILTER_SANITIZE_STRING);
if (!in_array($lang, $languages)) $lang = qtrans_getLanguage();

$format = filter_input(INPUT_GET, 'qtm_format', FILTER_SANITIZE_STRING);
if (!in_array($format, array('excel','html'))) $format = 'html';

// Response headers
if ($format == 'excel') {
	header('Content-type: application/vnd.ms-excel; charset=utf-8');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Content-Disposition: attachment; filename="META-Summary-'.strtoupper($lang).'.xls"');
}

//Begin table
echo '<table border="1">';

//Column headings
echo '<tr>';
echo '<th>' . __('Post Title', 'qtranslate-meta') . ' (' . qtrans_getLanguageName($lang) . ')' . '</th>';
foreach ($qtransMETA->field_names as $field => $field_label) {
	echo '<th>' . esc_html($field_label) . '</th>';
}
echo '</tr>';

//Posts
$pages = $qtransMETA->get_post_meta('page');
foreach ($pages as $post) {
	echo '<tr>';
	
	//Post Title
	echo '<td>' . __($post->post_title) . '</td>'; //use defult language, NOT language of META info

	//META stuff
	foreach($qtransMETA->field_names as $field => $field_label) {
		echo '<td>' . qtrans_use($lang, get_post_meta( $post->ID, "qtrans_meta:{$field}", true )) . '</td>';
	}
	
	echo '</tr>';
}

//End table
echo '</table>';

?>