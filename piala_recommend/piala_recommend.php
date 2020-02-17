<?php
/**
 * Plugin Name: Piala Recommend Post
 * Description: Piala Recommend Post
 * Author:      Linh D. Tran
 * Version:     1.0.0
 * License: GPLv2 or later
 */
define('PIA_NAME','ARC');
define('PIA_DIR',plugin_dir_path(__FILE__));
define('PIA_URL',plugin_dir_url(__FILE__));
/*require_once shortcode*/
require_once PIA_DIR . '/shortcode/shortcode_init.php';
/*require_once admin_setting*/
require_once PIA_DIR . '/inc/wp_admin_setting.php';
/*create class Piala_Recommend_Post*/
if(!class_exists('Piala_Recommend_Post')){
	class Piala_Recommend_Post{
		function __construct(){
			add_action('init',array($this,'func_ajax_piala_post_recommend'));
			add_action('init',array($this,'pia_ajax_enqueue_script'));
		}
		function func_ajax_piala_post_recommend(){
			require_once PIA_DIR . 'inc/function.php';
		}
		function pia_ajax_enqueue_script(){
			wp_enqueue_style('rcmend', plugins_url('css/style.css', __FILE__), array());
			wp_enqueue_script('admin-js', plugins_url('js/main.js', __FILE__), array('jquery'), '1.0', true );
		}
	}
}
function func_ajax_piala_recommend_post(){
	global $prp;
	$prp = new Piala_Recommend_Post();
}
add_action('plugins_loaded','func_ajax_piala_recommend_post');
