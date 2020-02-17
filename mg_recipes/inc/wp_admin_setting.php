<?php
if(!class_exists('Recipes_Setting_Admin')){
	class Recipes_Setting_Admin{
		public static $_instance = null;
		public static function instance(){
			if ( is_null( self::$_instance )) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		public function __construct(){
			$this->settings_group = 'recipes_setting';
			add_action( 'admin_init', array( $this, 'recipes_register_settings' ));
			add_action( 'admin_menu', array( $this, 'sub_menu_page_init' ));
		}
		public function init_recipes_setting(){
			$this->settings = apply_filters( 'recipes_settings',
				array(
					'general_recipes' => array(
						__( 'General Recipes', 'rp' ),
						array(
							array(
								'name'        => 'rp_post_per_page',
								'label'      => __( 'Post Per Page', 'rp' ),
								'desc'       => __( 'Input number of recipes', 'rp' ),
								'type'       => 'text',
								'std'        => '-1',
							),
							array(
								'name'  => 'rp_columns',
								'label' => __('Columns','rp'),
								'desc'  => __('choice column of archive','rp'),
								'std'   => '3',
								'type'  => 'select',
								'options' => array(
									'1' => '1 column',
									'2' => '2 columns',
									'3' => '3 columns'
								)
							),
							array(
								'name'  => 'rp_animated',
								'label' => __('Animation','rp'),
								'desc'  => __('choice animation of archive','rp'),
								'std'   => '',
								'type'  => 'select',
								'options' => array(
									'' => 'No',
									'wpb_top-to-bottom' => 'Top to bottom',
									'wpb_bottom-to-top' => 'Bottom to top',
									'wpb_left-to-right' => 'Left to right',
									'wpb_right-to-left' => 'Right to left',
									'wpb_appear' => 'Appear from center',
								)
							),
							array(
								'name'        => 'background_title',
								'label'      => __( 'Page Title', 'rp' ),
								'desc'       => __( 'Upload image of field', 'rp'),
								'type'       => 'image-logo',
							),
							array(
								'name'        => 'heading_page_title',
								'label'      => __( 'Heading Page Title', 'rp' ),
								'desc'       => __( 'Input heading of recipes', 'rp' ),
								'type'       => 'text',
								'std'        => '',
							),
							array(
								'name'        => 'sub_page_title',
								'label'      => __( 'Heading Sub Title', 'rp' ),
								'desc'       => __( 'Input heading of recipes', 'rp' ),
								'type'       => 'text',
								'std'        => '',
							),
							array(
								'name'        => 'padding_page_title',
								'label'      => __( 'Padding Page Title(Top/Bottom)', 'rp' ),
								'desc'       => __( 'Input padding of recipes(50px)', 'rp' ),
								'type'       => 'text',
								'std'        => '80px',
							),
							array(
								'name'        => 'number_excerpt',
								'label'      => __( 'Length Excerpt', 'rp' ),
								'desc'       => __( 'Input lenght experct', 'rp' ),
								'type'       => 'text',
								'std'        => '25',
							),
							array(
								'name'        => 'more_excerpt',
								'label'      => __( 'More Excerpt', 'rp' ),
								'desc'       => __( 'Input more experct', 'rp' ),
								'type'       => 'text',
								'std'        => '...',
							)
						),
					),
				)
			);
		}
		public function recipes_register_settings(){
			$this->init_recipes_setting();
			foreach ( $this->settings as $section ) {
				foreach ( $section[1] as $option ) {
					if ( isset( $option['std'] ) )
						add_option( $option['name'], $option['std'] );
					register_setting( $this->settings_group, $option['name'] );
				}
			}
		}
		public function sub_menu_page_init() {
			add_submenu_page( 'edit.php?post_type=mg_recipes', esc_html__( 'Settings', 'rp' ), esc_html__( 'Settings', 'rp' ), 'manage_options', 'recipes-settings', array( $this, 'recipes_settings_render' ));
		}
		public function recipes_settings_render(){?>
        <div class="wrap recipes-settings-wrap">
            <form method="post" action="options.php">
                <?php settings_fields( $this->settings_group ); ?>
                <h2 class="nav-tab-wrapper">
                    <?php
					$i=0;
					foreach ( $this->settings as $key => $section ) {?>
						<a href="#settings-<?php echo sanitize_title( $key );?>" class="nav-tab <?php if($i==0) echo 'nav-tab-active';?>"><?php echo esc_html($section[0]);?></a>
					<?php $i++;}?>
                </h2>
					<?php
                    if ( ! empty( $_GET['settings-updated'] ) ) {
                        flush_rewrite_rules();
                        echo '<div class="updated job-manager-updated"><p>' . __( 'Settings successfully saved', 'rp' ) . '</p></div>';
                    }
                    foreach ( $this->settings as $key => $section ) {
                        echo '<div id="settings-' . sanitize_title( $key ) . '" class="settings_panel">';
                        echo '<table class="form-table">';
                        foreach ( $section[1] as $option ) {
                            $placeholder    = ( ! empty( $option['placeholder'] ) ) ? 'placeholder="' . $option['placeholder'] . '"' : '';
                            $class          = ! empty( $option['class'] ) ? $option['class'] : '';
                            $value          = get_option( $option['name'] );
                            $option['type'] = ! empty( $option['type'] ) ? $option['type'] : '';
                            $attributes     = array();
                            if ( ! empty( $option['attributes'] ) && is_array( $option['attributes'] ) )
                                foreach ( $option['attributes'] as $attribute_name => $attribute_value )
                                    $attributes[] = esc_attr( $attribute_name ) . '="' . esc_attr( $attribute_value ) . '"';
                            echo '<tr valign="top" class="' . $class . '"><th scope="row"><label for="setting-' . $option['name'] . '">' . $option['label'] . '</a></th><td>';
                            switch ( $option['type'] ){
                                case "text" :
                                    ?><input id="setting-<?php echo $option['name']; ?>" class="<?php echo $option['name']; ?>a" type="text" name="<?php echo $option['name']; ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo implode( ' ', $attributes ); ?> <?php echo $placeholder; ?> /><?php
                                    if ( $option['desc'] ) {
                                        echo ' <p class="description">' . $option['desc'] . '</p>';
                                    }
                                break;
								case "select" :
                                    ?><select id="setting-<?php echo $option['name']; ?>" class="<?php echo $option['name']; ?>a" name="<?php echo $option['name']; ?>" <?php echo implode( ' ', $attributes ); ?>><?php
                                        foreach( $option['options'] as $key => $name )
                                            echo '<option value="' . esc_attr( $key ) . '" ' . selected( $value, $key, false ) . '>' . esc_html( $name ) . '</option>';
                                    ?></select><?php
                                    if ( $option['desc'] ) {
                                        echo ' <p class="description">' . $option['desc'] . '</p>';
                                    }
                                break;
								case "image-logo":?>
								<div class="checl_logos">
									<div class="inner-logo">
										<input type="hidden" id="child_logo_url" name="<?php echo $option['name'];?>" value="<?php echo esc_attr( $value );?>"/>
										<img src="<?php echo esc_attr( $value );?>" class="hide_show"/>
									</div>
									<input id="child_upload_logo_button" type="button" class="button" value="Upload Image" /> 
									<span class="wpt-cancel" style="display:none"></span>
								</div>
								<?php break;
                                default :
                                    do_action( 'recipes_admin_field_' . $option['type'], $option, $attributes, $value, $placeholder );
                                break;
                            }
                            echo '</td></tr>';
                        }
                        echo '</table></div>';
                    }
                ?>
                <p class="submit">
                    <input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'rp' ); ?>" />
                </p>
            </form>
        </div>
		<?php }
	}
}
Recipes_Setting_Admin::instance();