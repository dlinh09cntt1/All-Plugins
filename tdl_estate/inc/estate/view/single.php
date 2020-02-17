<?php get_header();?>
<div id="single-estate" class="single-estate">
	<main id="main" class="post-wrap">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'estate_single' ); ?>>
			<div class="info_estate">
				<?php 
					$tdl_price = get_post_meta($post->ID, 'tdl_price', true);
					$tdl_width = get_post_meta($post->ID, 'tdl_width', true);
					$tdl_height = get_post_meta($post->ID, 'tdl_height', true);
					$choice_actions = get_post_meta($post->ID, 'choice_actions', true);
					$choice_redirects = get_post_meta($post->ID, 'choice_redirects', true);
					$choice_citiess = get_post_meta($post->ID, 'choice_citiess', true);
					$choice_districs = get_post_meta($post->ID, 'choice_districs', true);
					$choice_wardss = get_post_meta($post->ID, 'choice_wardss', true);
					$choice_cys = get_post_meta($post->ID, 'choice_cys', true);
					$address_map = get_post_meta($post->ID, 'address_map', true);
				?>
				<ul>
					<li><span class="tdl_price"><?php echo esc_html("Giá:","tdl");?></span><?php echo esc_attr($tdl_price);?><span><?php echo esc_attr($choice_cys);?></span></li>
					<li><span class="tdl_size"><?php echo esc_html("Diện Tích:","tdl");?></span><?php echo esc_attr($tdl_width * $tdl_height);?><span><?php echo esc_html("m2","tdl");?></span></li>
					<li><span class="tdl_redirect"><?php echo esc_html("Hướng:","tdl");?></span><?php echo esc_attr($choice_redirects);?></li>
					<li><span class="tdl_cities"><?php echo esc_html("Tỉnh/T.Phố:","tdl");?></span><?php echo esc_attr($choice_citiess);?></li>
					<li><span class="tdl_districs"><?php echo esc_html("Quận/Huyện:","tdl");?></span><?php echo esc_attr($choice_districs);?></li>
					<li><span class="tdl_wardss"><?php echo esc_html("Phường/Xã:","tdl");?></span><?php echo esc_attr($choice_wardss);?></li>
				</ul>
			</div>
			<div class="tdl-garelly-image">
				<?php 
				the_post_thumbnail('full');
				$images = get_post_meta($post->ID, 'tdc_gallery_id', true);
				if($images):?>
					<ul class="tdl-garelly-slider">
						<li><a href="<?php the_permalink();?>" class="active"><?php the_post_thumbnail('large');?></a></li>
					<?php 
						foreach ($images as $image) {?>
							<li><a href="<?php echo wp_get_attachment_url($image, 'large');?>"><?php echo wp_get_attachment_image($image, 'large');?></a></li>
						<?php }?>
					</ul>
				<?php endif;?>
				<div class="tdl-navigation">
					<div class="tdl-prev" title="Previous">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="65px" height="65px" viewBox="-11 -11.5 65 66">
							<g>
								<g>
									<path fill="#474544" d="M-10.5,22.118C-10.5,4.132,4.133-10.5,22.118-10.5S54.736,4.132,54.736,22.118
							c0,17.985-14.633,32.618-32.618,32.618S-10.5,40.103-10.5,22.118z M-8.288,22.118c0,16.766,13.639,30.406,30.406,30.406 c16.765,0,30.405-13.641,30.405-30.406c0-16.766-13.641-30.406-30.405-30.406C5.35-8.288-8.288,5.352-8.288,22.118z" />
									<path fill="#474544" d="M25.43,33.243L14.628,22.429c-0.433-0.432-0.433-1.132,0-1.564L25.43,10.051c0.432-0.432,1.132-0.432,1.563,0	c0.431,0.431,0.431,1.132,0,1.564L16.972,21.647l10.021,10.035c0.432,0.433,0.432,1.134,0,1.564	c-0.215,0.218-0.498,0.323-0.78,0.323C25.929,33.569,25.646,33.464,25.43,33.243z" />
								</g>
							</g>
						</svg>
					</div>
					<div class="tdl-next" title="Next">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="65px" height="65px" viewBox="-11 -11.5 65 66">
							<g>
								<g>
									<path fill="#474544" d="M22.118,54.736C4.132,54.736-10.5,40.103-10.5,22.118C-10.5,4.132,4.132-10.5,22.118-10.5	c17.985,0,32.618,14.632,32.618,32.618C54.736,40.103,40.103,54.736,22.118,54.736z M22.118-8.288	c-16.765,0-30.406,13.64-30.406,30.406c0,16.766,13.641,30.406,30.406,30.406c16.768,0,30.406-13.641,30.406-30.406 C52.524,5.352,38.885-8.288,22.118-8.288z" />
									<path fill="#474544" d="M18.022,33.569c 0.282,0-0.566-0.105-0.781-0.323c-0.432-0.431-0.432-1.132,0-1.564l10.022-10.035 			L17.241,11.615c 0.431-0.432-0.431-1.133,0-1.564c0.432-0.432,1.132-0.432,1.564,0l10.803,10.814c0.433,0.432,0.433,1.132,0,1.564 L18.805,33.243C18.59,33.464,18.306,33.569,18.022,33.569z" />
								</g>
							</g>
						</svg>
					</div>
				</div>
			</div>
			<div class="entry-box-title clearfix">
				<h3 class="entry-title"><?php the_title();?></h3>
			</div>
			<div class="main-post">		
				<?php the_content();?>
			</div><!-- /.main-post -->
		</article><!-- #post-## -->
	<?php endwhile; // end of the loop. ?>
	</main>
</div>
<?php get_footer();?>