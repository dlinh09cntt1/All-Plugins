<?php
function My_Metabox(){
	add_meta_box( 'casino_box', 'Casino Option', 'func_meta_casino', 'casino' );
}
add_action('add_meta_boxes', 'My_Metabox');
function func_meta_casino($post){
	$link_images = get_post_meta($post->ID,'link_images',true);
	$number_list = get_post_meta($post->ID,'number_list',true);
	$button = get_post_meta($post->ID,'button_text',true);
	$link_button = get_post_meta($post->ID,'link_button',true);
	$freespin = get_post_meta($post->ID,'free_spin',true);
	$bonus = get_post_meta($post->ID,'bonus',true);
	$bet_spin = get_post_meta($post->ID,'bet_spin',true);
	$bet_bonus = get_post_meta($post->ID,'bet_bonus',true);
	$betyg = get_post_meta($post->ID,'betyg',true);
	$name_betyg = get_post_meta($post->ID,'name_betyg',true);
	$link_betyg = get_post_meta($post->ID,'link_betyg',true);
	?>
	<table>
		<tr>
			<td style="width:20%">Link Image</td>
			<td><input type="text" size="80" id="link_images" name="link_images" value="<?php echo esc_attr($link_images);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Number List</td>
			<td><input type="text" size="80" id="number_list" name="number_list" value="<?php echo esc_attr($number_list);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Name Button</td>
			<td><input type="text" size="80" id="button_text" name="button_text" value="<?php echo esc_attr($button);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Link Button</td>
			<td><input type="text" size="80" id="link_button" name="link_button" value="<?php echo esc_attr($link_button);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Free Spin</td>
			<td><input type="text" size="80" id="free_spin" name="free_spin" value="<?php echo esc_attr($freespin);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Bonus</td>
			<td><input type="text" size="80" id="bonus" name="bonus" value="<?php echo esc_attr($bonus);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Bet Spin</td>
			<td><input type="text" size="80" id="bet_spin" name="bet_spin" value="<?php echo esc_attr($bet_spin);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Bet Bonus</td>
			<td><input type="text" size="80" id="bet_bonus" name="bet_bonus" value="<?php echo esc_attr($bet_bonus);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Betyg</td>
			<td>
				<select id="betyg" name="betyg">
					<option value="1" <?php selected( $betyg, '1' ); ?>>1</option>
					<option value="2" <?php selected( $betyg, '2' ); ?>>2</option>
					<option value="3" <?php selected( $betyg, '3' ); ?>>3</option>
					<option value="4" <?php selected( $betyg, '4' ); ?>>4</option>
					<option value="5" <?php selected( $betyg, '5' ); ?>>5</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="width:20%">Name Betys</td>
			<td><input type="text" size="80" id="name_betyg" name="name_betyg" value="<?php echo esc_attr($name_betyg);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Link Betys</td>
			<td><input type="text" size="80" id="link_betyg" name="link_betyg" value="<?php echo esc_attr($link_betyg);?>"/></td>
		</tr>
	</table>
	<?php
}
function func_save_meta($post_id){
	if ( isset( $_POST['link_images'] ) && $_POST['link_images'] != '' ) {
		update_post_meta($post_id, 'link_images', $_POST['link_images'] );
	}
	if ( isset( $_POST['number_list'] ) && $_POST['number_list'] != '' ) {
		update_post_meta($post_id, 'number_list', $_POST['number_list'] );
	}
	if ( isset( $_POST['button_text'] ) && $_POST['button_text'] != '' ) {
		update_post_meta($post_id, 'button_text', $_POST['button_text'] );
	}
	if ( isset( $_POST['link_button'] ) && $_POST['link_button'] != '' ) {
		update_post_meta($post_id, 'link_button', $_POST['link_button'] );
	}
	if ( isset( $_POST['free_spin'] ) && $_POST['free_spin'] != '' ) {
		update_post_meta($post_id, 'free_spin', $_POST['free_spin'] );
	}
	if ( isset( $_POST['bonus'] ) && $_POST['bonus'] != '' ) {
		update_post_meta($post_id, 'bonus', $_POST['bonus'] );
	}
	if ( isset( $_POST['bet_spin'] ) && $_POST['bet_spin'] != '' ) {
		update_post_meta($post_id, 'bet_spin', $_POST['bet_spin'] );
	}
	if ( isset( $_POST['bet_bonus'] ) && $_POST['bet_bonus'] != '' ) {
		update_post_meta($post_id, 'bet_bonus', $_POST['bet_bonus'] );
	}
	if ( isset( $_POST['betyg'] ) && $_POST['betyg'] != '' ) {
		update_post_meta($post_id, 'betyg', $_POST['betyg'] );
	}
	if ( isset( $_POST['name_betyg'] ) && $_POST['name_betyg'] != '' ) {
		update_post_meta($post_id, 'name_betyg', $_POST['name_betyg'] );
	}
	if ( isset( $_POST['link_betyg'] ) && $_POST['link_betyg'] != '' ) {
		update_post_meta($post_id, 'link_betyg', $_POST['link_betyg'] );
	}
}
add_action( 'save_post','func_save_meta');