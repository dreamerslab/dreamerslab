<?php
/*
Plugin Name: Stealth Login
Plugin URI: http://www.skullbit.com/
Description: Create custom URL's for logging in, logging out and registering for your WordPress blog.
Author: skullbit, devbit
Version: 1.3
Author URI: http://www.skullbit.com
*/

/* CHANGELOG 
03-04-2009 - v1.3
	* Added compatibility fix with WordPress installations in a directory like www.blog.com/wordpress/
	* Added ability to disable plugin
	* Added ability to attempt to change .htaccess permissions to make writeable
	* Added wp-admin slug option (can't login with it yet though)
	* htaccess Output rules will always show even if htaccess is not writeable
	* added ability to create custom htaccess rules

29-03-2008 - v1.2
	* Added Register slug option so you can still allow registrations with the stealth-login. (If registration is not allowed, this option will not be available.)
	* Stealth Key now seperate for each slug so that those registering cannot reuse the key for use on login or logout

28-03-2008 - v1.1
	* Added better rewrite rules for a stealthier login system.
	* Removed wp-login.php refresh redirect in favor of using rewrite rules for prevention of direct access to the file.
	* Added Stealth Key for added security - key is random and changes on every settings update.
*/
include_once(ABSPATH.'wp-admin/admin-functions.php');

