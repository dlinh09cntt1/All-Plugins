<?php
/**
 * Plugin Name: MGRecipes
 * Description: MGRecipes Plugin
 * Author:      Linh D. Tran
 * Version:     1.0.0
 * License: GPLv2 or later
 */
define('RP_NAME','MGRECIPES');
define('RP_DIR',plugin_dir_path(__FILE__));
define('RP_URL',plugin_dir_url(__FILE__));
/*require_once custom post-type recipes*/
require_once RP_DIR . '/inc/mg_recipes/func_create.php';
/*require_one metabox*/
require_once RP_DIR . '/metaboxs/metabox_init.php';
/*require_once admin_setting*/
require_once RP_DIR . '/inc/wp_admin_setting.php';
/*require_once admin_setting*/
require_once RP_DIR . '/inc/rp_widget_category.php';
/*create class my_recipes*/
if(!class_exists('My_Recipes')){
	class My_Recipes{
		function __construct(){
			add_action('init',array($this,'func_recipes'));
			add_action('wp_enqueue_scripts',array($this,'func_enqueue_recipes'));
			add_action('widgets_init', array($this,'recipes_widgets_init'));
		}
		function func_recipes(){
			add_action('admin_enqueue_scripts',array($this,'func_admin_style'));
			require_once RP_DIR . 'inc/function.php';
		}
		function func_admin_style(){
			wp_enqueue_style( 'rp_admin', plugins_url('css/rp_admin.css', __FILE__),array());
			wp_enqueue_media();
			wp_enqueue_script( 'waypoints', plugins_url('js/jquery-waypoints.js', __FILE__), array('jquery'), '1.0', true );
			wp_enqueue_script( 'main', plugins_url('js/main.js', __FILE__), array('jquery'), '1.0', true );
		}
		function func_enqueue_recipes(){
			wp_enqueue_style( 'font-awesome', plugins_url('css/font-awesome.css', __FILE__), array());
			wp_enqueue_style( 'main', plugins_url('css/main.css', __FILE__),array());
			wp_enqueue_script( 'admin_page', plugins_url('js/admin_page.js', __FILE__), array('jquery'), '1.0', true );
		}
		function recipes_widgets_init(){
			register_sidebar( array(
				'name'          => esc_html__( 'Recipes Sidebar', 'rp' ),
				'id'            => 'sidebar-recipes',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'foodthim' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			));
		}
	}
}
function func_recipes_obj(){
	global $mg_recipes;
	$mg_recipes = new My_Recipes();
}
add_action('plugins_loaded','func_recipes_obj');