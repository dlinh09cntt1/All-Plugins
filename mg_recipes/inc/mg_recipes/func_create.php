<?php
defined( 'ABSPATH' ) || exit;
class Recipes_Post_Type{
	function __construct(){
		add_action('init',array(__CLASS__,'recipes_init'));
		add_filter( 'archive_template', array( $this, 'mg_recipes_archive' ));
		add_filter( 'single_template', array( $this, 'mg_recipes_single' ));
	}
	public static function recipes_init(){
		register_post_type( 'mg_recipes',
			array(
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'mg_recipes' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 4,
				'menu_icon'          => 'dashicons-carrot',
				'supports'           => array('title', 'editor', 'thumbnail','comments'),
				'labels'             => array(
					'name'               => _x( 'Recipes', 'rp' ),
					'singular_name'      => _x( 'Recipes', 'rp' ),
					'menu_name'          => _x( 'Recipes', 'rp' ),
					'name_admin_bar'     => _x( 'Recipes', 'rp' ),
					'add_new'            => _x( 'add New Recipes', 'rp' ),
					'add_new_item'       => __( 'Add New Recipes', 'rp' ),
					'new_item'           => __( 'New Recipes', 'rp' ),
					'edit_item'          => __( 'Edit Recipes', 'rp' ),
					'view_item'          => __( 'View Recipes', 'rp' ),
					'all_items'          => __( 'All Recipes', 'rp' ),
					'search_items'       => __( 'Search Recipes', 'rp' ),
					'parent_item_colon'  => __( 'Parent Recipes:', 'rp' ),
					'not_found'          => __( 'No Recipes found.', 'rp' ),
					'not_found_in_trash' => __( 'No Recipes found in Trash.', 'rp' )
				),
			)
		);
		// Register event category
		register_taxonomy('mg_recipes_cat',
			array('mg_recipes'),
			array(
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'mg_recipes_cat' ),
				'labels'            => array(
					'name'              => _x( 'Categories', 'rp' ),
					'singular_name'     => _x( 'Category', 'rp' ),
					'search_items'      => __( 'Search Categories', 'rp' ),
					'all_items'         => __( 'All Categories', 'rp' ),
					'parent_item'       => __( 'Parent Category', 'rp' ),
					'parent_item_colon' => __( 'Parent Category:', 'rp' ),
					'edit_item'         => __( 'Edit Category', 'rp' ),
					'update_item'       => __( 'Update Category', 'rp' ),
					'add_new_item'      => __( 'Add New Category', 'rp' ),
					'new_item_name'     => __( 'New Category Name', 'rp' ),
					'menu_name'         => __( 'Category', 'rp' ),
				),
			)
		);
	}
	function mg_recipes_archive( $template ) {
		global $post;
		if ( $post->post_type == 'mg_recipes' ) {
			$template = RP_DIR . '/inc/mg_recipes/view/archive.php';
		}
		return $template;
	}
	function mg_recipes_single( $template ) {
		global $post;
		if ( $post->post_type == 'mg_recipes' ) {
			$template = RP_DIR . '/inc/mg_recipes/view/single.php';
		}
		return $template;
	}
}
$mg_recipes = new Recipes_Post_Type();