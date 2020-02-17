<?php
/**
 * Plugin Name: Casino
 * Description: Casino Plugin
 * Author:      Linh D. Tran
 * Version:     1.0.1
 * License: GPLv2 or later
 */
define('CA_NAME','CASINO');
define('CA_DIR',plugin_dir_path(__FILE__));
define('CA_URL',plugin_dir_url(__FILE__));
/*require_once custom post-type casino*/
require_once CA_DIR . '/inc/casino/func_create.php';
/*require_once shortcode*/
require_once CA_DIR . '/shortcodes/shortcode_init.php';
/*require_one metabox*/
require_once CA_DIR . '/metaboxs/metabox_init.php';
/*require_once admin_setting*/
require_once CA_DIR . '/inc/wp_admin_setting.php';
/*create class my_casino*/
if(!class_exists('My_Casion')){
	class My_Casion{
		public $fonts = false;
		function __construct(){
			add_action('init',array($this,'func_casino'));
			add_action('get_footer',array($this,'font_method'));
		}
		function func_casino(){
			//hook colorpicker
			add_action('admin_enqueue_scripts',array($this,'mycolor_enqueue_style'));
			//function
			require_once CA_DIR . 'inc/function.php';
			//hook script
			add_action('wp_enqueue_scripts',array($this,'ca_enqueue_script'));
		}
		function mycolor_enqueue_style(){
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_style( 'font-awesome', plugins_url('css/font-awesome.css', __FILE__), array());
			wp_enqueue_style( 'other', plugins_url('css/other.css', __FILE__),array());
			wp_enqueue_style( 'bootstrap', plugins_url('css/bootstrap.css', __FILE__),array());
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_script( 'bootstrap', plugins_url('js/bootstrap.min.js', __FILE__), array('jquery'), '1.0', true );
			wp_enqueue_script( 'main', plugins_url('js/colorpicker.js', __FILE__), array(), '1.0', true );
		}
		function ca_enqueue_script(){
			//wp_enqueue_style( 'font-awesome', plugins_url('css/font-awesome.css', __FILE__), array());
			wp_enqueue_style( 'main', plugins_url('css/main.css', __FILE__),array());
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'casino-admin-script', plugins_url('js/main.js', __FILE__), array('jquery'), '1.0', true );
			wp_localize_script( 'casino-admin-script', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
			wp_add_inline_script('casino-script', casino_custom_js());
		}
		function font_method(){
			wp_enqueue_style( 'font-awesome', plugins_url('css/font-awesome.css', __FILE__), array());
		}
	}
}
function func_casino_obj(){
	global $casino;
	$casino = new My_Casion();
}
add_action('plugins_loaded','func_casino_obj');