<?php
function My_Metabox(){
	add_meta_box( 'estate_box', 'Estate Option', 'func_meta_estate', 'estate' );
}
add_action('add_meta_boxes', 'My_Metabox');
function func_meta_estate($post){
	$tdl_price = get_post_meta($post->ID,'tdl_price',true);
	$tdl_width = get_post_meta($post->ID,'tdl_width',true);
	$tdl_height = get_post_meta($post->ID,'tdl_height',true);
	$tdl_size = get_post_meta($post->ID,'tdl_size',true);
	$choice_actions = get_post_meta($post->ID,'choice_actions',true);
	$choice_redirects = get_post_meta($post->ID,'choice_redirects',true);
	$choice_citiess = get_post_meta($post->ID,'choice_citiess',true);
	$choice_districs = get_post_meta($post->ID,'choice_districs',true);
	$choice_wardss = get_post_meta($post->ID,'choice_wardss',true);
	$choice_cys = get_post_meta($post->ID,'choice_cys',true);
	$address_map = get_post_meta($post->ID,'address_map',true);
	wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
    $ids = get_post_meta($post->ID, 'tdc_gallery_id', true);
	?>
	<div class="wrap-estate">
		<table>
			<tr>
				<td style="width:20%">Choose Action</td>
				<td>
					<select id="choice_actions" name="choice_actions" style="width:100%">
						<option value="Bán Đất" <?php selected($choice_actions, 'Bán Đất', true ); ?>>Bán Đất</option>
						<option value="Thuê" <?php selected($choice_actions, 'Thuê', true ); ?>>Thuê</option>
					</select>
					<input type="hidden" size="80" id="choice_action" name="choice_action" value="<?php echo esc_attr($choice_actions);?>"/>
				</td>
			</tr>
			<tr>
				<td style="width:20%">Input Price</td>
				<td>
					<input type="text" size="60" id="tdl_price" name="tdl_price" value="<?php echo esc_attr($tdl_price);?>"/>
					<select id="choice_cys" name="choice_cys" style="width:20%">
						<option value="Tỉ" <?php selected($choice_cys, 'Tỉ', true ); ?>>Tỉ</option>
						<option value="Triệu" <?php selected($choice_cys, 'Triệu', true ); ?>>Triệu</option>
					</select>
					<input type="hidden" size="10" id="choice_cy" name="choice_cy" value="<?php echo esc_attr($choice_cys);?>"/>
				</td>
			</tr>
			<tr>
				<td style="width:20%">Width X Height</td>
				<td>
					<input type="text" size="20" id="tdl_width" name="tdl_width" value="<?php echo esc_attr($tdl_width);?>"/>
					<input type="text" size="20" id="tdl_height" name="tdl_height" value="<?php echo esc_attr($tdl_height);?>"/>
					<input type="text" size="20" id="tdl_size" name="tdl_size" value="<?php echo esc_attr($tdl_size);?>"/>
				</td>
			</tr>
			<tr>
				<td style="width:20%">Choose Direction</td>
				<td>
					<select id="choice_redirects" name="choice_redirects" style="width:100%">
						<option value="Đông" <?php selected($choice_redirects, 'Đông', true ); ?>>Đông</option>
						<option value="Tây" <?php selected($choice_redirects, 'Tây', true ); ?>>Tây</option>
						<option value="Nam" <?php selected($choice_redirects, 'Nam', true ); ?>>Nam</option>
						<option value="Bắc" <?php selected($choice_redirects, 'Bắc', true ); ?>>Bắc</option>
						<option value="Đông Nam" <?php selected($choice_redirects, 'Đông Nam', true ); ?>>Đông Nam</option>
						<option value="Đông Bắc" <?php selected($choice_redirects, 'Đông Bắc', true ); ?>>Đông Bắc</option>
						<option value="Tây Bắc" <?php selected($choice_redirects, 'Tây Bắc', true ); ?>>Tây Bắc</option>
						<option value="Tây Nam" <?php selected($choice_redirects, 'Tây Nam', true ); ?>>Tây Nam</option>
					</select>
					<input type="hidden" size="80" id="choice_redirect" name="choice_redirect" value="<?php echo esc_attr($choice_redirects);?>"/>
				</td>
			</tr>
			<tr>
				<td style="width:20%">Input City</td>
				<td><input type="text" size="80" id="choice_citiess" name="choice_citiess" value="<?php echo esc_attr($choice_citiess);?>"/></td>
				<!--
				<td>
					<select id="choice_citiess" name="choice_citiess" style="width:100%">
						<option data-idt="T15" value="Đà Nẵng" <?php /*selected($choice_citiess, 'Đà Nẵng', true ); */?>>Đà Nẵng</option>
						<option data-idt="T24" value="Thành Phố Hà Nội" <?php /*selected($choice_citiess, 'Thành Phố Hà Nội', true ); */?>>Thành Phố Hà Nội</option>
					</select>
					<input type="hidden" size="80" id="choice_cities" name="choice_cities" value="<?php /*echo esc_attr($choice_citiess);*/?>"/>
				</td>
				!-->
			</tr>
			<tr>
				<td style="width:20%">Input District</td>
				<td><input type="text" size="80" id="choice_districs" name="choice_districs" value="<?php echo esc_attr($choice_districs);?>"/></td>
				<!--
				<td>
					<select id="choice_districs" name="choice_districs" style="width:100%">
						<option data-wa="T1" value="An Giang" <?php /*selected($choice_districs, '', true ); */?>>No District</option>
					</select>
					<input type="hidden" size="80" id="choice_distric" name="choice_distric" value="<?php /*echo esc_attr($choice_districs);*/?>"/>
				</td>
				!-->
			</tr>
			<tr>
				<td style="width:20%">Input Wards</td>
				<td><input type="text" size="80" id="choice_wardss" name="choice_wardss" value="<?php echo esc_attr($choice_wardss);?>"/></td>
				<!--
				<td>
					<select id="choice_wardss" name="choice_wardss" style="width:100%">
						<option data-wa="T1" value="An Giang" <?php /*selected($choice_wardss, '', true ); */?>>No Wards</option>
					</select>
					<input type="hidden" size="80" id="choice_wards" name="choice_wards" value="<?php /*echo esc_attr($choice_wardss);*/?>"/>
				</td>
				!-->
			</tr>
			<tr>
				<?php
					wp_nonce_field(basename(__FILE__), 'address_map_nonce');
					$value = get_post_meta($post->ID, 'address_map', true);
				?>
				<td style="width:20%">Address Map</td>
				<td><textarea type="textarea" cols="83" rows="3" id="address_map" name="address_map"><?php echo wp_kses_post($value);?></textarea></td>
			</tr>
		</table>
		<div class="all_images_list">
			<div class="wrap">
				<a class="gallery-add button" href="#" data-uploader-title="Add new images" data-uploader-button-text="Add new images">Add more images</a>
				<ul id="gallery-metabox-list">
				<?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
				<li>
				   <input type="hidden" name="tdc_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
				   <img class="image-preview" src="<?php echo $image[0]; ?>">
				   <a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br>
				   <small><a class="remove-image" href="#">Delete image</a></small>
				</li>
				<?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
function func_save_meta($post_id){
	if (!current_user_can('edit_post', $post_id)) return;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if ( isset( $_POST['tdl_price'] )) {
		update_post_meta($post_id, 'tdl_price', $_POST['tdl_price'] );
	}
	if ( isset( $_POST['tdl_width'] )) {
		update_post_meta($post_id, 'tdl_width', $_POST['tdl_width'] );
	}
	if ( isset( $_POST['tdl_height'] )) {
		update_post_meta($post_id, 'tdl_height', $_POST['tdl_height'] );
	}
	if ( isset( $_POST['tdl_size'] )) {
		update_post_meta($post_id, 'tdl_size', $_POST['tdl_size'] );
	}
	if ( isset( $_POST['choice_redirects'] )){
		update_post_meta( $post_id, 'choice_redirects', sanitize_text_field( wp_unslash( $_POST['choice_redirects'])) );
	}
	if ( isset( $_POST['choice_citiess'] )){
		update_post_meta( $post_id, 'choice_citiess', sanitize_text_field( wp_unslash( $_POST['choice_citiess'])) );
	}
	if ( isset( $_POST['choice_districs'] )){
		update_post_meta( $post_id, 'choice_districs', sanitize_text_field( wp_unslash( $_POST['choice_districs'])) );
	}
	if ( isset( $_POST['choice_wardss'] )){
		update_post_meta( $post_id, 'choice_wardss', sanitize_text_field( wp_unslash( $_POST['choice_wardss'])) );
	}
	if ( isset( $_POST['choice_cys'] )){
		update_post_meta( $post_id, 'choice_cys', sanitize_text_field( wp_unslash( $_POST['choice_cys'])) );
	}
	if ( isset( $_POST['address_map'] )){
		update_post_meta($post_id, 'address_map', strip_tags($_POST['address_map']));
	}
	if ( isset( $_POST['choice_actions'] )) {
		update_post_meta( $post_id, 'choice_actions', sanitize_text_field( wp_unslash( $_POST['choice_actions'])) );
	}
	if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;
	if(isset($_POST['tdc_gallery_id'])) {
		update_post_meta($post_id, 'tdc_gallery_id', $_POST['tdc_gallery_id']);
	}else{
		delete_post_meta($post_id, 'tdc_gallery_id');
	}
}
add_action( 'save_post','func_save_meta');