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
$rp_class = array();
$rp_class[] = rp_getCSSAnimation($css_animation);
?>
<div class="wrapper_recipes">
	<div class="rp-content-single">
		<?php if( have_posts()):
			while (have_posts()):the_post();
			$serves = get_post_meta($post->ID,'serves',true);
			$serves_to = get_post_meta($post->ID,'serves_to',true);
			$hours = get_post_meta($post->ID,'hours',true);
			$hours_to = get_post_meta($post->ID,'hours_to',true);
			$mins = get_post_meta($post->ID,'mins',true);
			$mins_to = get_post_meta($post->ID,'mins_to',true);
			$link_face = get_post_meta($post->ID,'link_face',true);
			$link_twitter = get_post_meta($post->ID,'link_twitter',true);
			$name_betyg = get_post_meta($post->ID,'name_betyg',true);
			$facebook = get_post_meta($post->ID,'link_face',true);
			$link_twitter = get_post_meta($post->ID,'link_twitter',true);
			$prep = get_post_meta($post->ID,'prep',true);
			?>
				<div class="recipes-animation <?php echo esc_attr(implode('', $rp_class));?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
					<div class="rp-thumbnails-content">
						<?php
							if(has_post_thumbnail()) :
								the_post_thumbnail();
							endif;
						?>
						<div class="title-share">
							<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<?php echo rp_social_share();?>
						</div>
						<div class="rp-content-single">
							<ul class="rp-lists-single">
								<li class="recipetiledeet">
								<p><i class="fa fa-cutlery"></i><span>SERVES</span></p>
								<h4>
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
								</h4>
								<?php endif;?>
								</li>
								<?php if($prep):?>
								<li class="rp-prep">
									<p><i class="fa fa-clock-o"></i><span>Prep</span></p>
									<h4><?php echo esc_attr($prep);?><span> MINUTES</span></h4>
								</li>
								<?php
								endif;
								if($hours):?>
									<li class="rp-hourse">
										<p><i class="fa fa-clock-o"></i><span>COOKING</span></p>
										<h4>
										<span><?php echo esc_attr($hours);?> <?php if(empty($hours_to)) echo 'hours';?></span>
										<?php								
										if($hours_to):
										echo esc_html("to");?>
											<span><?php echo esc_attr($hours_to);?> hours</span>
										<?php endif;?>
										</h4>
									</li>
								<?php endif;?>
								<?php if($mins):?>
									<li class="rp-mins">
										<p><i class="fa fa-clock-o"></i><span>COOKING</span></p>
										<h4>
										<span><?php echo esc_attr($mins);?> <?php if(empty($mins_to)) echo 'minutes';?></span>
										<?php 
										if($mins_to):
										echo esc_html("-");?>
											<span><?php echo esc_attr($mins_to);?> minutes</span>
										<?php endif;?>
										</h4>
									</li>
								<?php endif;?>
							</ul>
						</div>
					</div>
					<div class="single-content">
						<?php the_content();?>
					</div>
					</article>
				</div>
			<?php endwhile;endif?>
		<div class="clearfix"></div>
	</div>
</div>
<?php get_footer();?>