<?php
/*
Plugin Name: Better Delete Revision

Plugin URI: http://www.1e2.it/tag/better-delete-revision

Description: Better Delete Revision is based on the old "Delete Revision" plugin
but it is compatible with the latest version of Wordpress (3.x) with improved
features. It not only deletes redundant revisions of posts from your Wordpress
Database, it also deletes other database content related to each revision such
meta information, tags, relationships, and more. Your current published,
scheduled, and draft posts are never touched by this plugin! This plugin can
also perform optimizations on your Wordpress database. With optimization and old
revision removal this plugin will keep your database lighter and smaller
throughout use. Removing old revisions and database optimizations is one of the
best things you can do to your Wordpress blog to keep it running as fast as it
can.

Version: 1.2

Author: Galerio & Urda

Author URI: http://www.1e2.it

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

/*
Changelog

2011-01-25 v1.2 Used the Roles and Capabilities system instead of User Level

2010-10-01  v1.1
            Typo and English Corrections

2010-09-25	v1.0
			First public ver1.0
*/

/* Check if various options exist in the current Wordpress Database */
/*
 * Option to track total revisions removed from the system.
 */
if(!get_option('bdel_revision_no'))
{
    update_option("bdel_revision_no",0);
}

/*
 * Local, translations, this appears to not be used
 * at all throughout the plugin at this time.
 */
$dr_locale = get_locale();
$dr_mofile = dirname(__FILE__) . "/better-delete-revision-$dr_locale.mo";
load_textdomain('better-delete-revision', $dr_mofile);

/*
 * Load required plugin files.
 */
require_once( 'php/functions.php' );
	
/*
 * add_options_page( $page_title, $menu_title, $capability,
 *                   $menu_slug, $function);  
 */
function bdelete_revision_main()
{
    if(function_exists('add_options_page'))
    {
        add_options_page('Better Delete Revision',
                         'Better Delete Revision',
                         'manage_options',
                         basename(__FILE__),
                         'my_options_bdelete_revision');
    }
}

/* Add the above action to the Wordpress Admin Menu */
add_action('admin_menu', 'bdelete_revision_main');

/*
 * 
 */
function my_options_bdelete_revision()
{
    $bdr_version = get_bdr_version();
	$bdel_revision_no = get_option('bdel_revision_no');
	echo <<<EOT
	<div class="wrap">
		<h2>Better Delete Revision Manager <font size=1>Version $bdr_version</font></h2>
		<div class="widget"><p style="margin:10px;">
EOT;
	
	echo get_count_notice();

	echo '</p></div>';

	if (isset($_POST['del_act']))
	{
		bdelete_revision_act();
		$del_no = $_POST['rev_no'];
		update_option("bdel_revision_no",get_option("bdel_revision_no") + $del_no);
		echo '<div class="updated" style="margin-top:50px;"><p><strong>';
		printf(__("Deleted <span style='color:red;font-weight:bolder;'> %s </span> revisions!",'bdelete-revision'),$del_no);	
		echo "</strong></p></div></div><script>
		var del_no = document.getElementById('revs_no').innerHTML;
		document.getElementById('revs_no').innerHTML = Number(del_no)+ $del_no;
		</script>";
	}
	else if (isset($_POST['get_rev']))
	{
		get_my_revision();
	}
	else if (isset($_POST['maintain_mysql']))
	{
		if ($_POST['operation'] == 'OPTIMIZE' )
		{
		    echo maintain_mysql('OPTIMIZE');
		}
		else
		{
		    echo maintain_mysql('CHECK');
		}
	}
	else
	{
		echo '<form method="post" action="">';
		echo '<input class="button" type="submit" name="get_rev" value="';
		_e('Check Revision Posts','bdelete-revision');
		echo '" />  <input class="button" type="submit" name="maintain_mysql" value="';
		_e('Optimize Your Database','bdelete-revision');
		echo '" /></form></div>';

	}
	
	echo get_bdr_footer();
}

/*
 * 
 */
