<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$limit = get_option('rp_post_per_page');
$column = get_option('rp_columns');
$image_title = get_option('background_title');
$heading_title = get_option('heading_page_title');
$sub_heading = get_option('sub_page_title');
$rp_padding = get_option('padding_page_title');
$css_animation = get_option('rp_animated');
$length = get_option('number_excerpt');
$excerpt = get_option('more_excerpt');
$rp_class = array();
$rp_class[] = rp_getCSSAnimation($css_animation);
$args = array(
	'post_type'      => 'mg_recipes',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	'paged'          => $paged
);
$wp_query = new WP_Query($args);
?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58c66589c6acc5e3"></script>
<div class="wrapper_recipes">
	<div class="rp-page-title" style="background:url(<?php echo esc_url($image_title);?>) center /cover no-repeat;padding:<?php echo esc_attr($rp_padding);?> 0;">
		<div class="rp-content-title">
			<h3 class="rp-heading-title"><?php echo esc_attr($heading_title);?></h3>
			<p class="rp_sub_title"><?php echo esc_attr($sub_heading);?></p>
		</div>
	</div>
	<div class="rp-content-area">
		<?php if( have_posts()):
			while ($wp_query->have_posts()) : $wp_query->the_post();
			$serves = get_post_meta($post->ID,'serves',true);
			$serves_to = get_post_meta($post->ID,'serves_to',true);
			$hours = get_post_meta($post->ID,'hours',true);
			$hours_to = get_post_meta($post->ID,'hours_to',true);
			$mins = get_post_meta($post->ID,'mins',true);
			$mins_to = get_post_meta($post->ID,'mins_to',true);
			$link_face = get_post_meta($post->ID,'link_face',true);
			$link_twitter = get_post_meta($post->ID,'link_twitter',true);
			$name_betyg = get_post_meta($post->ID,'name_betyg',true);
			?>
				<div class="recipes-animation rp-column<?php echo esc_attr($column); echo esc_attr(implode('', $rp_class));?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
					<div class="rp-thumbnails">
						<?php
							if(has_post_thumbnail()):?>
								<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
						<?php endif;?>
					</div>
					<div class="rp-content">
						<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<div class="rp-experct">
							<?php echo rp_custom_excerpt($length,$excerpt);?>
						</div>
						<ul class="rp-lists">
							<li class="recipetiledeet">
							<i class="fa fa-cutlery"></i>
							<span>
								<?php echo esc_attr($serves);
								if($name_betyg && empty($serves_to)) echo '<span class="rp_ok">'.esc_attr($name_betyg).'</span>';
								?>
							</span>
							<?php if($serves_to):
							echo esc_html("-");?>
							<span><?php echo esc_attr($serves_to);
							if($name_betyg) echo '<span class="rp_ok">'.esc_attr($name_betyg).'</span>';
							?>
							</span>
							<?php endif;?>
							</li>
							<?php if($hours):?>
								<li class="rp-hourse">
									<i class="fa fa-clock-o"></i>
									<span><?php echo esc_attr($hours);?> <?php if(empty($hours_to)) echo 'hours';?></span>
									<?php								
									if($hours_to):
									echo esc_html("to");?>
										<span><?php echo esc_attr($hours_to);?> hours</span>
									<?php endif;?>
								</li>
							<?php endif;?>
							<?php if($mins):?>
								<li class="rp-mins">
									<i class="fa fa-clock-o"></i>
									<span><?php echo esc_attr($mins);?> <?php if(empty($mins_to)) echo 'minutes';?></span>
									<?php 
									if($mins_to):
									echo esc_html("-");?>
										<span><?php echo esc_attr($mins_to);?> minutes</span>
									<?php endif;?>
								</li>
							<?php endif;?>
						</ul>
						<div class="share-addthis">
						<?php
							$content = '<!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>';
							echo wp_kses_post($content);
						?>
						</div>
					</div>
					</article>
				</div>
			<?php endwhile;endif?>
		<div class="clearfix"></div>
	</div>
</div>
<?php get_footer();?>