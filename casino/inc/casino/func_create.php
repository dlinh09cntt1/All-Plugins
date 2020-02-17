<?php
defined( 'ABSPATH' ) || exit;
class Casino_Post_Type{
	function __construct(){
		add_action('init',array(__CLASS__,'casino_init'));
	}
	public static function casino_init(){
		register_post_type( 'casino',
			array(
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'casino' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 4,
				'menu_icon'          => 'dashicons-admin-home',
				'supports'           => array('title', 'editor', 'thumbnail','comments'),
				'labels'             => array(
					'name'               => _x( 'Casino', 'ca' ),
					'singular_name'      => _x( 'Casino', 'ca' ),
					'menu_name'          => _x( 'Casino', 'ca' ),
					'name_admin_bar'     => _x( 'Casino', 'ca' ),
					'add_new'            => _x( 'add New Casino', 'ca' ),
					'add_new_item'       => __( 'Add New Casino', 'ca' ),
					'new_item'           => __( 'New Casino', 'ca' ),
					'edit_item'          => __( 'Edit Casino', 'ca' ),
					'view_item'          => __( 'View Casino', 'ca' ),
					'all_items'          => __( 'All Casino', 'ca' ),
					'search_items'       => __( 'Search Casino', 'ca' ),
					'parent_item_colon'  => __( 'Parent Casino:', 'ca' ),
					'not_found'          => __( 'No Casino found.', 'ca' ),
					'not_found_in_trash' => __( 'No Casino found in Trash.', 'ca' )
				),
			)
		);
		// Register event category
		register_taxonomy('casino_cat',
			array('casino'),
			array(
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'casino_cat' ),
				'labels'            => array(
					'name'              => _x( 'Categories', 'ca' ),
					'singular_name'     => _x( 'Category', 'ca' ),
					'search_items'      => __( 'Search Categories', 'ca' ),
					'all_items'         => __( 'All Categories', 'ca' ),
					'parent_item'       => __( 'Parent Category', 'ca' ),
					'parent_item_colon' => __( 'Parent Category:', 'ca' ),
					'edit_item'         => __( 'Edit Category', 'ca' ),
					'update_item'       => __( 'Update Category', 'ca' ),
					'add_new_item'      => __( 'Add New Category', 'ca' ),
					'new_item_name'     => __( 'New Category Name', 'ca' ),
					'menu_name'         => __( 'Category', 'ca' ),
				),
			)
		);
		// Register event tag
		register_taxonomy('casino_tag',
			'casino',
			array(
				'hierarchical'          => false,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'casino_tag' ),
				'labels'                => array(
					'name'                       => _x( 'Tags', 'ca' ),
					'singular_name'              => _x( 'Tag', 'ca' ),
					'search_items'               => __( 'Search Tags', 'ca' ),
					'popular_items'              => __( 'Popular Tags', 'ca' ),
					'all_items'                  => __( 'All Tags', 'ca' ),
					'parent_item'                => null,
					'parent_item_colon'          => null,
					'edit_item'                  => __( 'Edit Tag', 'ca' ),
					'update_item'                => __( 'Update Tag', 'ca' ),
					'add_new_item'               => __( 'Add New Tag', 'ca' ),
					'new_item_name'              => __( 'New Tag Name', 'ca' ),
					'separate_items_with_commas' => __( 'Separate writers with commas', 'ca' ),
					'add_or_remove_items'        => __( 'Add or remove writers', 'ca' ),
					'choose_from_most_used'      => __( 'Choose from the most used writers', 'ca' ),
					'not_found'                  => __( 'No writers found.', 'ca' ),
					'menu_name'                  => __( 'Tag', 'ca' ),
				),
			)
		);
	}
}
$casino = new Casino_Post_Type();