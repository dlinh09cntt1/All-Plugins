<?php
/*Custom Javascript*/
if ( ! function_exists( 'tdl_estate_custom_js' ) ) {
	function tdl_estate_custom_js( $data = array() ) {
		$data[] = '
			var TFAjaxURL = "' . esc_js( admin_url( 'admin-ajax.php' ) ) . '";
			var TFSiteURL = "' . get_site_url() . '/index.php' . '";
		';
		return preg_replace( '/\n|\t/i', '', implode( '', $data ) );
	}
}
/*Ajax Filter Estate*/
add_action( 'wp_ajax_tdl_price_custom', 'tdl_price_custom_init' );
add_action( 'wp_ajax_nopriv_tdl_price_custom', 'tdl_price_custom_init' );
function tdl_price_custom_init(){
	//$paged = $_POST['data_page'];
	$posts_per_page = $_POST['posts_per_page'];
	$post_type = $_POST['post_type'];
	$c_action = $_POST['c_action'];
	$c_redirect = $_POST['c_redirect'];
	$c_city = $_POST['c_city'];
	$c_distric = $_POST['c_distric'];
	$c_wards = $_POST['c_wards'];
	$c_min_size = $_POST['c_min_size'];
	$c_max_size = $_POST['c_max_size'];
	$c_max_price = $_POST['c_max_price'];
	$c_min_price = $_POST['c_min_price'];
	//$cat_ids = array();
	$m=0;
	$orderby = 'name';
    $order = 'asc';
    $hide_empty = false ;
    /*$cat_args = array(
        'orderby'    => $orderby,
        'order'      => $order,
        'hide_empty' => $hide_empty,
    );
    $product_categories = get_terms( 'product_cat', $cat_args );
	if( !empty($product_categories) ){
        foreach ($product_categories as $key => $category) {
			$cat_ids[$m] = $category->term_id;
			$m++;
        }
    }
	$catid = ($_POST['catid'] !='') ? $_POST['catid'] : $cat_ids;
	*/
	$query_args = array(
		'post_type' 	 => 'estate',
		'post_status' 	 => 'publish',
		'posts_per_page' => -1,
		'ignore_sticky_posts' => 1,
		'meta_query' => array(
			array(
				'key' => 'tdl_price',
				'value' => array($c_min_price,$c_max_price),
				'compare' => 'BETWEEN',
				'type' => 'NUMERIC'
			),
			array(
				'key' => 'tdl_size',
				'value' => array($c_min_size,$c_max_size),
				'compare' => 'BETWEEN',
				'type' => 'NUMERIC'
			),
			array(
				'key' => 'choice_actions',
				'value' => $c_action
			),
			array(
				'key' => 'choice_citiess',
				'value' => $c_city
			),
			array(
				'key' => 'choice_redirects',
				'value' => $c_redirect
			),
			array(
				'key' => 'choice_districs',
				'value' => $c_distric
			),
			array(
				'key' => 'choice_wardss',
				'value' => $c_wards
			),
		),
	);
	$wpp = new WP_Query( $query_args );
	//$total_records = $wpp->found_posts;
	//$total_pages = ceil($total_records/$posts_per_page);
	if ($wpp->have_posts()){
		while ($wpp->have_posts() ) {$wpp->the_post();?>
			<div class="col-md-4">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'estate-post' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
							<?php the_post_thumbnail('estate-blog', array( 'alt' => get_the_title() ) ); ?>
						</a>
					<?php endif;?>
					<div class="main-post-content">
						<h5 class="estate-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
						<p class="content"><?php the_content();?></p>
					</div>
				</article>
			</div>
		<?php }
		//echo psa_paginate_function($posts_per_page, $paged, $total_records, $total_pages);
		wp_reset_postdata();
	}else{
		echo 'Post not found!';
	}
	die();
}
function meks_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'meks_disable_srcset' );
/*Tiền*/
function init_monney($tdl_price,$choice_cys){
	$price = 0;
	if(strcmp($choice_cys,"Tỉ") == 0){
		$price = doubleval($tdl_price*1000000000);
	}else{
		$price = doubleval($tdl_price*1000000);
	}
	return $price;
}