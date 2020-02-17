<?php
/**
 * Plugin Name: TDL Estate
 * Description: TDL Estate Plugin
 * Author:      Linh D. Tran
 * Version:     1.0.0
 * License: GPLv2 or later
 */
define('TDL_NAME','TDLESTATE');
define('TDL_DIR',plugin_dir_path(__FILE__));
define('TDL_URL',plugin_dir_url(__FILE__));
/*require_once custom post-type estate*/
require_once TDL_DIR . '/inc/estate/func_create.php';
/*require_once shortcode*/
require_once TDL_DIR . '/shortcodes/shortcode_init.php';
/*require_once widgets*/
require_once TDL_DIR . '/widgets/tdl_estate_filter.php';
/*require_one metabox*/
require_once TDL_DIR . '/metaboxs/metabox_init.php';
/*require_once admin_setting*/
require_once TDL_DIR . '/inc/wp_admin_setting.php';
/*create class my_estate*/
if(!class_exists('My_Tdl_Estate')){
	class My_Tdl_Estate{
		public $fonts = false;
		function __construct(){
			add_action('init',array($this,'func_estate'));
		}
		function func_estate(){
			//function
			require_once TDL_DIR . 'inc/function.php';
			//hook script
			add_action('admin_enqueue_scripts',array($this,'tdl_enqueue_script'));
			add_action('wp_enqueue_scripts',array($this,'tdl1_enqueue_script'));
		}
		function tdl_enqueue_script(){
			wp_enqueue_style( 'main', plugins_url('css/main.css', __FILE__),array());
			wp_enqueue_script( 'tdl_main', plugins_url('js/main.js', __FILE__), array('jquery'), '1.0', true );
			$php_array = array(
				'admin_ajax' => admin_url( 'admin-ajax.php' )
			);
			wp_localize_script( 'tdl_main', 'tdl_array_ajaxp', $php_array );
			wp_register_script('main',plugins_url('js/main.js', __FILE__), array('jquery'), '1.0', true );
			wp_enqueue_script('main');
			wp_localize_script('main','ajax_login_object',array('ajaxurl' => admin_url('admin-ajax.php'),'redirecturl' => 'REDIRECT_URL_HERE','loadingmessage' => __('Sending user info, please wait...')));
		}
		function tdl1_enqueue_script(){
			wp_enqueue_style( 'jquery-ui-css', plugins_url('css/jquery-ui.css', __FILE__),array());
			wp_enqueue_style( 'main-fron-end', plugins_url('css/main_fr.css', __FILE__),array());
			wp_enqueue_script( 'jquery-ui', plugins_url('js/jquery-ui.js', __FILE__), array('jquery'), '1.12.1', true );
			wp_enqueue_script( 'tdl_main_fr', plugins_url('js/main_fr.js', __FILE__), array('jquery'), '1.0', true );
			$php_array = array(
				'admin_ajax' => admin_url( 'admin-ajax.php' )
			);
			wp_localize_script( 'tdl_main_fr', 'tdl_array_ajaxp', $php_array );
		}
	}
}
function func_tdl_obj(){
	global $tdl;
	$tdl = new My_Tdl_Estate();
}
add_action('plugins_loaded','func_tdl_obj');