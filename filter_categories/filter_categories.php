<?php
/**
 * Plugin Name: Filter Categories
 * Description: Filter Categories Plugin
 * Author:      Linh D. Tran
 * Version:     1.0.0
 * License: GPLv2 or later
 */
define('FC_NAME','FCATEGORIES');
define('FC_DIR',plugin_dir_path(__FILE__));
define('FC_URL',plugin_dir_url(__FILE__));
if(!class_exists('My_Filter_Categories')){
	class My_Filter_Categories{
		function __construct(){
			
		}
	}
}
function filter_categories_obj(){
	global $fcat;
	$fcat = new My_Filter_Categories();
}
add_action('plugins_loaded','filter_categories_obj');
?>