<?php
if(!function_exists('func_tdl_instagram_inits')){
	function func_tdl_instagram_inits(){
		/*get value options*/
		$tdl_title = get_option('tdl_title');
		$tdl_per_page = get_option('tdl_per_page');
		$tdl_user_id = get_option('tdl_user_id');
		$tdl_token = get_option('tdl_token');
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		ob_start();
		$transient_var = $tdl_user_id;
		if(false === ($items = get_transient($transient_var ))){
			$response = wp_remote_get( 'https://api.instagram.com/v1/users/' . esc_attr($tdl_user_id) . '/media/recent/?access_token=' . esc_attr($tdl_token));
			if ( ! is_wp_error( $response ) ) {
				$response_body = json_decode( $response['body'] );
				if ( $response_body->meta->code !== 200 ) {
					echo '<p>Incorrect user ID specified.</p>';
				}
				$items_as_objects = $response_body->data;
				$items = array();
				foreach ( $items_as_objects as $item_object ) {
					$item['link'] = $item_object->link;
					$item['src']  = $item_object->images->low_resolution->url;
					$items[]      = $item;
				}
				set_transient( $transient_var, $items, 60 * 60 );
			}
		}
		?>
		<ul class="tdl-instagram">
		<?php
		$i=0;
		if (isset($items)){
			foreach ( $items as $item ) {
				$link  = $item['link'];
				$image = $item['src'];
				$i++;
				if($i <= $tdl_per_page){?>
				<li class="images_item"><a href="<?php echo esc_url($link);?>"><img width="200" height="200" src="<?php echo esc_url($image );?>" alt="Instagram" /></a></li>
			<?php }
			}
		}
		?>
		</ul>
		<div class="tdl-loadmore"><a href="#" data-args='<?php echo json_encode($items);?>' data-paged='<?php echo esc_attr($tdl_per_page);?>'><?php echo esc_html("Load more","ajp");?></a></div>
		<?php 
		return ob_get_clean();
	}
}
add_shortcode('tdl_instagram_block','func_tdl_instagram_inits');