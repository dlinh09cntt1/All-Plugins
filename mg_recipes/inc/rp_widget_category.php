<?php
if(!class_exists('Rp_Categories_Widget')){
	class Rp_Categories_Widget extends WP_Widget{
		function __construct(){
			$widget_ops = array(
				'description' => esc_html__('Show all category Recipes.','rp')
			);
			$control_ops = array(
				'title'  => '',
				'limit' => 2
			);
			parent::__construct( 'rp_categories', esc_html__( 'Recipes - Categories', 'rp' ), $widget_ops, $control_ops );
		}
		function widget($args,$instance){
			extract( $args );
			$title   = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$limit   = empty( $instance['limit'] ) ? 4 : ( int ) $instance['limit'];
			echo wp_kses_post( $before_widget );
			if (! empty( $title)) {
				echo wp_kses_post( $before_title . $title . $after_title );
			}
			$args = array(
				'post_type'      => 'mg_recipes',
				'post_status'    => 'publish',
				'posts_per_page' => $limit
			);
			$wp_query = new WP_Query($args);?>
			<ul class="rp-latest-post">
			<?php
				if( have_posts()):
				while ($wp_query->have_posts()) : $wp_query->the_post();?>
					<li>
					<div class="rp-thumbnails">
						<?php
							if(has_post_thumbnail()):?>
							<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
						<?php endif;?>
					</div>
					<div class="wp-widget-post">
						<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<?php
						$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
						if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
							$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
						}
						$time_string = sprintf( $time_string,
							esc_attr( get_the_date( 'c' ) ),
							get_the_date(),
							esc_attr( get_the_modified_date( 'c' ) ),
							get_the_modified_date()
						);
						?>
						<a href="<?php echo esc_url( get_permalink() );?>"><?php echo wp_kses_post($time_string); ?></a>
					</div>
					</li>
				<?php endwhile;endif;?>
			</ul>
			<?php echo wp_kses_post($after_widget );
		}
		function update($new_instance,$old_instance){
			$instance = $old_instance;
			$instance['title']   = strip_tags( $new_instance['title'] );
			$instance['limit']   = strip_tags( $new_instance['limit'] );
			return $instance;
		}
		function form($instance){
			$instance  = wp_parse_args( ( array ) $instance, array( 'title' => '', 'limit' => 4));
			$title = strip_tags($instance['title']);
			$limit = intval($instance['limit']);
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'rp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php echo esc_html__( 'Number of Category:', 'rp' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="number" min="1" value="<?php echo esc_attr( $limit ); ?>" />
			</p>
			<?php
		}
	}
}
function register_rp_categories_widget(){
	register_widget('Rp_Categories_Widget');
}
add_action('widgets_init','register_rp_categories_widget');