if( !class_exists( 'StealthLoginPlugin' ) ){
	class StealthLoginPlugin{
		function StealthLoginPlugin(){ //Constructor			
			add_action( 'admin_menu', array($this,'AddPanel') );
			if( $_POST['action'] == 'stealth_login_update' )
				add_action( 'init', array($this,'SaveSettings') );
				
			add_filter( 'mod_rewrite_rules', array($this, 'AddRewriteRules'), 999 );
			
			register_activation_hook( __FILE__, array($this, "DefaultSettings") );
			register_deactivation_hook( __FILE__, array($this, "UnsetSettings") );
			
		}
		function AddPanel(){
			add_options_page( 'Stealth Login', 'Stealth Login', 10, __FILE__, array($this, 'StealthSettings') );
		}
		function DefaultSettings () {
			 if( !get_option("stealth_enable") )
			  	add_option("stealth_enable","0");
				
			 if( !get_option("stealth_login_slug") )
			  	add_option("stealth_login_slug","login");
			
			if( !get_option("stealth_admin_slug") )
			  	add_option("stealth_admin_slug","admin");
				
			 if( !get_option("stealth_login_redirect") )
			  	add_option("stealth_login_redirect", get_option('siteurl').'/wp-admin/');
				
			 if( !get_option("stealth_logout_slug") )
			  	add_option("stealth_logout_slug", "logout");
				
			 if( !get_option("stealth_login_custom") )
			  	add_option("stealth_login_custom", "");
			 
			 if( !get_option("stealth_register_slug") )
			  	add_option("stealth_register_slug","register");
			
			 if( !get_option("stealth_mode") )
			  	add_option("stealth_mode", "0");
			
			 if( get_option("stealth_key") )
			 	delete_option("stealth_key");
				
			save_mod_rewrite_rules();
		}
		function UnsetSettings () {
			  delete_option("stealth_enable");
			  delete_option("stealth_login_slug");
			  delete_option("stealth_login_redirect");
			  delete_option("stealth_logout_slug");
			  delete_option("stealth_admin_slug");
			  delete_option("stealth_login_custom");
			  delete_option("stealth_register_slug");
			  delete_option("stealth_mode");
			  delete_option("stealth_htaccess");
			  delete_option("stealth_custom_rules");
			  save_mod_rewrite_rules();
			  delete_option("stealth_htaccess");
		}
		function SaveSettings(){			
			check_admin_referer('stealth-login-update-options');
			update_option("stealth_enable", $_POST['stealth_enable']);
			update_option("stealth_login_slug", $_POST['stealth_login_slug']);
			update_option("stealth_login_redirect", $_POST['stealth_login_redirect']);
			update_option("stealth_logout_slug", $_POST['stealth_logout_slug']);
			update_option("stealth_admin_slug", $_POST['stealth_admin_slug']);
			update_option("stealth_login_custom", $_POST['stealth_login_custom']);
			update_option("stealth_register_slug", $_POST['stealth_register_slug']);
			update_option("stealth_custom_rules", $_POST['stealth_custom_rules']);
			update_option("stealth_mode", $_POST['stealth_mode']);
			$htaccess = trailingslashit(ABSPATH).'.htaccess';
			$this->CreateRewriteRules();
			if( $_POST['stealth_enable'] == 0 ):
				save_mod_rewrite_rules();
				$_POST['notice'] = __('Settings saved. Plugin is disabled.','stealthlogin');
			elseif( save_mod_rewrite_rules() ):
				$_POST['notice'] = __('Settings saved and .htaccess file updated.','stealthlogin');
			elseif( chmod($htaccess,0644) ):
				if( save_mod_rewrite_rules() ){
					$_POST['notice'] = __('Settings saved and .htaccess file now writeable and updated.','stealthlogin');
				}else{
					$_POST['notice'] = __('Settings saved but .htaccess file could not be updated.'.$htaccess,'stealthlogin');
				}
			else :
				$_POST['notice'] = __('Settings saved but .htaccess file is not writeable.'.$htaccess,'stealthlogin');
			endif;
				
		}	
		
		function StealthSettings(){
			
			if( $_POST['notice'] )
				echo '<div id="message" class="updated fade"><p><strong>' . $_POST['notice'] . '</strong></p></div>';
			?>
            <div class="wrap">
            	<h2><?php _e('Stealth Login Settings', 'stealthlogin')?></h2>
                <form method="post" action="">
                	<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field( 'stealth-login-update-options'); ?>
                    <table class="form-table">
                        <tbody>
                        	<tr valign="top">
                       			 <th scope="row"><label for="enable"><?php _e('Enable Plugin', 'stealthlogin');?></label></th>
                        		<td><label><input name="stealth_enable" id="enable" value="1" <?php if(get_option('stealth_enable') == 1) echo 'checked="checked"';?> type="radio" /> On</label> &nbsp;&nbsp;<label><input name="stealth_enable" value="0" <?php if(get_option('stealth_enable') == 0) echo 'checked="checked"';?> type="radio" /> Off</label></td>
                        	</tr>
                            <tr valign="top">
                       			 <th scope="row"><label for="login_slug"><?php _e('Login Slug', 'stealthlogin');?></label></th>
                        		<td><input name="stealth_login_slug" id="login_slug" value="<?php echo get_option('stealth_login_slug');?>" type="text"><br />
                                <strong style="color:#777;font-size:12px;">Login URL:</strong> <span style="font-size:0.9em;color:#999999;"><?php echo trailingslashit( get_option('siteurl') ); ?><span style="background-color: #fffbcc;"><?php echo get_option('stealth_login_slug');?></span></span></td>
                        	</tr>
                            <tr valign="top">
                            	<th scope="row"><label for="login_redirect"><?php _e('Login Redirect', 'stealthlogin');?></label></th> 
                                <td><select name="stealth_login_redirect" id="login_redirect">
                                		<option value="<?php echo get_option('siteurl');?>/wp-admin/" <?php if(get_option('stealth_login_redirect') == get_option('siteurl').'/wp-admin/'){echo 'selected="selected"';} ?>">WordPress Admin</option>
                                		<option value="<?php echo get_option('siteurl');?>/wp-login.php?redirect_to=<?php echo get_option('siteurl');?>" <?php if(get_option('stealth_login_redirect') == get_option('siteurl').'/wp-login.php?redirect_to='.get_option('siteurl')){echo 'selected="selected"';} ?>">WordPress Address</option>
										<option value="<?php echo get_option('siteurl');?>/wp-login.php?redirect_to=<?php echo get_option('home');?>" <?php if(get_option('stealth_login_redirect') == get_option('siteurl').'/wp-login.php?redirect_to='.get_option('home')){echo 'selected="selected"';} ?>">Blog Address </option>
										<option value="Custom" <?php if(get_option('stealth_login_redirect') == "Custom"){echo 'selected="selected"';} ?>">Custom URL (Enter Below)</option>
                                	</select><br />
								<input type="text" name="login_custom" size="40" value="<?php echo get_option('stealth_login_custom');?>" /><br />
								<strong style="color:#777;font-size:12px;">Redirect URL:</strong> <span style="font-size:0.9em;color:#999999;"><?php if( get_option('stealth_login_redirect') != 'Custom' ) { echo get_option('stealth_login_redirect'); } else { echo get_option('stealth_login_custom'); } ?></span></td>
                            </tr>
                            <tr valign="top">
                            	<th scope="row"><label for="logout_slug"><?php _e('Logout Slug', 'stealthlogin');?></label></th>
                                <td><input type="text" name="stealth_logout_slug" id="logout_slug" value="<?php echo get_option('stealth_logout_slug');?>" /><br />
                                <strong style="color:#777;font-size:12px;">Logout URL:</strong> <span style="font-size:0.9em;color:#999999;"><?php echo trailingslashit( get_option('siteurl') ); ?><span style="background-color: #fffbcc;"><?php echo get_option('stealth_logout_slug');?></span></span></td>
                            </tr>
                         <?php if( get_option('users_can_register') ){ ?>
                            <tr valign="top">
                            	<th scope="row"><label for="register_slug"><?php _e('Register Slug', 'stealthlogin');?></label></th>
                                <td><input type="text" name="stealth_register_slug" id="register_slug" value="<?php echo get_option('stealth_register_slug');?>" /><br />
                                <strong style="color:#777;font-size:12px;">Register URL:</strong> <span style="font-size:0.9em;color:#999999;"><?php echo trailingslashit( get_option('siteurl') ); ?><span style="background-color: #fffbcc;"><?php echo get_option('stealth_register_slug');?></span></span></td>
                            </tr>
                          <?php } ?>
                          <tr valign="top">
                       			 <th scope="row"><label for="admin_slug"><?php _e('Admin Slug', 'stealthlogin');?></label></th>
                        		<td><input name="stealth_admin_slug" id="admin_slug" value="<?php echo get_option('stealth_admin_slug');?>" type="text"><br />
                                <strong style="color:#777;font-size:12px;">Admin URL:</strong> <span style="font-size:0.9em;color:#999999;"><?php echo trailingslashit( get_option('siteurl') ); ?><span style="background-color: #fffbcc;"><?php echo get_option('stealth_admin_slug');?></span></span></td>
                        	</tr>
                          <tr valign="top">
                            	<th scope="row"><label for="custom_rules"><?php _e('Custom Rules', 'stealthlogin');?></label></th>
                                <td><textarea name="stealth_custom_rules" id="custom_rules" rows="5" cols="50"><?php echo get_option('stealth_custom_rules');?></textarea><br /><span style="font-size:0.9em;color:#999999;">Add at your own risk, will appear just above # END STEALTH-LOGIN</span></td>
                            </tr>
                            <tr valign="top">
                            	<th scope="row"><?php _e('Stealth Mode', 'stealthlogin'); ?></th>
                                <td><label><input type="radio" name="stealth_mode" value="1" <?php if(get_option('stealth_mode') ) echo 'checked="checked" ';?> /> Enable</label><br />
                                	<label><input type="radio" name="stealth_mode" value="0" <?php if(!get_option('stealth_mode') ) echo 'checked="checked" ';?>/> Disable</label><br />
                                    <small><?php _e('Prevent users from being able to access wp-login.php directly','stealthlogin');?></small></td>
                            </tr>
                            <tr valign="top">
                            <th scope="row"><?php _e('.htaccess Output', 'stealthlogin');?></th>
                            <td><pre><?php echo get_option('stealth_htaccess');?></pre></td>
                            </tr>
                    	</tbody>
                 	</table>
                    <p class="submit"><input name="Submit" value="<?php _e('Save Changes','stealthlogin');?>" type="submit" />
                    <input name="action" value="stealth_login_update" type="hidden" />
                </form>
              
            </div>
           <?php
		}
		
		function CreateRewriteRules(){
			$logout_uri = str_replace(trailingslashit(get_option('siteurl')), '', wp_logout_url());
			$siteurl = explode('/',trailingslashit(get_option('siteurl')));
			unset($siteurl[0]); unset($siteurl[1]); unset($siteurl[2]);
			$dir = implode('/',$siteurl);
			
			if(get_option('stealth_login_slug')){
			
				if(get_option('stealth_login_redirect') != "Custom"){
					$login_url = get_option('stealth_login_redirect');
				}else{
					$login_url = get_option('stealth_login_custom');
				}
				$login_slug = get_option('stealth_login_slug');
				$logout_slug = get_option('stealth_logout_slug');
				$admin_slug = get_option('stealth_admin_slug');
				
				$login_key = $this->Key();
				$logout_key = $this->Key();
				$register_key = $this->Key();
				$admin_key = $this->Key();
				
				if( get_option('users_can_register') ){
					$register_slug = get_option( 'stealth_register_slug' );
					$reg_rule_stealth = "RewriteRule ^" . $register_slug . " ".$dir."wp-login.php?stealth_reg_key=" . $register_key . "&action=register [R,L]\n" ;//Redirect Register slug to registration page with stealth_key
					$reg_rule = "RewriteRule ^" . $register_slug . " ".$dir."wp-login.php?action=register [L]\n" ;//Redirect Register slug to registration page
				}
				
				if( get_option( 'stealth_mode' ) ){
					$insert = "# STEALTH-LOGIN \n" .
							   "RewriteRule ^" . $logout_slug . " ".$logout_uri."&stealth_out_key=" . $logout_key . " [L]\n" . //Redirect Logout slug to logout with stealth_key
							  "RewriteRule ^" . $login_slug . " wp-login.php?stealth_in_key=" . $login_key . "&redirect_to=" . $login_url . " [R,L]\n" . 	//Redirect Login slug to show wp-login.php with stealth_key
							  "RewriteRule ^" . $admin_slug . " wp-admin/?stealth_admin_key=" . $admin_key . " [R,L]\n" . 	//Redirect Admin slug to show Dashboard with stealth_key
							  $reg_rule_stealth .
							 
							  "RewriteCond %{HTTP_REFERER} !^" . get_option('siteurl') . "/wp-admin \n" . //if did not come from WP Admin
							  "RewriteCond %{HTTP_REFERER} !^" . get_option('siteurl') . "/wp-login\.php \n" . //if did not come from wp-login.php
							  "RewriteCond %{HTTP_REFERER} !^" . get_option('siteurl') . "/" . $login_slug . " \n" . //if did not come from Login slug
							  "RewriteCond %{HTTP_REFERER} !^" . get_option('siteurl') . "/" . $admin_slug . " \n" . //if did not come from Admin slug
							  "RewriteCond %{QUERY_STRING} !^stealth_in_key=" . $login_key . " \n" . //if no stealth_key query
							  "RewriteCond %{QUERY_STRING} !^stealth_out_key=" . $logout_key . " \n" . //if no stealth_key query
							  "RewriteCond %{QUERY_STRING} !^stealth_reg_key=" . $register_key . " \n" . //if no stealth_key query
							  "RewriteCond %{QUERY_STRING} !^stealth_admin_key=" . $admin_key . " \n" . //if no stealth_key query
							  "RewriteRule ^wp-login\.php " . get_option('siteurl') . " [L]\n" . //Send to home page
							  "RewriteCond %{QUERY_STRING} ^loggedout=true \n" . // if logout confirm query is true
							  "RewriteRule ^wp-login\.php " . get_option('siteurl') . " [L]\n" . //Send to home page
							  get_option('stealth_custom_rules')." \n".
							  "# END STEALTH-LOGIN\n";
				}else{
					$insert = "# STEALTH-LOGIN\n" .
							  "RewriteRule ^" . $logout_slug . " ".$dir.$logout_uri." [L]\n" . //Redirect Logout slug to logout
							  "RewriteRule ^" . $admin_slug . " ".$dir."wp-admin/ [R,L]\n" . 	//Redirect Admin slug to show Dashboard with stealth_key
							  "RewriteRule ^" . $login_slug . " ".$dir."wp-login.php?&redirect_to=" . $login_url . " [R,L]\n" . 	//Redirect Login slug to show wp-login.php
							  $reg_rule .
							  get_option('stealth_custom_rules')." \n".
							  "# END STEALTH-LOGIN\n" ;
					
				}
				
			}
			$sample = str_replace('<', '&lt;', $insert);
			$sample = str_replace('>', '&gt;', $sample);
			update_option('stealth_htaccess', $sample);
			
			return $insert;
		}
		
		function AddRewriteRules($rewrite){
			global $wp_version;
			
			if( get_option('stealth_enable') == 1 ):
				$insert = $this->CreateRewriteRules();
				$lines = explode('RewriteCond %{REQUEST_FILENAME} !-f', $rewrite);
				$fn = "RewriteCond %{REQUEST_FILENAME} !-f";
				$rewrite = $lines[0] . $insert . $fn . $lines[1];
			endif;
		
			return $rewrite;
		}	
		
		function Key() {	
			$chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '' ;		
			while ($i <= 25) {
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
			}
			return $pass;	
		}
		
	}
} // END Class StealthLoginPlugin

if( class_exists( 'StealthLoginPlugin' ) ){
	$stealthlogin = new StealthLoginPlugin();
}
?>