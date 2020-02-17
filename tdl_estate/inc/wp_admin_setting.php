<?php
if(!class_exists('TDL_Estate_Setting_Admin')){
	class TDL_Estate_Setting_Admin{
		public static $_instance = null;
		public static function instance(){
			if ( is_null( self::$_instance )) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		public function __construct(){
			$this->settings_group = 'tdl_estate_setting';
			add_action( 'admin_init', array( $this, 'tdl_estate_register_settings' ));
			add_action( 'admin_menu', array( $this, 'sub_menu_page_init' ));
		}
		public function init_tdl_estate_setting(){
			$this->settings = apply_filters( 'tdl_estate_settings',
				array(
					'general_tdl_estate' => array(
						__( 'General Estate', 'cs' ),
						array(
							array(
								'name'        => 'cs_post_per_page',
								'label'      => __( 'Post Per Page', 'cs' ),
								'desc'       => __( 'Input number of tdl_estate', 'cs' ),
								'type'       => 'text',
								'std'        => '-1',
							),
							array(
								'name'    => 'show_loadmore',
								'label'   => __('Show or Hide Loadmore','cs'),
								'desc'    => __('checked show or hide of load more'),
								'type'    => 'checkbox',
								'std'     => '1',
								'attributes' => array()
							),
							array(
								'name'    => 'show_viewless',
								'label'   => __('Show or Hide View Less','cs'),
								'desc'    => __('checked show or hide of view less'),
								'type'    => 'checkbox',
								'std'     => '1',
								'attributes' => array()
							),
							array(
								'name'    => 'show_column_tdl_estate',
								'label'   => __('Show or Hide column tdl_estate','cs'),
								'desc'    => __('checked show or hide of column'),
								'type'    => 'checkbox',
								'std'     => '1',
								'attributes' => array()
							),
							array(
								'name'    => 'show_column_button',
								'label'   => __('Show or Hide button column','cs'),
								'desc'    => __('checked show or hide of column'),
								'type'    => 'checkbox',
								'std'     => '1',
								'attributes' => array()
							),
							array(
								'name'    => 'show_column_spin',
								'label'   => __('Show or Hide Spin column','cs'),
								'desc'    => __('checked show or hide of column'),
								'type'    => 'checkbox',
								'std'     => '1',
								'attributes' => array()
							),
							array(
								'name'    => 'show_column_bonus',
								'label'   => __('Show or Hide Bonus column','cs'),
								'desc'    => __('checked show or hide of column'),
								'type'    => 'checkbox',
								'std'     => '1',
								'attributes' => array()
							),
							array(
								'name'    => 'show_column_info',
								'label'   => __('Show or Hide Info column','cs'),
								'desc'    => __('checked show or hide of column'),
								'type'    => 'checkbox',
								'std'     => '1',
								'attributes' => array()
							),
							array(
								'name'    => 'show_column_betting',
								'label'   => __('Show or Hide Betting column','cs'),
								'desc'    => __('checked show or hide of column'),
								'type'    => 'checkbox',
								'std'     => '1',
								'attributes' => array()
							),
							array(
								'name'    => 'show_column_betyg',
								'label'   => __('Show or Hide Betyg column','cs'),
								'desc'    => __('checked show or hide of column'),
								'type'    => 'checkbox',
								'std'     => '1',
								'attributes' => array()
							),
							array(
								'name'  => 'border_heading',
								'label' => __('Border Heading','cs'),
								'desc'  => __('choice size of border','cs'),
								'std'   => '0',
								'type'  => 'select',
								'options' => array(
									'0' => '0',
									'1' => '1px',
									'2' => '2px',
									'3' => '3px'
								)
							),
							array(
								'name'  => 'border_section',
								'label' => __('Border Section','cs'),
								'desc'  => __('choice size of border','cs'),
								'std'   => '0',
								'type'  => 'select',
								'options' => array(
									'0' => '0',
									'1' => '1px',
									'2' => '2px',
									'3' => '3px'
								)
							)
						),
					),
				)
			);
		}
		public function tdl_estate_register_settings(){
			$this->init_tdl_estate_setting();
			foreach ( $this->settings as $section ) {
				foreach ( $section[1] as $option ) {
					if ( isset( $option['std'] ) )
						add_option( $option['name'], $option['std'] );
					register_setting( $this->settings_group, $option['name'] );
				}
			}
		}
		public function sub_menu_page_init() {
			add_submenu_page( 'edit.php?post_type=estate', esc_html__( 'Settings', 'cs' ), esc_html__( 'Settings', 'cs' ), 'manage_options', 'tdl_estate-settings', array( $this, 'tdl_estate_settings_render' ));
		}
		public function tdl_estate_settings_render() {?>
        <div class="wrap tdl_estate-settings-wrap">
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
                        echo '<div class="updated job-manager-updated"><p>' . __( 'Settings successfully saved', 'cs' ) . '</p></div>';
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
                            switch ( $option['type'] ) {
                                case "checkbox" :
                                    ?><label><input id="setting-<?php echo $option['name']; ?>" name="<?php echo $option['name']; ?>" type="checkbox" value="1" <?php echo implode( ' ', $attributes ); ?> <?php checked( '1', $value ); ?> /></label><?php
                                    if ( $option['desc'] )
                                        echo ' <span class="description">' . $option['desc'] . '</span>';
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
                                case "text" :
                                    ?><input id="setting-<?php echo $option['name']; ?>" class="<?php echo $option['name']; ?>a" type="text" name="<?php echo $option['name']; ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo implode( ' ', $attributes ); ?> <?php echo $placeholder; ?> /><?php
                                    if ( $option['desc'] ) {
                                        echo ' <p class="description">' . $option['desc'] . '</p>';
                                    }
                                break;
								case "image-logo" :?>
									<div class="image_ctl">
									<input id="logo_containers" class="<?php echo $option['name']; ?>a" type="url" name="<?php echo $option['name']; ?>" value="<?php echo esc_attr( $value );?>"> 
									<a href="#" class="remove_logo"><i class="fa fa-close"></i></a>
									<a href="#" id="logo_image_url" class="button" > Select </a>
									</div>
								<?php
								break;
                                default :
                                    do_action( 'tdl_estate_admin_field_' . $option['type'], $option, $attributes, $value, $placeholder );
                                break;
                            }
                            echo '</td></tr>';
                        }
                        echo '</table></div>';
                    }
                ?>
                <p class="submit">
                    <input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'cs' ); ?>" />
                </p>
            </form>
        </div>
		<?php }
	}
}
TDL_Estate_Setting_Admin::instance();