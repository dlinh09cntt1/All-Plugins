<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Tdl_Widget_FilterAjax extends WP_Widget{
	function __construct(){
		$this->defaults = array(
            'title' 	=> '',
			'show_cat'  => 0,
            'show_full' => 0           
        );
        parent::__construct(
            'widget_tdl_filter_ajax',
            esc_html__( 'tdl filter ajax', 'tdl' ),
            array(
                'classname'   => 'widget_tdl_filter_ajax',
                'description' => esc_html__( 'Ajax Filter.','tdl')
            )
        );
    }
	function widget( $args, $instance ){
		extract($args);
		global $post;
		$title = empty($instance['title']) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$show_cat = isset($instance['show_cat'])? 1:0;
		$show_full = isset($instance['show_full'])? 1:0;
		ob_start();
		echo wpressthim_filtercontent($before_widget);
		if ( !empty($title) ) echo  $before_title.$title.$after_title;
		/*Price and Size*/
		$get_price = array();
		$get_size = array();
		$i = $m = 0;
		$_argsp = array(
			'post_type' => 'estate',
			'post_status' => 'publish',
		);
		$wpp_p = new WP_Query( $_argsp );
		if($wpp_p->have_posts()){
			while ($wpp_p->have_posts()) {
				$wpp_p->the_post();
				$tdl_price = get_post_meta($post->ID, 'tdl_price', true);
				$get_price[$i] = doubleval($tdl_price);
				$tdl_size = get_post_meta($post->ID,'tdl_size',true);
				$get_size[$m] = intval($tdl_size);
				$i++;
				$m++;
			 }
		 }
		$max_price = doubleval($get_price[0]);
		$min_price = doubleval($get_price[0]);
		$max_size = $get_size[0];
		$min_size = $get_size[0];
		 for($j = 0,$k = 0; $j < count($get_price),$k < count($get_size); $j++,$k++){
			$max_price = ($get_price[$j] > $max_price) ? $get_price[$j] : $max_price;
			$min_price = ($get_price[$j] < $min_price) ? $get_price[$j] : $min_price;
			$max_size =  ($get_size[$k] > $max_size) ? $get_size[$k] : $max_size;
			$min_size =  ($get_size[$k] < $min_size) ? $get_size[$k] : $min_size;
		}
		?>
		<form class="tdl-filter-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label><?php echo esc_html__("Hình Thức");?></label>
			<select id="tdl_actions" name="tdl_actions" style="width:100%">
				<option value="Bán Đất"><?php echo esc_html_e("Bán Đất");?></option>
				<option value="Thuê"><?php echo esc_html_e("Thuê");?></option>
			</select>
			<input type="hidden" size="80" id="tdl_action" name="tdl_action" value="Sell ​​land"/>
			<label><?php echo esc_html__("Chọn Hướng");?></label>
			<select id="choice_redirects" name="choice_redirects" style="width:100%">
				<option value="Đông"><?php echo esc_html_e("Đông");?></option>
				<option value="Tây"><?php echo esc_html_e("Tây");?></option>
				<option value="Nam"><?php echo esc_html_e("Nam");?></option>
				<option value="Bắc"><?php echo esc_html_e("Bắc");?></option>
				<option value="Đông Nam"><?php echo esc_html_e("Đông Nam");?></option>
				<option value="Đông Bắc"><?php echo esc_html_e("Đông Bắc");?></option>
				<option value="Tây Bắc"><?php echo esc_html_e("Tây Bắc");?></option>
				<option value="Tây Nam"><?php echo esc_html_e("Tây Nam");?></option>
			</select>
			<input type="hidden" size="80" id="tdl_redirects" name="tdl_redirects" value="East"/>
			<label><?php echo esc_html__("Tỉnh/Thành Phố");?></label>
			<select id="choice_citiess" name="choice_citiess" style="width:100%">
				<option data-idt="T15" value="Đà Nẵng"><?php echo esc_html_e("Đà Nẵng");?></option>
				<option data-idt="T24" value="Hà Nội"><?php echo esc_html_e("Hà Nội");?></option>
			</select>
			<input type="hidden" size="80" id="tdl_citiess" name="tdl_citiess" value="Đà Nẵng"/>
			<label><?php echo esc_html__("Quận/Huyện");?></label>
			<select id="choice_districs" name="choice_districs" style="width:100%">
				<option data-wa="T15" value="Cẩm Lệ"><?php echo esc_html_e("Cẩm Lệ");?></option>
			</select>
			<input type="hidden" size="80" id="tdl_districs" name="tdl_districs" value="Cẩm Lệ"/>
			<label><?php echo esc_html__("Phường/Xã");?></label>
			<select id="choice_wardss" name="choice_wardss" style="width:100%">
				<option data-wa="T15" value="Hòa Cầm"><?php echo esc_html_e("Hòa Cầm");?></option>
			</select>
			<input type="hidden" size="80" id="tdl_wardss" name="tdl_wardss" value="Hòa Cầm"/>
			<!-- Size and Price -->
			<div class="tdl_sizes">
				<div id="slider-size">
					<label for="amount"><?php echo esc_html__("Diện Tích");?></label>
					<input type="text" id="min_size" name="min_size" value="<?php echo esc_attr($min_size);?>" />
					<input type="text" id="max_size" name="max_size" value="<?php echo esc_attr($max_size);?>" />
					<div id="slider-range-size"></div>
				</div>
			</div>
			<div class="tdl_prices">
				<div id="slider-holder">
					<label for="amount"><?php echo esc_html__("Chọn Giá");?></label>
					<input type="text" id="pricefrom" name="pricefrom" value="<?php echo esc_attr(doubleval($min_price));?>" />
					<input type="text" id="priceto" name="priceto" value="<?php echo esc_attr(doubleval($max_price));?>" />
					<div id="slider-range"></div>
				</div>
			</div>
			<!-- End Size end Price -->
			<div class="filter-content">
				<button type="submit" id="searchsubmit"><?php echo esc_html__("Tìm Kiếm","tdl");?></button>
				<input type="hidden" name="post_type" value="estate">
			</div>
		</form>
		<?php 
		echo wpressthim_filtercontent($after_widget);
		echo ob_get_clean();
	}
	function update($new_instance, $old_instance){
		$instance                   = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
		$instance['show_cat']       = isset( $new_instance['show_cat'] )?1:0;
		$instance['show_full']      = isset( $new_instance['show_full'] )?1:0;
        return $instance;
	}
	function form( $instance ){
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$show_cat = isset( $instance['show_cat']) ? 1:0;
		$show_full = isset( $instance['show_full']) ? 1:0;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'tdl' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_cat); ?> id="<?php echo esc_attr( $this->get_field_id('show_cat')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_cat')); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('show_cat')); ?>"><?php esc_html_e( 'Show Categories ?', 'tdl' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_full); ?> id="<?php echo esc_attr( $this->get_field_id('show_full')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_full')); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id('show_full')); ?>"><?php esc_html_e( 'Show Fullwidth ?', 'tdl' ); ?></label>
		</p>
	<?php 
	}
}
function register_tdl_widget_ajaxfilter(){
	register_widget('Tdl_Widget_FilterAjax');
}
add_action('widgets_init', 'register_tdl_widget_ajaxfilter');