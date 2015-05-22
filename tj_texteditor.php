<?php
/**
* Plugin Name: Tonjoo Text Editor
* Plugin URI: tonjoostudio.com
* Description: Simple interface texteditor. 
* Version: 1.0
* Author: Eringga Sutandang
* Author URI: https://github.com/soetandank
*/

define("TONJOO_TEXT_EDITOR", 'text-editor');

require plugin_dir_path( __FILE__ ) .'inc/page-admin.php';
if(!function_exists("tj_enqueue_markitup_script"))
{
	add_action( 'wp_enqueue_scripts', 'tj_enqueue_markitup_script' );
	function tj_enqueue_markitup_script( $hook_suffix ) 
	{
	   	$plugin_url 	= plugin_dir_url(__FILE__);
		$js 			= $plugin_url . 'assets/sets/default/set.js';
		wp_register_script('tj-sets-js', $js,'','',true);
		wp_enqueue_script('tj-sets-js');

		$js 			= $plugin_url . 'assets/jquery.markitup.js';
		wp_register_script('tj-markitup-js', $js,'','',true);
		wp_enqueue_script('tj-markitup-js');

	}
}
if(!function_exists("tj_enqueue_markitup_style"))
{
	add_action( 'wp_enqueue_scripts', 'tj_enqueue_markitup_style' );
	function tj_enqueue_markitup_style( $hook_suffix ) 
	{
	   	$plugin_url 	= plugin_dir_url(__FILE__);
		$css 			= $plugin_url . 'assets/skins/markitup/style.css';
		wp_register_style('tj-markitup-css', $css);
		wp_enqueue_style('tj-markitup-css');

		$css 			= $plugin_url . 'assets/sets/default/style.css';
		wp_register_style('tj-markitup-default-css', $css);
		wp_enqueue_style('tj-markitup-default-css');

	}
}
if(!function_exists("tj_enqueue_editor_scripts"))
{
	add_action( 'wp_enqueue_scripts', 'tj_enqueue_editor_scripts' );
	function tj_enqueue_editor_scripts() {
		if(function_exists('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        else {
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
        }
	}
}
require plugin_dir_path( __FILE__ ) .'inc/shortcode.php';
require plugin_dir_path( __FILE__ ) .'inc/helper.php';

if(!is_admin())
{
	$option = get_option( 'tj_text_editor_option' );
	if($option['maks_file_size'])
	{
		function upload_size_limit_filterw( $size ) {
			global $option;
			return $option['maks_file_size'] * 1000000;//Size in Kb
		}

		add_filter( 'upload_size_limit', 'upload_size_limit_filterw',12 );
	}
	function modify_post_mime_types($post_mime_types) {
	    $post_mime_types['application/pdf'] = array(__('PDF'), __('Manage PDF'), _n_noop('PDF <span class="count">(%s)</span>', 'PDF <span class="count">(%s)</span>'));
	    return $post_mime_types;
	}
	add_filter('post_mime_types', 'modify_post_mime_types');
}

function ttext_save_()
{
	if(isset($_POST['ttextidentifi']))
	{
		$r_ttextidentifi = $_POST['ttextidentifi'];
		foreach($r_ttextidentifi AS $ttextidentifi)
		{
			$pos = strpos($ttextidentifi, '[]');
			if ($pos !== false) {
				$result = array();
				$ttextidentifi = str_replace('[]', '', $ttextidentifi);
				foreach($_POST[$ttextidentifi] AS $key => $value)
				{
					$result[] = htmlspecialchars($value);
				}
				$_POST[$ttextidentifi] = $result;
			}else{
				$_POST[$ttextidentifi] = htmlspecialchars($_POST[$ttextidentifi]);
			}
		}		
	}
}

add_action('init','ttext_save_');

function TgetEditor($params = array())
{
	
	$name 			= $params['name'];
	$value 			= isset($params['value']) ? $params['value'] : '';
	$is_multiple 	= isset($params['multiple']) ? '[]' : '';
	$id 			= $params['id'];
	$cols 			= isset($params['cols']) ? $params['cols'] : 50 ; 
	$rows 			= isset($params['rows']) ? $params['rows'] : 10 ;
	$height 		= isset($params['height']) ? $params['height'] : 340 ;
	$return 		= '<input type="hidden" name="ttextidentifi[]" value="'.$name . $is_multiple .'"><textarea style="height: '.$height.'px ! important;" cols="'.$cols.'" id="markItUp'.$id.'" name="'.$name . $is_multiple .'" rows="'.$rows.'">'.tjdecode_shortcode($value) . '</textarea>
	<script type="text/javascript">
		jQuery(function() {
			jQuery("#markItUp'.$id.'").markItUp(mySettings);
			jQuery(".add").click(function() {
		 		jQuery("#markItUp'.$id.'").markItUp("insert",
					{ 	openWith:"<opening tag>",
						closeWith:"<\/closing tag>",
						placeHolder:"New content"
					}
				);
		 		return false;
			});
			jQuery(".toggle").click(function() {
				if (jQuery("#markItUp'.$id.'").length === 1) {
		 			jQuery("#markItUp'.$id.'").markItUp("remove");
					jQuery("span", this).text("get markItUp! back");
				} else {
					jQuery("#markItUp'.$id.'").markItUp(mySettings);
					jQuery("span", this).text("remove markItUp!");
				}
		 		return false;
			});
		});
		</script>
	';
	return $return;
}

add_shortcode('tj_text_editor', 'TgetEditor');
