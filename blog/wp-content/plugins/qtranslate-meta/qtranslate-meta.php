<?php
/*
Plugin Name: qTranslate META
Plugin URI: http://johnjcamilleri.com/2010/01/qtranslate-and-multilingual-meta-tags/
Description: Multilingual support for META tags. Requires qTranslate.
Version: 1.0.2
Author: John J. Camilleri
Author URI: http://johnjcamilleri.com
*/

//===============================================

// Class definition
class qTranslateMETAPlugin {

	/* Some declarations */
	var $field_names; //Set hook_init in below
	
	/* Constructor */
	function __construct() {
		//Register hooks
		register_activation_hook(__FILE__, array(&$this, 'hook_activation'));
		add_action('init', array(&$this, 'hook_init'));
		add_action('admin_menu', array(&$this, 'hook_admin_menu'));
		add_action('save_post', array(&$this, 'hook_save_post'));
		
		//Hooks defined in config
		add_action('wp_head', array(&$this, 'hook_head'));

		// Get title hook from options, or default to wp_title
		$title_hook = get_option('qtrans_meta_title_hook');
		if (!$title_hook) $title_hook = "single_post_title"; // wp_title
		add_filter($title_hook, array(&$this, 'hook_title'));
	}	

	/* Activate function */
	function hook_activation() {
		//Check for qtranslate
		if (!function_exists('qtrans_getSortedLanguages')) {
			throw new Exception(__('This plugin requires qTranslate to be installed and activated.', 'qtranslate-meta'));
		}
	}

	//===============================================
	
	/* Init Hook */
	function hook_init() {
		
		//Add styles
		if (is_admin()) wp_enqueue_style('qtrans-meta-plugin', WP_PLUGIN_URL . '/qtranslate-meta/styles.css');
		
		//Add translation
		load_plugin_textdomain('qtranslate-meta', false, 'qtranslate-meta/lang');
		
		//Fields initialization
		$this->field_names = array(
		  'title'       => __('Browser Title', 'qtranslate-meta'),
		  'keywords'    => __('Keywords', 'qtranslate-meta'),
		  'description' => __('Description', 'qtranslate-meta'),
		);
	}

	/* Add menu page */
	function hook_admin_menu() {

		//Add menu page for SEO summary
		$page = add_submenu_page(
			'edit-pages.php', //parent
			'META Summary', //page title
			'META Summary', //menu title,
			'edit_post', //access_level/capability (tried setting as 'edit_post', would mess up edit page)
			dirname(__FILE__) . '/summary-page.php' //menu_slug
		);
		
		//Add settings page
		$page = add_submenu_page(
			'options-general.php', //parent
			'qTranslate META', //page title
			'qTranslate META', //menu title,
			'edit_plugins', //access_level/capability
			dirname(__FILE__) . '/settings-page.php' //menu_slug
		);
		
		//Add META box (for both pages and posts)
		add_meta_box(
			'qtrans_meta_meta_box', //HTML id
			__('Multilingual META', 'qtranslate-meta'), //title
			array(&$this, 'meta_box_generate'), //callback
			'page', //type
			'normal', //context - normal, advanced, side
			'high' //priority - high, low
		);
		add_meta_box(
			'qtrans_meta_meta_box', //HTML id
			__('Multilingual META', 'qtranslate-meta'), //title
			array(&$this, 'meta_box_generate'), //callback
			'post', //type
			'normal', //context - normal, advanced, side
			'high' //priority - high, low
		);
	}
	
	/* Load & split META tags */
	function load_meta($post_id) {
		$meta = array();
		foreach($this->field_names as $field => $field_label) {
			$field_id = "qtrans_meta:{$field}";
			$field_data = get_post_meta( $post_id, $field_id, true );
			$meta[$field] = qtrans_split( $field_data );
		}
		return $meta;
	}
	
	/* Filter which runs to save META details as post meta fields on page save */
	function hook_save_post($post_id) {
		// Fix bug when auto-saving revisions
		// Since 0.8, thanks to Benoit Gauthier
		$revision_id = wp_is_post_revision($post_id);
		if ($revision_id !== false && $revision_id !== $post_id )
			return;
	
		//Iterate over field names and languages and copile into array
		$languages = qtrans_getSortedLanguages();
		$meta = array();
		foreach($languages as $lang) {
			foreach($this->field_names as $field => $field_label) {
				//Get field data
				$field_id = "qtrans_meta_{$field}_{$lang}";
				$field_data = trim(str_replace('"', '', $_POST[$field_id]));
				$meta[$field][$lang] = $field_data;
			} //end of iterating over field names
		} //end of iterating over langauges
		
		// Join and save
		foreach($meta as $field=>$data) {
			$field_id = "qtrans_meta:{$field}";
			$field_data =  qtrans_join( $data );
			update_post_meta( $post_id, $field_id, $field_data );
		}
	}

	/* Filter which runs to update any over-ridden titles */
	function hook_title($title) {
		global $post;
		
		//See if post has an alternate title in current language
		$lang = qtrans_getLanguage();
		$meta = $this->load_meta($post->ID);
		
		//Override title?
		$new_title = ($meta['title'][$lang]) ? $meta['title'][$lang] : $title;
			
		//Add suffix?
		if ($title_suffix = get_option('qtrans_meta_title_suffix'))
			$new_title .= ' '.$title_suffix;
			
		//Return it
		return $new_title;
	}
	
	/* Action which runs dump the localised META tags */
	function hook_head() {
		if (!(is_single() || is_page())) return;
		global $post;
		$lang = qtrans_getLanguage();
		$meta = $this->load_meta($post->ID);
		foreach($meta as $field=>$all_data) {
			if ($field == 'title') {
				continue;
			}
			elseif ($data = $all_data[$lang]) {
				echo "<meta name=\"{$field}\" content=\"{$data}\" />\n";
			}
		}
	}
	
