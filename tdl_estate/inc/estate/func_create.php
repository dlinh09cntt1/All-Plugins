<?php
defined( 'ABSPATH' ) || exit;
class Estate_Post_Type{
	function __construct(){
		add_action('init',array(__CLASS__,'estate_init'));
		add_filter( 'archive_template', array( $this, 'estate_archive' ));
		add_filter( 'single_template', array( $this, 'estate_single' ));
	}
	public static function estate_init(){
		register_post_type( 'estate',
			array(
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'estate' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 4,
				'menu_icon'          => 'dashicons-admin-home',
				'supports'           => array('title', 'editor', 'thumbnail','comments'),
				'labels'             => array(
					'name'               => _x( 'Estate', 'ca' ),
					'singular_name'      => _x( 'Estate', 'ca' ),
					'menu_name'          => _x( 'Estate', 'ca' ),
					'name_admin_bar'     => _x( 'Estate', 'ca' ),
					'add_new'            => _x( 'Add New Estate', 'ca' ),
					'add_new_item'       => __( 'Add New Estate', 'ca' ),
					'new_item'           => __( 'New Estate', 'ca' ),
					'edit_item'          => __( 'Edit Estate', 'ca' ),
					'view_item'          => __( 'View Estate', 'ca' ),
					'all_items'          => __( 'All Estate', 'ca' ),
					'search_items'       => __( 'Search Estate', 'ca' ),
					'parent_item_colon'  => __( 'Parent Estate:', 'ca' ),
					'not_found'          => __( 'No Estate found.', 'ca' ),
					'not_found_in_trash' => __( 'No Estate found in Trash.', 'ca' )
				),
			)
		);
		// Register event category
		register_taxonomy('estate_cat',
			array('estate'),
			array(
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'estate_cat' ),
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
	}
	function estate_archive( $template ) {
		global $post;
		if ( $post->post_type == 'estate' ) {
			$template = TDL_DIR . '/inc/estate/view/archive.php';
		}
		return $template;
	}
	function estate_single( $template ) {
		global $post;
		if ( $post->post_type == 'estate' ) {
			$template = TDL_DIR . '/inc/estate/view/single.php';
		}
		return $template;
	}
}
$estate = new Estate_Post_Type();
/*Widget Estate*/
function tdl_widgets_init(){
	register_sidebar( array(
        'name'          => esc_html__( 'TDL Estate Sidebar', 'tdl' ),
        'id'            => 'tdl-estate-sidebar',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar Estate', 'tdl' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action( 'widgets_init', 'tdl_widgets_init');