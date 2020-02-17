<?php
/**
 * Plugin Name: Ajax Instagram
 * Description: Ajax Instagram
 * Author:      Linh D. Tran
 * Version:     1.0.0
 * License: GPLv2 or later
 */
define('TDL_NAME','AJP');
define('TDL_DIR',plugin_dir_path(__FILE__));
define('TDL_URL',plugin_dir_url(__FILE__));
/*require_once shortcode*/
require_once TDL_DIR . '/shortcode/shortcode_init.php';
/*require_once admin_setting*/
require_once TDL_DIR . '/inc/wp_admin_setting.php';
/*create class instagram*/
if(!class_exists('Tdl_instagram_init')){
	class Tdl_instagram_init{
		public $fonts = false;
		function __construct(){
			add_action('init',array($this,'func_ajax_pagination'));
		}
		function func_ajax_pagination(){
			//hook script
			add_action('wp_enqueue_scripts',array($this,'tdl_enqueue_script'));
			require_once TDL_DIR . 'inc/function.php';
		}
		function tdl_enqueue_script(){
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'tdl_main', plugins_url('js/main.js', __FILE__), array('jquery'), '1.0', true );
			$php_array = array(
				'admin_ajax' => admin_url( 'admin-ajax.php' )
			);
			wp_localize_script( 'tdl_main', 'svl_array_ajaxp', $php_array );
			wp_enqueue_style( 'ajaxp', plugins_url('css/style.css', __FILE__), array());
		}
	}
}
function func_ajax_tdl_instagram_obj(){
	global $tdl_ins;
	$tdl_ins = new Tdl_instagram_init();
}
add_action('plugins_loaded','func_ajax_tdl_instagram_obj');