	/* Callback function for creating meta box */
	function meta_box_generate() {
		global $q_config, $post;
		$languages = qtrans_getSortedLanguages();
		$meta = $this->load_meta($post->ID);
		?>
		<script type="text/javascript">
		//<![CDATA[
			function qtrans_meta_switch_lang(lang) {
				//Hide all
				<?php foreach($languages as $lang): echo "jQuery('#qtrans_meta_language_{$lang}').hide();"; endforeach; ?>
				
				//Show selected, recount chars
				jQuery('#qtrans_meta_language_'+lang).show();
				qtrans_meta_count_chars(lang);
			}
			
			//Count chars & paste into respective box
			function qtrans_meta_count_chars(lang) {
				var chars = jQuery('#qtrans_meta_description_'+lang).val().length;
				jQuery('#qtrans_meta_description-length_'+lang).val(chars);
			}
		//]]>
		</script>
		<div class="qtrans_meta_language-switcher">
		<?php
		echo "&nbsp;|&nbsp;";
		foreach($languages as $lang) {
			echo "<a href=\"javascript:qtrans_meta_switch_lang('$lang')\" title=\"".qtrans_getLanguageName($lang)."\">".qtrans_getLanguageName($lang)."</a>&nbsp|&nbsp;";
		}
		?>
		</div>
		
		<?php foreach($languages as $lang): ?>
		<table id="qtrans_meta_language_<?php echo $lang ?>" class="qtrans_meta_table" style="display:none;">
			<tr><td colspan="2" class="heading">
				<img src="<?php echo WP_PLUGIN_URL ?>/qtranslate/flags/<?php echo $q_config['flag'][$lang] ?>" alt=""/>
				<strong><?php echo qtrans_getLanguageName($lang) ?></strong>
			</td></tr>
			<tr>
				<th><label for="qtrans_meta_title_<?php echo $lang ?>"><?php _e('Browser Title', 'qtranslate-meta'); ?>:</label> </th>
				<td><input type="text" name="qtrans_meta_title_<?php echo $lang ?>" id="qtrans_meta_title_<?php echo $lang ?>" value="<?php echo $meta['title'][$lang] ?>" style="width:50%;" /></td>
			</tr>
			<tr>
				<th><label for="qtrans_meta_keywords_<?php echo $lang ?>"><?php _e('Keywords', 'qtranslate-meta'); ?>:</label> </th>
				<td><input type="text" name="qtrans_meta_keywords_<?php echo $lang ?>" id="qtrans_meta_keywords_<?php echo $lang ?>" value="<?php echo $meta['keywords'][$lang] ?>" style="width:100%;" /></td>
			</tr>
			<tr>
				<th><label for="qtrans_meta_description_<?php echo $lang ?>"><?php _e('Description', 'qtranslate-meta'); ?>:</label> </th>
				<td>
					<textarea name="qtrans_meta_description_<?php echo $lang ?>" id="qtrans_meta_description_<?php echo $lang ?>" style="width:100%;" rows="3" onkeyup="qtrans_meta_count_chars('<?php echo $lang ?>')" onkeydown="qtrans_meta_count_chars('<?php echo $lang ?>')"><?php echo $meta['description'][$lang] ?></textarea>
					<br/>
					<input type="text" maxlength="3" size="3" id="qtrans_meta_description-length_<?php echo $lang ?>" readonly="readonly"/>
					<?php _e('characters. Most search engines use a maximum of 160 chars for the description.', 'qtranslate-meta'); ?>
				</td>
			</tr>
		</table>
		<?php endforeach; ?>
		
		<script type="text/javascript">
		//<![CDATA[
			qtrans_meta_switch_lang('<?php echo $q_config['default_language'] ?>');
		//]]>
		</script>
		
		<?php
	}
	
	/* Get all post/page meta */
	function get_post_meta($post_type) {
		//Sort out the args
		$post_type = ($post_type == 'page') ? 'page' : 'post';
	
		//Function to get POSTS
		function qtm_get_posts(&$post_array) {
			//Get posts
			$post_array = get_posts(array(
				'post_parent' => $parent_id,
				'post_type' => 'post',
				'numberposts' => -1,
				'post_status' => '', //all statuses
				'orderby' => 'parent menu_order',
				'order' => 'ASC',
			));
		}
		
		//Recursive function to get hierarchical PAGES
		function qtm_get_pages_hierarchical(&$page_array, $parent_id, $depth=0) {
			//Get pages at this level
			$posts = get_posts(array(
				'post_parent' => $parent_id,
				'post_type' => 'page',
				'numberposts' => -1,
				'post_status' => '', //all statuses
				'orderby' => 'parent menu_order',
				'order' => 'ASC',
			));
			
			//For each page, add to page array and recurse into children
			foreach ($posts as $post) {
				$post->qtm_depth = $depth;
				$page_array[] = $post;
				qtm_get_pages_hierarchical($page_array, $post->ID, $depth+1);
			}
		}
		
		$posts = array();
		switch ($post_type) {
			case 'page':
				//Start the recursion
				qtm_get_pages_hierarchical($posts, 0);
				break;
			case 'post':
				//Get all posts
				qtm_get_posts($posts);
				break;
		}
		return $posts;
		
	}


} //end of class
//===============================================

$qtransMETA = null;
add_action('plugins_loaded', create_function('', '
if (function_exists("qtrans_getSortedLanguages")):
	global $qtransMETA;
	$qtransMETA = new qTranslateMETAPlugin();
endif;
'));

//===============================================
?>