<?php
/*Recommended Post*/
class AuthorRecommendedPosts{
	static $html_newline = "\n";
    var $namespace = "author_recommended_posts";
	function __construct() {
        $this->option_name = '_' . $this->namespace . '--options';
        $this->friendly_name = __( "Piala Recommended Posts", $this->namespace );
		$this->_add_hooks();
    }
	static function instance() {
        global $AuthorRecommendedPosts;
        if( !isset( $AuthorRecommendedPosts ) ) $AuthorRecommendedPosts = new AuthorRecommendedPosts();
    }
	private function _add_hooks() {
        add_action( 'add_meta_boxes', array( &$this, 'piala_add_recommended_meta_box' ) );
        add_action( 'save_post', array( &$this, 'saving_recommended_posts_ids' ), 10, 2 );
        add_action( 'wp_ajax_author_recommended_posts_search', array( &$this, 'author_recommended_posts_search') );
    }
	/*add recommend*/
	function piala_add_recommended_meta_box(){
		add_meta_box( 
			'piala_recommended',
			__( 'Recommended Posts', 'Piala Recommend'),
			array( &$this, 'piala_recommended_meta_box' ),
			'post',
			'side',
			'high'
		);
	}
	function piala_recommended_meta_box( $object, $box ) {
		$author_recommended_posts = get_post_meta( $object->ID, $this->namespace, true );
		$author_recommended_posts_search_results = $this->author_recommended_posts_search();?>
		<div style="display:none;">
			<?php wp_nonce_field( "{$this->namespace}_post_ids_nonce", '_post_ids_nonce' ); ?>
		</div>
		<div id="recommended-posts-items">
			<div id="recommended-posts-items-container">
				<?php 
				if( $author_recommended_posts ) {
					foreach( $author_recommended_posts as $author_recommended_post ) : ?>
						<?php if(get_post_type($author_recommended_post)){ ?>
							<div class="author-recommended-post-row" data-post_id="<?php echo $author_recommended_post; ?>">
								<span class="ui-handle"></span>
								<span class="recommended-post-title"><?php echo get_the_title( $author_recommended_post ); ?></span>
								<input type="hidden" name="author-recommended-posts[]" value="<?php echo $author_recommended_post; ?>" />
								<a href="#remove" class="button remove-recommended-post">&#215;</a>
							</div>
						<?php } ?>
					<?php endforeach;
				} ?>
			</div>
			<div id="recommended-posts-search">
				<label for="author-recommended-posts-search">Search...</label>
				<input class="widefat" type="text" name="author-recommended-posts-search" id="author-recommended-posts-search" />
			</div>
			<div id="recommended-posts-results">
				<ul>
				<?php echo $author_recommended_posts_search_results; ?>
				</ul>
			</div>
		</div>
	<?php
	}
	function author_recommended_posts_search(){
		global $post;
		$post_id = $post->ID;
		$html = '';
		$options = array(
			'post_type' =>  'post',
			'posts_per_page' => -1,
			'paged' => 0,
			'order' => 'DESC',
			'post_status' => array('publish'),
			'suppress_filters' => false,
			'post__not_in' => array($post_id),
			's' => ''
		);
		$ajax = isset( $_POST['action'] ) ? true : false;
		if( $ajax ) {
			$options = array_merge($options, $_POST);
		}
		if( $options['s'] ) {
			$options['like_title'] = $options['s'];
			add_filter( 'posts_where', array($this, 'posts_where'), 10, 2 );
		}
		unset( $options['s'] );
		$searchable_posts = get_posts( $options );
		if( $searchable_posts ) {
			foreach( $searchable_posts as $searchable_post ) {
				$title = '<span class="recommended-posts-post-type">';
				$title .= $searchable_post->post_type;
				$title .= '</span>';
				$title .= '<span class="recommended-posts-title">';
				$title .= apply_filters( 'the_title', $searchable_post->post_title, $searchable_post->ID );
				$title .= '</span>';
				$html .= '<li><a href="' . get_permalink($searchable_post->ID) . '" data-post_id="' . $searchable_post->ID . '">' . $title .  '</a></li>' . "\n";
			}
		}
		if( $ajax ) {
			die( $html );
		} else {
			return $html;
		}
	}
	function posts_where( $where, &$wp_query ) {
		global $wpdb;
		if ( $title = $wp_query->get('like_title') ) {
			$where .= " AND " . $wpdb->posts . ".post_title LIKE '%" . esc_sql( like_escape( $title ) ) . "%'";
		}
		return $where;
	}
	private function _sanitize( $str ) {
        if ( !function_exists( 'wp_kses' ) ) {
            require_once( ABSPATH . 'wp-includes/kses.php' );
        }
        global $allowedposttags;
        global $allowedprotocols;
        
        if ( is_string( $str ) ) {
            $str = wp_kses( $str, $allowedposttags, $allowedprotocols );
        } elseif( is_array( $str ) ) {
            $arr = array();
            foreach( (array) $str as $key => $val ) {
                $arr[$key] = $this->_sanitize( $val );
            }
            $str = $arr;
        }
        return $str;
    }
	function saving_recommended_posts_ids( $post_id, $post ) {
		if( isset( $_REQUEST['_post_ids_nonce'] ) && !empty( $_REQUEST['_post_ids_nonce'] ) ){
			if( !wp_verify_nonce( $_REQUEST['_post_ids_nonce'], "{$this->namespace}_post_ids_nonce" ) ) {
				return $post_id;
			}
			$post_type = get_post_type_object( $post->post_type );
			if( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
				return $post_id;
			}
			$new_meta_value = ( isset( $_POST['author-recommended-posts'] ) ? $this->_sanitize( $_POST['author-recommended-posts'] ) : '' );
			$meta_key = $this->namespace;
			$meta_value = get_post_meta( $post_id, $meta_key, true );
			if ( $new_meta_value && ( '' == $meta_value ) ) {
				add_post_meta( $post_id, $meta_key, $new_meta_value, true );
			} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $post_id, $meta_key, $new_meta_value );
			} elseif ( ( '' == $new_meta_value ) && $meta_value ) {
				delete_post_meta( $post_id, $meta_key, $meta_value );
			}
		}
	}
}
if( !isset( $AuthorRecommendedPosts ) ) {
	AuthorRecommendedPosts::instance();
}