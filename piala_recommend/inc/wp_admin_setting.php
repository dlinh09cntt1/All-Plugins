<?php
if(!class_exists('Ajax_Recommend_Setting_Admin')){
	class Ajax_Recommend_Setting_Admin{
		public static $_instance = null;
		public static function instance(){
			if ( is_null( self::$_instance )) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		public function __construct(){
			add_action( 'admin_menu', array( $this, 'sub_menu_page_init' ));
		}
		public function sub_menu_page_init() {
			add_menu_page(
				'Piala Recommend Post'
				, 'Piala Recommend Post'
				, 'manage_options'
				, 'plugin_settings'
				, null
				, null
			);
		}
	}
}
Ajax_Recommend_Setting_Admin::instance();