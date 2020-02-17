<?php
/*Xử lý Ajax*/
add_action( 'wp_ajax_tdl_instagram_ok', 'tdl_instagram_ok' );
add_action( 'wp_ajax_nopriv_tdl_instagram_ok', 'tdl_instagram_ok' );
function tdl_instagram_ok() {
    $datas = (array)$_POST['args'];
	$number = $_POST['paged'];
	if (isset($datas)){
		$limit = $number*2;
		$i=0;
		foreach ( $datas as $item ) {
			$link  = $item['link'];
			$image = $item['src'];
			if($i <= $limit){?>
			<li class="images_item"><a href="<?php echo esc_url($link);?>"><img width="200" height="200" src="<?php echo esc_url($image );?>" alt="Instagram" /></a></li>
			<?php }
			$i++;
		}
	}
    exit;
}