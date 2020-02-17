<?php
function My_Metabox(){
	add_meta_box( 'recipes_box', 'Recipes Option', 'func_meta_recipes', 'mg_recipes' );
}
add_action('add_meta_boxes', 'My_Metabox');
function func_meta_recipes($post){
	$serves = get_post_meta($post->ID,'serves',true);
	$serves_to = get_post_meta($post->ID,'serves_to',true);
	$hours = get_post_meta($post->ID,'hours',true);
	$hours_to = get_post_meta($post->ID,'hours_to',true);
	$mins = get_post_meta($post->ID,'mins',true);
	$mins_to = get_post_meta($post->ID,'mins_to',true);
	$link_face = get_post_meta($post->ID,'link_face',true);
	$link_twitter = get_post_meta($post->ID,'link_twitter',true);
	$name_betyg = get_post_meta($post->ID,'name_betyg',true);
	$prep = get_post_meta($post->ID,'prep',true);
	?>
	<table>
		<tr>
			<td style="width:20%">Serves</td>
			<td><input type="text" size="80" id="serves" name="serves" value="<?php echo esc_attr($serves);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Serves To</td>
			<td><input type="text" size="80" id="serves_to" name="serves_to" value="<?php echo esc_attr($serves_to);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Hours</td>
			<td><input type="text" size="80" id="hours" name="hours" value="<?php echo esc_attr($hours);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Hours To</td>
			<td><input type="text" size="80" id="hours_to" name="hours_to" value="<?php echo esc_attr($hours_to);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Mins</td>
			<td><input type="text" size="80" id="mins" name="mins" value="<?php echo esc_attr($mins);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Mins To</td>
			<td><input type="text" size="80" id="mins_to" name="mins_to" value="<?php echo esc_attr($mins_to);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Link Facebook</td>
			<td><input type="text" size="80" id="link_face" name="link_face" value="<?php echo esc_attr($link_face);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Link Twitter</td>
			<td><input type="text" size="80" id="link_twitter" name="link_twitter" value="<?php echo esc_attr($link_twitter);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Name Serves</td>
			<td><input type="text" size="80" id="name_betyg" name="name_betyg" value="<?php echo esc_attr($name_betyg);?>"/></td>
		</tr>
		<tr>
			<td style="width:20%">Prep</td>
			<td><input type="text" size="80" id="prep" name="prep" value="<?php echo esc_attr($prep);?>"/></td>
		</tr>
	</table>
	<?php
}
function func_save_meta($post_id){
	if ( isset( $_POST['serves'] ) && $_POST['serves'] != '' ) {
		update_post_meta($post_id, 'serves', $_POST['serves'] );
	}
	if ( isset( $_POST['serves_to'] ) && $_POST['serves_to'] != '' ) {
		update_post_meta($post_id, 'serves_to', $_POST['serves_to'] );
	}
	if ( isset( $_POST['hours'] ) && $_POST['hours'] != '' ) {
		update_post_meta($post_id, 'hours', $_POST['hours'] );
	}
	if ( isset( $_POST['hours_to'] ) && $_POST['hours_to'] != '' ) {
		update_post_meta($post_id, 'hours_to', $_POST['hours_to'] );
	}
	if ( isset( $_POST['mins'] ) && $_POST['mins'] != '' ) {
		update_post_meta($post_id, 'mins', $_POST['mins'] );
	}
	if ( isset( $_POST['mins_to'] ) && $_POST['mins_to'] != '' ) {
		update_post_meta($post_id, 'mins_to', $_POST['mins_to'] );
	}
	if ( isset( $_POST['link_face'] ) && $_POST['link_face'] != '' ) {
		update_post_meta($post_id, 'link_face', $_POST['link_face'] );
	}
	if ( isset( $_POST['link_twitter'] ) && $_POST['link_twitter'] != '' ) {
		update_post_meta($post_id, 'link_twitter', $_POST['link_twitter'] );
	}
	if ( isset( $_POST['name_betyg'] ) && $_POST['name_betyg'] != '' ) {
		update_post_meta($post_id, 'name_betyg', $_POST['name_betyg'] );
	}
	if ( isset( $_POST['prep'] ) && $_POST['prep'] != '' ) {
		update_post_meta($post_id, 'prep', $_POST['prep'] );
	}
}
add_action( 'save_post','func_save_meta');