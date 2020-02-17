<?php
if (! function_exists( 'rp_getCSSAnimation' ) ) {
	function rp_getCSSAnimation( $css_animation ) {
		$output = '';
		if ( $css_animation != '' ) {
			wp_enqueue_script('waypoints');
			$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;
		}
		return $output;
	}
}
if (! function_exists( 'rp_social_share')){
	function rp_social_share(){
		echo '<ul class="rp-social-share">';
		echo '<li><div class="facebook-social"><a target="_blank" class="facebook"  href="https://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '" title="' . esc_attr__( 'Facebook', 'freshvegetable' ) . '"><i class="fa fa-facebook"></i></a></div></li>';
		echo '<li><div class="twitter-social"><a target="_blank" class="twitter" href="https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . rawurlencode( esc_attr( get_the_title() ) ) . '" title="' . esc_attr__( 'Twitter', 'freshvegetable' ) . '"><i class="fa fa-twitter"></i></a></div></li>';
		echo '</ul>';
	}
}
function rp_custom_excerpt($limit,$more){
	$excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . esc_attr( $more );
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}