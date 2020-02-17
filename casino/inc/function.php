<?php
/*Custom Javascript*/
if ( ! function_exists( 'casino_custom_js' ) ) {
	function casino_custom_js( $data = array() ) {
		$data[] = '
			var TFAjaxURL = "' . esc_js( admin_url( 'admin-ajax.php' ) ) . '";
			var TFSiteURL = "' . get_site_url() . '/index.php' . '";
		';
		return preg_replace( '/\n|\t/i', '', implode( '', $data ) );
	}
}
/*Ajax Loadmore*/
add_action('wp_ajax_casino_ajax_loadmore_shortby_element','casino_ajax_loadmore_shortby_element');
add_action('wp_ajax_nopriv_casino_ajax_loadmore_shortby_element','casino_ajax_loadmore_shortby_element');
function casino_ajax_loadmore_shortby_element(){
	global $wpdb,$pagenow;
	$data = (array)$_POST['data'];
	$query_args = (array)$data['args'];
	if(empty( $query_args['paged'])) return;
	$query_args['paged'] += 1;
	$atts =  wp_parse_args( (array)$data['atts'], array(
		'post_type' => 'casino',
		'category' => ''
    ));
	extract($atts);
	$query_args['meta_key'] = 'number_list';
	$query_args['orderby'] = 'meta_value_num';
	$query_args['order'] = 'ASC';
	$load_more = get_option('show_loadmore');
	$show_viewless = get_option('show_viewless');
	if (is_numeric(get_option('cs_post_per_page'))) {
	   $post_number = intval(get_option('cs_post_per_page'));
	}
	$post_number = (($load_more)||($show_viewless)) ? $post_number:-1;
	$icon_button = get_option('casino_icon_button');
	$icon_spin = get_option('casino_icon_spin');
	$icon_bonus = get_option('casino_icon_bonus');
	$heading_spin = get_option('heading_two');
	$heading_bonus = get_option('heading_three');
	$heading_sub_spin = get_option('heading_sub_spin');
	$heading_sub_bonus = get_option('heading_sub_bonus');
	$heading_betting = get_option('heading_betting');
	$heading_bet_spin = get_option('heading_bet_spin');
	$heading_bet_bonus = get_option('heading_bet_bonus');
	$read_more = get_option('heading_sevent');
	$heading_Om = get_option('heading_five');
	/*Columns*/
	$show_casino = get_option('show_column_casino');
	$show_button = get_option('show_column_button');
	$show_spin = get_option('show_column_spin');
	$show_bonus = get_option('show_column_bonus');
	$show_info = get_option('show_column_info');
	$show_betting = get_option('show_column_betting');
	$show_betyg = get_option('show_column_betyg');
	/*Row*/
	$show_text_sp = get_option('text_spins_raw');
	$show_text_bn = get_option('text_spins_bonus');
	$text_spins_sub = get_option('text_spins_sub');
	$text_bonus_sub = get_option('text_bonus_sub');
	$text_betting_sub = get_option('text_betting_sub');
	/*Background Row*/
	$choice_style = get_option('casino_background_row');
	$style_bg = 'one_bg';
	/*Change order columns*/
	$position_casino = get_option('position_casino');
	$position_button = get_option('position_button');
	$position_spin = get_option('position_spin');
	$position_bonus = get_option('position_bonus');
	$position_info = get_option('position_info');
	$position_betting = get_option('position_betting');
	$position_betyg = get_option('position_betyg');
	$wpp = new WP_Query( $query_args );
	ob_start();
	if($wpp -> have_posts()){
		global $post;
		$k=0;
		$response['args'] = $query_args;
		while ( $wpp->have_posts() ) { $wpp->the_post();
		$link_images = get_post_meta($post->ID,'link_images',true);
		$number_list = get_post_meta($post->ID,'number_list',true);
		$button_text = get_post_meta($post->ID,'button_text',true);
		$button_link = get_post_meta($post->ID,'link_button',true);
		$freespin = get_post_meta($post->ID,'free_spin',true);
		$bonus = get_post_meta($post->ID,'bonus',true);
		$filter_bonus = str_replace(" ","",trim($bonus,'kr'));
		$bet_spin = get_post_meta($post->ID,'bet_spin',true);
		$bet_bonus = get_post_meta($post->ID,'bet_bonus',true);
		$betyg = get_post_meta($post->ID,'betyg',true);
		$name_betyg = get_post_meta($post->ID,'name_betyg',true);
		$link_betyg = get_post_meta($post->ID,'link_betyg',true);
		$time_string = date("Ymd");
		if($choice_style == 'custom_bg'){
			$style_bg = ($k%2 == 0) ? 'one_even':'one_odd';
		}
		?>
		<tr class="xl <?php echo esc_attr($style_bg);?>">
		<?php if($show_casino):?>
		<td class="td_one casino" data-position_value="<?php echo esc_attr($position_casino);?>" data-sort_value="<?php echo esc_attr($number_list);?>"><a href="<?php echo esc_attr($link_images);?>"><?php the_post_thumbnail('casino-blog-shortcode', array('class'=>'img-responsive'));?>
		</a></td>
		<?php endif;
		if($show_button):?>
		<td class="td_two" data-position_value="<?php echo esc_attr($position_button);?>"><a href="<?php echo esc_attr($button_link);?>" class="button_cs"><?php echo esc_attr($button_text);?><i class="fa <?php echo esc_attr($icon_button);?>"></i></a></td>
		<?php endif;
		if($show_spin):?>
		<td class="td_three freespin" data-position_value="<?php echo esc_attr($position_spin);?>" data-sort_value="<?php echo esc_attr($freespin);?>"><p><i class="fa <?php echo esc_attr($icon_spin);?>"></i><?php echo esc_attr($freespin);?></p>
		<?php if($show_text_sp):?>
		<h4><?php echo esc_attr($heading_sub_spin);?></h4>
		<?php endif;?>
		</td>
		<?php endif;
		if($show_bonus):?>
		<td class="td_four bonus" data-position_value="<?php echo esc_attr($position_bonus);?>" data-sort_value="<?php echo esc_attr($filter_bonus);?>"><p><i class="fa <?php echo esc_attr($icon_bonus);?>"></i><?php echo esc_attr($bonus);?></p>
		<?php if($show_text_bn):?>
		<h4><?php echo esc_attr($heading_sub_bonus);?></h4>
		<?php endif;?>
		</td>
		<?php endif;?>
		<td class="reponsive_mobile" style="display:none"><a href="#"><?php echo esc_attr($read_more);?></a></td>
		<?php if($show_info):?>
		<td class="td_five info" data-position_value="<?php echo esc_attr($position_info);?>" data-sort_value="<?php echo wp_kses_post($time_string);?>"><p><?php the_content();?></p></td>
		<?php endif;
		if($show_betting):?>
		<td class="td_six omsat" data-position_value="<?php echo esc_attr($position_betting);?>" data-sort_value="<?php echo esc_attr($bet_spin);?>">
<?php if($text_betting_sub):?>
<span class="heading_om"><?php echo esc_html($heading_betting);?></span>
<?php endif;?>
			<div class="first_a">
			<p><i class="fa <?php echo esc_attr($icon_spin);?>"></i><?php echo esc_attr($bet_spin);?></p>
			<?php if($text_spins_sub):?>
			<h4><?php echo esc_attr($heading_bet_spin);?></h4>
			<?php endif;?>
			</div>
			<div class="last_s">
			<p class="p_bonus"><i class="fa <?php echo esc_attr($icon_bonus);?>"></i><?php echo esc_attr($bet_bonus);?></p>
			<?php if($text_bonus_sub):?>
			<h4 class="t_bonus"><?php echo esc_attr($heading_bet_bonus);?></h4>
			<?php endif;?>
			</div>
		</td>
		<?php endif;
		if($show_betyg):?>
		<td class="td_sevent betyg" data-position_value="<?php echo esc_attr($position_betyg);?>" data-sort_value="<?php echo esc_attr($betyg);?>"><div>
		<?php
			for($i=0;$i<5;$i++){
				if($i < $betyg){?>
					<i class="fa fa-star fa-lg"></i>
				<?php }else{?>
					<i class="fa fa-star-o fa-lg"></i>
				<?php }
			}?>
		</div>
		<a class="reviewbtn" href="<?php echo esc_attr($link_betyg);?>"><?php echo esc_attr($name_betyg);?></a></td>
		<?php endif;?>
	</tr>
	<?php $k++;}
	if( $wpp->max_num_pages > 1 && $query_args['paged'] <= $wpp->max_num_pages ){
			$big = 999999999;
			$response['page'] = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, $query_args['paged'] ),
					'total' =>$wpp->max_num_pages,
					'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'ca' ),
					'next_text' => __( '<i class="fa fa-angle-right"></i>', 'ca' ),
				) );
			$response['max'] = $query_args['paged'] == $wpp->max_num_pages;
		}
	}
	wp_reset_postdata();
	$response['content'] = ob_get_clean();
	echo json_encode( $response );
	wp_die();
}
/*Save order columns*/
add_action('wp_ajax_casino_save_shortby_element','casino_save_shortby_element');
add_action('wp_ajax_nopriv_casino_save_shortby_element','casino_save_shortby_element');
function casino_save_shortby_element(){
	echo 'ok';
}
/*Style*/
function custom_style_color($custom){
	/*Font*/
	$body_font = get_option('casino_font');
	$color_one = get_option('color_one_ca');
	$color_two = get_option('color_one_text');
	$color_three = get_option('color_two_ca');
	$color_four = get_option('color_three_ca');
	$color_five = get_option('color_four_ca');
	$color_six = get_option('color_four_text');
	$color_sevent = get_option('color_five_ca');
	$color_eight = get_option('background_tab_list');
	$color_night = get_option('background_hover_button');
	$allrow_bg = get_option('background_row_casino');
	$even_bg = get_option('background_cs_even');
	$odd_bg = get_option('background_cs_odd');
	$border_heading = get_option('border_heading');
	$color_text_mobile = get_option('color_text_mobile');
	$background_button_mobile = get_option('background_button_mobile');
	$boxshadow_button_mobile = get_option('boxshadow_button_mobile');
	$background_mobile_hover = get_option('background_mobile_hover');
	$border_section = get_option('border_section');
	$bg_borderhd = get_option('background_border_heading');
	$bg_borderss = get_option('background_border_section');
	$color_heading = get_option('color_heading');
	if($color_one){
		$custom .= ".wrapper-casino .xl .td_two .button_cs,.all_data .load_more{ background-color:" . esc_attr($color_one) ."!important ;} "."\n";
	}
	if($color_two){
		$custom .= ".wrapper-casino .xl .td_two .button_cs,.all_data .load_more{color:" . esc_attr($color_two) ."!important ;} "."\n";
	}
	if($color_three){
		$custom .= ".wrapper-casino .xl .td_three p,.wrapper-casino .xl .td_six p{color:" . esc_attr($color_three) ."!important ;} "."\n";
	}
	if($color_four){
		$custom .= ".wrapper-casino .xl .td_four p,.wrapper-casino .xl .td_six p.p_bonus{color:" . esc_attr($color_four) ."!important ;} "."\n";
	}
	if($color_five){
		$custom .= ".wrapper-casino .xl .td_five ul li i{color:" . esc_attr($color_five) ."!important ;} "."\n";
	}
	if($color_six){
		$custom .= ".wrapper-casino .xl .td_five ul li,.wrapper-casino .xl .td_five p{color:" . esc_attr($color_six) ."!important ;} "."\n";
	}
	if($color_sevent){
		$custom .= ".wrapper-casino .xl .td_sevent div i{color:" . esc_attr($color_sevent) ."!important ;} "."\n";
	}
	if($color_eight){
		$custom .= ".wrapper-casino thead,.wrapper-casino thead .easy-table-header .logo-heading{background-color:" . esc_attr($color_eight) ."!important ;} "."\n";
		$custom .= ".wrapper-casino .all_data:before{background:" . esc_attr($color_eight) ."!important ;} "."\n";
	}
	if($color_night){
		$custom .= ".all_data .load_more,.td_two .button_cs{box-shadow:0 6px " . esc_attr($color_night) ."!important ;} "."\n";
	}
	if($color_night){
		$custom .= ".all_data .load_more:hover,.wrapper-casino .xl .td_two .button_cs:hover{background-color:" . esc_attr($color_night) ."!important ;} "."\n";
	}
	if($body_font){
		$custom .= ".wrapper-casino{font-family:" . esc_attr($body_font) ."!important ;} "."\n";
	}
	if($allrow_bg){
		$custom .= ".wrapper-casino tbody .one_bg{background-color:" . esc_attr($allrow_bg) ."!important ;} "."\n";
	}
	if($even_bg){
		$custom .= ".wrapper-casino tbody .one_even{background-color:" . esc_attr($even_bg) ."!important ;} "."\n";
	}
	if($odd_bg){
		$custom .= ".wrapper-casino tbody .one_odd{background-color:" . esc_attr($odd_bg) ."!important ;} "."\n";
	}
	if($border_heading !='0' && $bg_borderhd){
		$custom .= ".wrapper-casino thead{border:".esc_attr($border_heading)."px solid " . esc_attr($bg_borderhd) ."!important ;} "."\n";
	}
	if($border_section !='0' && $bg_borderss){
		$custom .= ".wrapper-casino tbody tr{border:".esc_attr($border_section)."px solid " . esc_attr($bg_borderss) ."!important ;} "."\n";
	}
if($color_text_mobile){
		$custom .= ".wrapper-casino .reponsive_mobile a,.wrapper-casino .reponsive_mobile a:before{color:" . esc_attr($color_text_mobile) ."!important ;} "."\n";
	}
	if($background_button_mobile){
		$custom .= ".wrapper-casino .reponsive_mobile{background-color:" . esc_attr($background_button_mobile) ."!important ;} "."\n";
	}
	if($boxshadow_button_mobile){
		$custom .= ".wrapper-casino .reponsive_mobile{box-shadow:0 6px " . esc_attr($boxshadow_button_mobile) ."!important ;} "."\n";
	}
	if($background_mobile_hover){
		$custom .= ".wrapper-casino .reponsive_mobile:hover{background-color:" . esc_attr($background_mobile_hover) ."!important ;} "."\n";
	}
	if($color_heading){
		$custom .= ".wrapper-casino thead tr th h4{color:" . esc_attr($color_heading) ."!important ;} "."\n";
	}
	wp_register_style( 'casino-style', false );
    wp_enqueue_style( 'casino-style' );
	wp_add_inline_style( 'casino-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'custom_style_color' );