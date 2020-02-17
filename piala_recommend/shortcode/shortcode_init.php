<?php
function pia_blog_ajax_recommend( $atts ){
	global $post;
	ob_start();
	$recommended_ids = get_post_meta($post->ID,'author_recommended_posts',true);
	if(!empty($recommended_ids)){
		foreach( $recommended_ids as $recommended_id ){
			$recommended_post_thumbnail = false;
			$recommended_post_thumbnail_id = get_post_thumbnail_id( $recommended_id );
			$recommended_post_thumbnail_src = wp_get_attachment_image_src( $recommended_post_thumbnail_id, 'medium', true );?>
			<article id="post-<?php the_ID();?>" class ="piala_recommend" >
				<div class="col-md-3 items">
					<a href="<?php echo get_permalink( $recommended_id ); ?>"><img src="<?php echo $recommended_post_thumbnail_src[0]; ?>"  alt="<?php echo get_the_title( $recommended_id ); ?>"></a>
					<h3><a href="<?php echo get_permalink( $recommended_id ); ?>"><?php echo get_the_title( $recommended_id ); ?></a></h3>
				</div>
			</article>
			<?php
		}
	}
	return ob_get_clean();
}
add_shortcode('pia_recommend_blog', 'pia_blog_ajax_recommend');