function get_my_revision()
{
	global $wpdb;
	
	$sql = "SELECT `ID`,`post_date`,`post_title`,`post_modified`
			FROM ($wpdb->posts)
			WHERE `post_type` = 'revision'
			ORDER BY `ID` DESC";
	$results = $wpdb -> get_results($sql);
	if($results)
    {
        $res_no = count($results);
        echo "<table class='widefat'><thead>";
        echo "<tr><th width=30> Id </th><th width=450> Title </th><th width=180> Post date </th><th width=180> Last modified </th></tr></thead>";
	
        for($i = 0 ; $i < $res_no ; $i++)
        {
            echo "<tr><td>".$results[$i] -> ID."</td>";
            echo "<td>".$results[$i] -> post_title."</td>";
            echo "<td>".$results[$i] -> post_date."</td>";
            echo "<td>".$results[$i] -> post_modified."</td></tr>";
        }
	
        echo "</table><br />";
        echo "Would you like to remove the revision posts ? <br />";
        echo <<<EOT
		<form method="post" action="">
		<input type="hidden" name="rev_no" value=" $res_no " />
EOT;
		echo '<input class="button-primary" type="submit" name="del_act" value="';
        
		printf(__('Yes , I would like to delete them! (A Total Of %s)','bdelete-revision'),$res_no);
        
		echo '" /><input class="button" type="submit" name="goback" value="';
        
		_e('No , I prefer to keep them!','bdelete-revision');
        
		echo '" /></form></div>';
	}
	else {echo "<div class=\"updated\" style=\"margin:50px 0;padding:6px;line-height:16pt;font-weight:bolder;\">";
	_e('Great! You have no revisions now!','bdelete-revision');
	echo "</div></div>";}
}

/*
 * 
 */
function bdelete_revision_act()
{
	global $wpdb;
	
	$sql = "DELETE a,b,c
            FROM $wpdb->posts a
            LEFT JOIN $wpdb->term_relationships b
            ON (a.ID = b.object_id)
            LEFT JOIN $wpdb->postmeta c
            ON (a.ID = c.post_id)
            WHERE a.post_type = 'revision'";
	$results = $wpdb -> get_results($sql);
}

/*
 * 
 */
function maintain_mysql($operation = "CHECK")
{
		global $wpdb;
       
        $Tables = $wpdb -> get_results('SHOW TABLES IN '.DB_NAME);
        $query = "$operation TABLE ";

		$Tables_in_DB_NAME = 'Tables_in_'.DB_NAME;
        
        foreach($Tables as $k=>$v)
        {
            $_tabName = $v -> $Tables_in_DB_NAME ;
            $query .= " `$_tabName`,";
        }

        $query = substr($query,0,strlen($query)-1);
        $result = $wpdb -> get_results($query);
        
		if ($operation == "OPTIMIZE")
        {
			return '<h3>'.__('Optimization of database completed!','bdelete-revision').'</h3>';
		}

        $res = "<table border=\"0\" class=\"widefat\">";
        $res .= "<thead><tr>
			<th>Table</th>
			<th>OP</th>
			<th>Status</th>
			</tr><thead>";
        $bgcolor = $color3;
        
		foreach($result as $j=>$o)
        {
            $res .= "<tr>";
            
            foreach ($o as $k=>$v)
            {
				$tdClass = $j%2 == 1 ? 'active alt' : 'inactive';
                
				if($k == 'Msg_type')
                {
                    continue;
                }
                
				if($k == 'Msg_text' )
                {
					if ($v == 'OK')
                    {
                        $res .= "<td class='$tdClass' ><font color='green'><b>$v</b></font></td>";
					}
					else
                    {
                        $res .= "<td class='$tdClass' ><font color='red'><b>$v</b></font></td>";
					}
				}
				else
                {
                    $res .= "<td class='$tdClass' >$v</td>";
                }
            }
            
            $res .= "</tr>";
        }
        
        $res .= "<tfoot><tr><th colspan=3>";
        $res .= "If all statuses are <font color='green'>OK</font>, then your database does not need any optimization! ";
        $res .= "If any are <font color='red'>red</font>, then click on the following button to optimize your Wordpress database.";
        $res .= "</th></tr></tfoot></table>";
        
		$res .= "<br /><form method='post' action=''>
			<input name='operation' type='hidden' value='OPTIMIZE' />
			<input name='maintain_mysql' type='hidden' value='OPTIMIZE' />
			<input name='submit' type='submit' class='button-primary' value='".__('Optimize Wordpress Database','bdelete-revision')."' /></form>";
        
        return $res;
}