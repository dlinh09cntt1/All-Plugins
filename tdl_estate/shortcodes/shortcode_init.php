<?php
if(!function_exists('func_blog_casino')){
	function func_blog_casino($atts){
		$atts = shortcode_atts(array(
			'post_type' => 'casino',
			'category'  => ''
		),$atts);
		extract($atts);
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$load_more = get_option('show_loadmore');
		$class_hide = get_option('show_loadmore') ? 'show_lm_line':'hide_lm_line';
		$loadmore_text = get_option('loadmore_text');
		$icon_loadmore = get_option('casino_icon_loadmore');
		$show_viewless = get_option('show_viewless');
		//$post_number = -1;
		if (is_numeric(get_option('cs_post_per_page'))) {
		   $post_number = intval(get_option('cs_post_per_page'));
		}
		$post_number = ($load_more || $show_viewless) ? $post_number:-1;
		$args = array(
			'posts_per_page' => $post_number,
			'paged' => $paged,
			'post_type' => $post_type,
			'post_status' => 'publish'
		);
		if (isset($category) && $category != ''){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'casino_cat',
					'field' => 'id',
					'terms' => $category
				)
			);
		}
		$args['meta_key'] = 'number_list';
		$args['orderby'] = 'meta_value_num';
		$args['order'] = 'ASC';
		$wp_query = new WP_Query($args);
		global $post;
		$icon_button = get_option('casino_icon_button');
		$icon_spin = get_option('casino_icon_spin');
		$icon_bonus = get_option('casino_icon_bonus');
		$heading_casino = get_option('heading_one');
		$heading_spin = get_option('heading_two');
		$heading_sub_spin = get_option('heading_sub_spin');
		$heading_bonus = get_option('heading_three');
		$heading_sub_bonus = get_option('heading_sub_bonus');
		$heading_info = get_option('heading_four');
		$heading_Om = get_option('heading_five');
		$heading_betyg = get_option('heading_six');
		$read_more = get_option('heading_sevent');
		$heading_betting = get_option('heading_betting');
		$heading_bet_spin = get_option('heading_bet_spin');
		$heading_bet_bonus = get_option('heading_bet_bonus');
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
		/*Logo Heading*/
		$position_logo = get_option('casino_logo_align');
		if($position_logo!=''){
			$logo_casino = get_option('image_logo_one');
			$logo_frspin = get_option('image_logo_two');
			$logo_bonus = get_option('image_logo_three');
			$logo_info = get_option('image_logo_four');
			$logo_betting = get_option('image_logo_five');
			$logo_betyg = get_option('image_logo_six');
		}else{
			$logo_casino = '';
			$logo_frspin = '';
			$logo_bonus = '';
			$logo_info = '';
			$logo_betting = '';
			$logo_betyg = '';
		}
		/*Change order columns*/
		$position_casino = get_option('position_casino');
		$position_button = get_option('position_button');
		$position_spin = get_option('position_spin');
		$position_bonus = get_option('position_bonus');
		$position_info = get_option('position_info');
		$position_betting = get_option('position_betting');
		$position_betyg = get_option('position_betyg');
		ob_start();
		if($wp_query -> have_posts()){?>
			<table class="wrapper-casino <?php echo esc_attr($class_hide);?>">
				<thead>
					<tr class="tablesorter-headerRow">
						<?php if($show_casino):?>
						<th class="easy-table-header <?php echo esc_attr($position_logo);?> cs_logo" data-shortby=".casino" data-position_value="<?php echo esc_attr($position_casino);?>">
						<div class="tablesorter-header-inner">
							<?php if($logo_casino):?>
							<div class="logo-heading">
								<img src="<?php echo esc_url($logo_casino);?>" alt="image" />
							</div>
							<?php endif;?>
							<h4 data-show="casino_asc" class="ascs"><?php echo esc_attr($heading_casino);?></h4>
							<div class="wraps">
								<a href="javascript:void(0)" data-show="casino_asc" class="asc"><i class="fa fa-caret-up"></i></a>
								<a href="javascript:void(0)" data-show ="casino_desc" class="desc"><i class="fa fa-caret-down"></i></a>
							</div>
						</div>
						</th>
						<?php endif;
						if($show_button):?>
						<th class="easy-table-header <?php echo esc_attr($position_logo);?> cs_button" data-position_value="<?php echo esc_attr($position_button);?>">
						<div class="tablesorter-header-inner" style="display:none">Button</div>
						</th>
						<?php endif;
						if($show_spin):?>
						<th class="easy-table-header <?php echo esc_attr($position_logo);?> cs_spin" data-shortby=".freespin" data-position_value="<?php echo esc_attr($position_spin);?>">
						<div class="tablesorter-header-inner">
							<?php if($logo_frspin):?>
							<div class="logo-heading">
								<img src="<?php echo esc_url($logo_frspin);?>" alt="image" />
							</div>
							<?php endif;?>
							<h4 data-show="fspin_asc" class="ascs"><?php echo esc_attr($heading_spin);?></h4>
							<div class="wraps">
								<a href="javascript:void(0)" data-show="fspin_asc" class="asc"><i class="fa fa-caret-up"></i></a>
								<a href="javascript:void(0)" data-show ="fspin_desc" class="desc"><i class="fa fa-caret-down"></i></a>
							</div>
						</div>
						</th>
						<?php endif;
						if($show_bonus):?>
						<th class="easy-table-header <?php echo esc_attr($position_logo);?> cs_bonus" data-shortby=".bonus" data-position_value="<?php echo esc_attr($position_bonus);?>">
						<div class="tablesorter-header-inner">
							<?php if($logo_bonus):?>
							<div class="logo-heading">
								<img src="<?php echo esc_url($logo_bonus);?>" alt="image" />
							</div>
							<?php endif;?>
							<h4 data-show="bonus_asc" class="ascs"><?php echo esc_attr($heading_bonus);?></h4>
							<div class="wraps">
								<a href="javascript:void(0)" data-show="bonus_asc" class="asc"><i class="fa fa-caret-up"></i></a>
								<a href="javascript:void(0)" data-show ="bonus_desc" class="desc"><i class="fa fa-caret-down"></i></a>
							</div>
						</div>
						</th>
						<?php endif;
						if($show_info):?>
						<th class="easy-table-header <?php echo esc_attr($position_logo);?> cs_info" data-shortby=".info" data-position_value="<?php echo esc_attr($position_info);?>">
						<div class="tablesorter-header-inner">
							<?php if($logo_info):?>
							<div class="logo-heading">
								<img src="<?php echo esc_url($logo_info);?>" alt="image" />
							</div>
							<?php endif;?>
							<h4 data-show="info_asc" class="ascs"><?php echo esc_attr($heading_info);?></h4>
							<div class="wraps">
								<a href="javascript:void(0)" data-show="info_asc" class="asc"><i class="fa fa-caret-up"></i></a>
								<a href="javascript:void(0)" data-show ="info_desc" class="desc"><i class="fa fa-caret-down"></i></a>
							</div>
						</div>
						</th>
						<?php endif;
						if($show_betting):?>
						<th class="easy-table-header <?php echo esc_attr($position_logo);?> cs_betting" data-shortby=".omsat" data-position_value="<?php echo esc_attr($position_betting);?>">
						<div class="tablesorter-header-inner">
							<?php if($logo_betting):?>
							<div class="logo-heading">
								<img src="<?php echo esc_url($logo_betting);?>" alt="image" />
							</div>
							<?php endif;?>
							<h4 data-show="bet_spinasc" class="ascs"><?php echo esc_attr($heading_Om);?></h4>
							<div class="wraps">
								<a href="javascript:void(0)" data-show="bet_spinasc" class="asc"><i class="fa fa-caret-up"></i></a>
								<a href="javascript:void(0)" data-show ="bet_spindesc" class="desc"><i class="fa fa-caret-down"></i></a>
							</div>
						</div>
						</th>
						<?php endif;
						if($show_betyg):?>
						<th class="easy-table-header <?php echo esc_attr($position_logo);?> cs_betyg" data-shortby=".betyg" data-position_value="<?php echo esc_attr($position_betyg);?>">
						<div class="tablesorter-header-inner">
							<?php if($logo_betyg):?>
							<div class="logo-heading">
								<img src="<?php echo esc_url($logo_betyg);?>" alt="image" />
							</div>
							<?php endif;?>
							<h4 data-show="betyg_asc" class="ascs"><?php echo esc_attr($heading_betyg);?></h4>
							<div class="wraps">
								<a href="javascript:void(0)" data-show="betyg_asc" class="asc"><i class="fa fa-caret-up"></i></a>
								<a href="javascript:void(0)" data-show ="betyg_desc" class="desc"><i class="fa fa-caret-down"></i></a>
							</div>
						</div>
						</th>
						<?php endif;?>
					</tr>
					<tr class="tablesorter-headerRow" style="display:none">
						<th class="easy-table-header">
						<div class="container_data" style="display:none" data-args='<?php echo json_encode($args);?>'></div>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$k=0;
						while ( $wp_query->have_posts() ) { $wp_query->the_post();
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
					<?php $k++;}?>
				</tbody>
				<tfoot>
					<tr>
						<td>
						<div class="all_data">
<?php if($load_more):?>
							<a href="#" class="load_more" data-args='<?php echo json_encode($args);?>' data-atts='<?php echo json_encode( $atts );?>'><?php echo esc_attr($loadmore_text);?><i style="font-family:'FontAwesome'" class="fa <?php echo esc_attr($icon_loadmore);?>"></i></a>
<?php endif;?>
						</div>
						</td>
					</tr>
				</tfoot>
			</table>
		<?php }else{
			echo 'Post not found!';
		} 
		wp_reset_postdata();
		return ob_get_clean();
	}
}
add_shortcode('blog_casino','func_blog_casino');