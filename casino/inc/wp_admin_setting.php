<?php
if(!class_exists('Casino_Setting_Admin')){
	class Casino_Setting_Admin{
		public $fonts = false;
		public static $_instance = null;
		public $font_icon  = array( 'fa-adjust', 'fa-adn', 'fa-align-center', 'fa-align-justify', 'fa-align-left', 'fa-align-right', 'fa-ambulance', 'fa-anchor', 'fa-android', 'fa-angle-double-down', 'fa-angle-double-left', 'fa-angle-double-right', 'fa-angle-double-up', 'fa-angle-down', 'fa-angle-left', 'fa-angle-right', 'fa-angle-up', 'fa-apple', 'fa-archive', 'fa-arrow-circle-down', 'fa-arrow-circle-left', 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-left', 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-up', 'fa-arrow-circle-right', 'fa-arrow-circle-up', 'fa-arrow-down', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-up', 'fa-arrows', 'fa-arrows-alt', 'fa-arrows-h', 'fa-arrows-v', 'fa-asterisk', 'fa-automobile', 'fa-backward', 'fa-ban', 'fa-bank', 'fa-bar-chart-o', 'fa-barcode', 'fa-bars', 'fa-beer', 'fa-behance', 'fa-behance-square', 'fa-bell', 'fa-bell-o', 'fa-bitbucket', 'fa-bitbucket-square', 'fa-bitcoin', 'fa-bold', 'fa-bolt', 'fa-bomb', 'fa-book', 'fa-bookmark', 'fa-bookmark-o', 'fa-briefcase', 'fa-btc', 'fa-bug', 'fa-building', 'fa-building-o', 'fa-bullhorn', 'fa-bullseye', 'fa-cab', 'fa-calendar', 'fa-calendar-o', 'fa-camera', 'fa-camera-retro', 'fa-car', 'fa-caret-down', 'fa-caret-left', 'fa-caret-right', 'fa-caret-square-o-down', 'fa-caret-square-o-left', 'fa-caret-square-o-right', 'fa-caret-square-o-up', 'fa-caret-up', 'fa-certificate', 'fa-chain', 'fa-chain-broken', 'fa-check', 'fa-check-circle', 'fa-check-circle-o', 'fa-check-square', 'fa-check-square-o', 'fa-chevron-circle-down', 'fa-chevron-circle-left', 'fa-chevron-circle-right', 'fa-chevron-circle-up', 'fa-chevron-down', 'fa-chevron-left', 'fa-chevron-right', 'fa-chevron-up', 'fa-child', 'fa-circle', 'fa-circle-o', 'fa-circle-o-notch', 'fa-circle-thin', 'fa-clipboard', 'fa-clock-o', 'fa-cloud', 'fa-cloud-download', 'fa-cloud-upload', 'fa-cny', 'fa-code', 'fa-code-fork', 'fa-codepen', 'fa-coffee', 'fa-cog', 'fa-cogs', 'fa-columns', 'fa-comment', 'fa-comment-o', 'fa-comments', 'fa-comments-o', 'fa-compass', 'fa-compress', 'fa-copy', 'fa-credit-card', 'fa-crop', 'fa-crosshairs', 'fa-css3', 'fa-cube', 'fa-cubes', 'fa-cut', 'fa-cutlery', 'fa-dashboard', 'fa-database', 'fa-dedent', 'fa-delicious', 'fa-desktop', 'fa-deviantart', 'fa-digg', 'fa-dollar', 'fa-dot-circle-o', 'fa-download', 'fa-dribbble', 'fa-dropbox', 'fa-drupal', 'fa-edit', 'fa-eject', 'fa-ellipsis-h', 'fa-ellipsis-v', 'fa-empire', 'fa-envelope', 'fa-envelope-o', 'fa-envelope-square', 'fa-eraser', 'fa-eur', 'fa-euro', 'fa-exchange', 'fa-exclamation', 'fa-exclamation-circle', 'fa-exclamation-triangle', 'fa-expand', 'fa-external-link', 'fa-external-link-square', 'fa-eye', 'fa-eye-slash', 'fa-facebook', 'fa-facebook-square', 'fa-fast-backward', 'fa-fast-forward', 'fa-fax', 'fa-female', 'fa-fighter-jet', 'fa-file', 'fa-file-archive-o', 'fa-file-audio-o', 'fa-file-code-o', 'fa-file-excel-o', 'fa-file-image-o', 'fa-file-movie-o', 'fa-file-o', 'fa-file-pdf-o', 'fa-file-photo-o', 'fa-file-picture-o', 'fa-file-powerpoint-o', 'fa-file-sound-o', 'fa-file-text', 'fa-file-text-o', 'fa-file-video-o', 'fa-file-word-o', 'fa-file-zip-o', 'fa-files-o', 'fa-film', 'fa-filter', 'fa-fire', 'fa-fire-extinguisher', 'fa-flag', 'fa-flag-checkered', 'fa-flag-o', 'fa-flash', 'fa-flask', 'fa-flickr', 'fa-floppy-o', 'fa-folder', 'fa-folder-o', 'fa-folder-open', 'fa-folder-open-o', 'fa-font', 'fa-forward', 'fa-foursquare', 'fa-frown-o', 'fa-gamepad', 'fa-gavel', 'fa-gbp', 'fa-ge', 'fa-gear', 'fa-gears', 'fa-gift', 'fa-git', 'fa-git-square', 'fa-github', 'fa-github-alt', 'fa-github-square', 'fa-gittip', 'fa-glass', 'fa-globe', 'fa-google', 'fa-google-plus', 'fa-google-plus-square', 'fa-graduation-cap', 'fa-group', 'fa-h-square', 'fa-hacker-news', 'fa-hand-o-down', 'fa-hand-o-left', 'fa-hand-o-right', 'fa-hand-o-up', 'fa-hdd-o', 'fa-header', 'fa-headphones', 'fa-heart', 'fa-heart-o', 'fa-history', 'fa-home', 'fa-hospital-o', 'fa-html5', 'fa-image', 'fa-inbox', 'fa-indent', 'fa-info', 'fa-info-circle', 'fa-inr', 'fa-instagram', 'fa-institution', 'fa-italic', 'fa-joomla', 'fa-jpy', 'fa-jsfiddle', 'fa-key', 'fa-keyboard-o', 'fa-krw', 'fa-language', 'fa-laptop', 'fa-leaf', 'fa-legal', 'fa-lemon-o', 'fa-level-down', 'fa-level-up', 'fa-life-bouy', 'fa-life-ring', 'fa-life-saver', 'fa-lightbulb-o', 'fa-link', 'fa-linkedin', 'fa-linkedin-square', 'fa-linux', 'fa-list', 'fa-list-alt', 'fa-list-ol', 'fa-list-ul', 'fa-location-arrow', 'fa-lock', 'fa-long-arrow-down', 'fa-long-arrow-left', 'fa-long-arrow-right', 'fa-long-arrow-up', 'fa-magic', 'fa-magnet', 'fa-mail-forward', 'fa-mail-reply', 'fa-mail-reply-all', 'fa-male', 'fa-map-marker', 'fa-maxcdn', 'fa-medkit', 'fa-meh-o', 'fa-microphone', 'fa-microphone-slash', 'fa-minus', 'fa-minus-circle', 'fa-minus-square', 'fa-minus-square-o', 'fa-mobile', 'fa-mobile-phone', 'fa-money', 'fa-moon-o', 'fa-mortar-board', 'fa-music', 'fa-navicon', 'fa-openid', 'fa-outdent', 'fa-pagelines', 'fa-paper-plane', 'fa-paper-plane-o', 'fa-paperclip', 'fa-paragraph', 'fa-paste', 'fa-pause', 'fa-paw', 'fa-pencil', 'fa-pencil-square', 'fa-pencil-square-o', 'fa-phone', 'fa-phone-square', 'fa-photo', 'fa-picture-o', 'fa-pied-piper', 'fa-pied-piper-alt', 'fa-pied-piper-square', 'fa-pinterest', 'fa-pinterest-square', 'fa-plane', 'fa-play', 'fa-play-circle', 'fa-play-circle-o', 'fa-plus', 'fa-plus-circle', 'fa-plus-square', 'fa-plus-square-o', 'fa-power-off', 'fa-print', 'fa-puzzle-piece', 'fa-qq', 'fa-qrcode', 'fa-question', 'fa-question-circle', 'fa-quote-left', 'fa-quote-right', 'fa-ra', 'fa-random', 'fa-rebel', 'fa-recycle', 'fa-reddit', 'fa-reddit-square', 'fa-refresh', 'fa-renren', 'fa-reorder', 'fa-repeat', 'fa-reply', 'fa-reply-all', 'fa-retweet', 'fa-rmb', 'fa-road', 'fa-rocket', 'fa-rotate-left', 'fa-rotate-right', 'fa-rouble', 'fa-rss', 'fa-rss-square', 'fa-rub', 'fa-ruble', 'fa-rupee', 'fa-save', 'fa-scissors', 'fa-search', 'fa-search-minus', 'fa-search-plus', 'fa-send', 'fa-send-o', 'fa-share', 'fa-share-alt', 'fa-share-alt-square', 'fa-share-square', 'fa-share-square-o', 'fa-shield', 'fa-shopping-cart', 'fa-sign-in', 'fa-sign-out', 'fa-signal', 'fa-sitemap', 'fa-skype', 'fa-slack', 'fa-sliders', 'fa-smile-o', 'fa-sort', 'fa-sort-alpha-asc', 'fa-sort-alpha-desc', 'fa-sort-amount-asc', 'fa-sort-amount-desc', 'fa-sort-asc', 'fa-sort-desc', 'fa-sort-down', 'fa-sort-numeric-asc', 'fa-sort-numeric-desc', 'fa-sort-up', 'fa-soundcloud', 'fa-space-shuttle', 'fa-spinner', 'fa-spoon', 'fa-spotify', 'fa-square', 'fa-square-o', 'fa-stack-exchange', 'fa-stack-overflow', 'fa-star', 'fa-star-half', 'fa-star-half-empty', 'fa-star-half-full', 'fa-star-half-o', 'fa-star-o', 'fa-steam', 'fa-steam-square', 'fa-step-backward', 'fa-step-forward', 'fa-stethoscope', 'fa-stop', 'fa-strikethrough', 'fa-stumbleupon', 'fa-stumbleupon-circle', 'fa-subscript', 'fa-suitcase', 'fa-sun-o', 'fa-superscript', 'fa-support', 'fa-table', 'fa-tablet', 'fa-tachometer', 'fa-tag', 'fa-tags', 'fa-tasks', 'fa-taxi', 'fa-tencent-weibo', 'fa-terminal', 'fa-text-height', 'fa-text-width', 'fa-th', 'fa-th-large', 'fa-th-list', 'fa-thumb-tack', 'fa-thumbs-down', 'fa-thumbs-o-down', 'fa-thumbs-o-up', 'fa-thumbs-up', 'fa-ticket', 'fa-times', 'fa-times-circle', 'fa-times-circle-o', 'fa-tint', 'fa-toggle-down', 'fa-toggle-left', 'fa-toggle-right', 'fa-toggle-up', 'fa-trash-o', 'fa-tree', 'fa-trello', 'fa-trophy', 'fa-truck', 'fa-try', 'fa-tumblr', 'fa-tumblr-square', 'fa-turkish-lira', 'fa-twitter', 'fa-twitter-square', 'fa-umbrella', 'fa-underline', 'fa-undo', 'fa-university', 'fa-unlink', 'fa-unlock', 'fa-unlock-alt', 'fa-unsorted', 'fa-upload', 'fa-usd', 'fa-user', 'fa-user-md', 'fa-users', 'fa-video-camera', 'fa-vimeo-square', 'fa-vine', 'fa-vk', 'fa-volume-down', 'fa-volume-off', 'fa-volume-up', 'fa-warning', 'fa-wechat', 'fa-weibo', 'fa-weixin', 'fa-wheelchair', 'fa-windows', 'fa-won', 'fa-wordpress', 'fa-wrench', 'fa-xing', 'fa-xing-square', 'fa-yahoo', 'fa-yen', 'fa-youtube', 'fa-youtube-play', 'fa-youtube-square' );
		public static function instance(){
			if ( is_null( self::$_instance )) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		public function setFontIcon($set_font){
			$this->font_icon = $set_font;
		}
		public function getFontIcon(){
			return $this->font_icon;
		}
		public function __construct(){
			$this->settings_group = 'casino_setting';
			add_action( 'admin_init', array( $this, 'casino_register_settings' ));
			add_action( 'admin_menu', array( $this, 'sub_menu_page_init' ));
			add_action( 'admin_enqueue_scripts', array( $this, 'load_wp_media_files'));
		}
		public function init_casino_setting(){
			$fonts = $this->get_fonts();
			$list_icon = $this->getFontIcon();
			$this->settings = apply_filters( 'casino_settings',
				array(
					'general_casino' => array(
						__( 'General Casino', 'cs' ),
						array(
							array(
								'name'        => 'cs_post_per_page',
								'label'      => __( 'Post Per Page', 'cs' ),
								'desc'       => __( 'Input number of casino', 'cs' ),
								'type'       => 'text',
								'std'        => '-1',
							),
							array(
								'name'        => 'casino_font',
								'label'      => __( 'Font Family', 'cs' ),
								'desc'       => __( 'Select choice font family of casino', 'cs' ),
								'type'       => 'select-font',
								'std'        => 'Roboto',
								'options'    => $fonts
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
								'name'    => 'show_column_casino',
								'label'   => __('Show or Hide column casino','cs'),
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
					'color_casino' => array(
						__( 'Color Casino', 'cs' ),
						array(
							array(
								'name'        => 'color_one_ca',
								'label'      => __( 'Background Button', 'cs' ),
								'desc'       => __( 'Input Background of button', 'cs'),
								'type'       => 'text',
								'std'        => '#2ecc71',
							),
							array(
								'name'        => 'color_one_text',
								'label'      => __( 'Color Text Button', 'cs' ),
								'desc'       => __( 'Input text color of button', 'cs'),
								'type'       => 'text',
								'std'        => '#ffffff',
							),
							array(
								'name'        => 'color_two_ca',
								'label'      => __( 'Color Free Spins', 'cs' ),
								'desc'       => __( 'Input color of spin', 'cs'),
								'type'       => 'text',
								'std'        => '#fe8147',
							),
							array(
								'name'        => 'color_three_ca',
								'label'      => __( 'Color Bonus', 'cs' ),
								'desc'       => __( 'Input color of bonus', 'cs'),
								'type'       => 'text',
								'std'        => '#1091e2',
							),
							array(
								'name'        => 'color_four_ca',
								'label'      => __( 'Color Icon Info', 'cs' ),
								'desc'       => __( 'Input color of icon', 'cs'),
								'type'       => 'text',
								'std'        => '#2ecc71',
							),
							array(
								'name'        => 'color_four_text',
								'label'      => __( 'Color Text Info', 'cs' ),
								'desc'       => __( 'Input color of text', 'cs'),
								'type'       => 'text',
								'std'        => '#000000',
							),
							array(
								'name'        => 'color_five_ca',
								'label'      => __( 'Color Betyg', 'cs' ),
								'desc'       => __( 'Input color of betyg', 'cs'),
								'type'       => 'text',
								'std'        => '#004f58',
							),
array(
								'name'        => 'color_text_mobile',
								'label'      => __( 'Color Text Mobile Button', 'cs' ),
								'desc'       => __( 'Input color of text', 'cs'),
								'type'       => 'text',
								'std'        => '#ffffff',
							),
							array(
								'name'        => 'background_button_mobile',
								'label'      => __( 'Background Mobile Button', 'cs' ),
								'desc'       => __( 'Input Background Mobile button', 'cs'),
								'type'       => 'text',
								'std'        => '#3498db',
							),
							array(
								'name'        => 'boxshadow_button_mobile',
								'label'      => __( 'Box-Shadow Mobile Button', 'cs' ),
								'desc'       => __( 'Input box-shadow Mobile button', 'cs'),
								'type'       => 'text',
								'std'        => '#2980b9',
							),
							array(
								'name'        => 'background_mobile_hover',
								'label'      => __( 'Background Mobile Hover', 'cs' ),
								'desc'       => __( 'Input background Mobile hover', 'cs'),
								'type'       => 'text',
								'std'        => '#2980b9',
							),
							array(
								'name'        => 'background_tab_list',
								'label'      => __( 'Background Tab', 'cs' ),
								'desc'       => __( 'Input background of tab', 'cs'),
								'type'       => 'text',
								'std'        => '#0095a6',
							),
							array(
								'name'        => 'background_hover_button',
								'label'      => __( 'Background Hover Button', 'cs' ),
								'desc'       => __( 'Input background hover of button', 'cs'),
								'type'       => 'text',
								'std'        => '#27ae60',
							),
							array(
								'name'     => 'casino_background_row',
								'label'    => __('Select Style Row Background','cs'),
								'desc'     => __('Select choice background of row','cs'),
								'type'     => 'select',
								'std'      => 'background_one',
								'options'  => array(
									'background_one' => 'All Row A Background',
									'custom_bg'      => 'Even and Odd'
								)
							),
							array(
								'name'    => 'background_row_casino',
								'label'   => __('All Row A Background','cs'),
								'desc'    => __('Input background of row','cs'),
								'type'    => 'text',
								'std'     => '#ffffff',
							),
							array(
								'name'   => 'background_cs_even',
								'label'  => __('Even Background color','cs'),
								'desc'   => __('Input background of row','cs'),
								'type'   => 'text',
								'std'    => '#ffffff',
							),
							array(
								'name'  => 'background_cs_odd',
								'label' => __('Odd Background Color','cs'),
								'desc'  => __('Input background of row','cs'),
								'type'  => 'text',
								'std'   => '#ffffff',
							),
							array(
								'name'  => 'background_border_heading',
								'label' => __('Border Color Heading','cs'),
								'desc'  => __('Input border color of heading','cs'),
								'type'  => 'text',
								'std'   => '#ffffff',
							),
							array(
								'name'  => 'background_border_section',
								'label' => __('Border Color Section','cs'),
								'desc'  => __('Input border color of section','cs'),
								'type'  => 'text',
								'std'   => '#ffffff',
							),
							array(
								'name'  => 'color_heading',
								'label' => __('Heading Color','cs'),
								'desc'  => __('Input color of heading','cs'),
								'type'  => 'text',
								'std'   => '#ffffff',
							)
						),
					),
					'text_casino' => array(
						__( 'Casino Text', 'cs' ),
						array(
							array(
								'name'        => 'loadmore_text',
								'label'      => __( 'Text Load More', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'Load More',
							),
							array(
								'name'        => 'heading_one',
								'label'      => __( 'Text Heading Casino', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'casino',
							),
							array(
								'name'        => 'heading_two',
								'label'      => __( 'Text Heading Free Spin', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'freespins',
							),
array(
								'name'        => 'heading_sub_spin',
								'label'      => __( 'Text Heading Sub Free Spin', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'freespins',
							),
							array(
								'name'        => 'heading_three',
								'label'      => __( 'Text Bonus', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'bonus',
							),
array(
								'name'        => 'heading_sub_bonus',
								'label'      => __( 'Text Sub Bonus', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'bonus',
							),
							array(
								'name'        => 'heading_four',
								'label'      => __( 'Text Heading Info', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'info',
							),
							array(
								'name'        => 'heading_five',
								'label'      => __( 'Text Heading Omsattningskrav', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'Omsattningskrav',
							),
array(
								'name'        => 'heading_betting',
								'label'      => __( 'Text Heading Betting', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'Omsattningskrav',
							),
							array(
								'name'        => 'heading_bet_spin',
								'label'      => __( 'Text Heading Bet Spin', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'Freespin',
							),
							array(
								'name'        => 'heading_bet_bonus',
								'label'      => __( 'Text Heading Bet Bonus', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'Bonus',
							),
							array(
								'name'        => 'heading_six',
								'label'      => __( 'Text Heading Betyg', 'cs' ),
								'desc'       => __( 'Input text of field', 'cs'),
								'type'       => 'text',
								'std'        => 'betyg',
							),
							array(
								'name'        => 'heading_sevent',
								'label'      => __( 'Text Buton Mobile', 'cs' ),
								'desc'       => __( 'Input text mobile of button', 'cs'),
								'type'       => 'text',
								'std'        => 'Read More',
							),
							array(
								'name'       => 'text_spins_raw',
								'label'      => __('Show or Hide Text Spins','cs'),
								'desc'    => __('checked show or hide of text'),
								'type'       => 'checkbox',
								'std'        => '1',
								'attributes' => array()
							),
							array(
								'name'       => 'text_spins_bonus',
								'label'      => __('Show or Hide Text Bonus','cs'),
								'desc'    => __('checked show or hide of text'),
								'type'       => 'checkbox',
								'std'        => '1',
								'attributes' => array()
							),
array(
								'name'       => 'text_spins_sub',
								'label'      => __('Show or Hide Text Sub Spin','cs'),
								'desc'    => __('checked show or hide of text'),
								'type'       => 'checkbox',
								'std'        => '1',
								'attributes' => array()
							),
							array(
								'name'       => 'text_bonus_sub',
								'label'      => __('Show or Hide Text Sub Bonus','cs'),
								'desc'    => __('checked show or hide of text'),
								'type'       => 'checkbox',
								'std'        => '1',
								'attributes' => array()
							),
							array(
								'name'       => 'text_betting_sub',
								'label'      => __('Show or Hide Text Sub Betting','cs'),
								'desc'    => __('checked show or hide of text'),
								'type'       => 'checkbox',
								'std'        => '1',
								'attributes' => array()
							)
						),
					),
					'image_casino' => array(
						__( 'Images Casino', 'cs' ),
						array(
							array(
								'name'        => 'image_logo_one',
								'label'      => __( 'Logo Image Casino', 'cs' ),
								'desc'       => __( 'Upload logo of field', 'cs'),
								'type'       => 'image-logo',
							),
							array(
								'name'        => 'image_logo_two',
								'label'      => __( 'Logo Image Free Spin', 'cs' ),
								'desc'       => __( 'Upload logo of field', 'cs'),
								'type'       => 'image-logo',
							),
							array(
								'name'        => 'image_logo_three',
								'label'      => __( 'Logo Image Bonus', 'cs' ),
								'desc'       => __( 'Upload logo of field', 'cs'),
								'type'       => 'image-logo',
							),
							array(
								'name'        => 'image_logo_four',
								'label'      => __( 'Logo Image Info', 'cs' ),
								'desc'       => __( 'Upload logo of field', 'cs'),
								'type'       => 'image-logo',
							),
							array(
								'name'        => 'image_logo_five',
								'label'      => __( 'Logo Image Betting', 'cs' ),
								'desc'       => __( 'Upload logo of field', 'cs'),
								'type'       => 'image-logo',
							),
							array(
								'name'        => 'image_logo_six',
								'label'      => __( 'Logo Image Betyg', 'cs' ),
								'desc'       => __( 'Upload logo of field', 'cs'),
								'type'       => 'image-logo',
							),
							array(
								'name'  => 'casino_logo_align',
								'label' => __('Logo Position','cs'),
								'desc'  => __('choice position of logo','cs'),
								'std'   => '',
								'type'  => 'select',
								'options' => array(
									'' => 'none',
									'top' => 'Top Align',
									'left' => 'Left Align',
									'right' => 'Right Align'
								)
							)
						),
					),
					'icon_casino' => array(
						__( 'Icons Casino', 'cs' ),
						array(
							array(
								'name'     => 'casino_icon_loadmore',
								'label'    => __('Icon Load More','cs'),
								'desc'     => __('Select choice icon of element','cs'),
								'type'     => 'select-icon',
								'std'      => 'fa fa-chevron-circle-down',
								'options'  => $list_icon
							),
							array(
								'name'     => 'casino_icon_button',
								'label'    => __('Icon Button','cs'),
								'desc'     => __('Select choice icon of element','cs'),
								'type'     => 'select-icon',
								'std'      => 'fa fa-chevron-circle-down',
								'options'  => $list_icon
							),
							array(
								'name'     => 'casino_icon_spin',
								'label'    => __('Icon Spin','cs'),
								'desc'     => __('Select choice icon of element','cs'),
								'type'     => 'select-icon',
								'std'      => 'fa fa-refresh',
								'options'  => $list_icon
							),
							array(
								'name'     => 'casino_icon_bonus',
								'label'    => __('Icon Bonus','cs'),
								'desc'     => __('Select choice icon of element','cs'),
								'type'     => 'select-icon',
								'std'      => 'fa fa-gift',
								'options'  => $list_icon
							),
						),
					),
					'change_position_casino' => array(
						__( 'Position Columns Casino', 'cs' ),
						array(
							array(
								'name'        => 'position_casino',
								'label'      => __( 'Position Casino', 'cs' ),
								'desc'       => __( 'mouse up or mouse down of button', 'cs'),
								'type'       => 'select',
								'std'        => '1',
								'options' => array(
									'1' => '1',
									'2' => '2',
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
									'7' => '7',
								)
							),
							array(
								'name'        => 'position_button',
								'label'      => __( 'Position Button', 'cs' ),
								'desc'       => __( 'mouse up or mouse down of button', 'cs'),
								'type'       => 'select',
								'std'        => '2',
								'options' => array(
									'1' => '1',
									'2' => '2',
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
									'7' => '7',
								)
							),
							array(
								'name'        => 'position_spin',
								'label'      => __( 'Position Free Spin', 'cs' ),
								'desc'       => __( 'mouse up or mouse down of button', 'cs'),
								'type'       => 'select',
								'std'        => '3',
								'options' => array(
									'1' => '1',
									'2' => '2',
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
									'7' => '7',
								)
							),
							array(
								'name'        => 'position_bonus',
								'label'      => __( 'Position Bonus', 'cs' ),
								'desc'       => __( 'mouse up or mouse down of button', 'cs'),
								'type'       => 'select',
								'std'        => '4',
								'options' => array(
									'1' => '1',
									'2' => '2',
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
									'7' => '7',
								)
							),
							array(
								'name'        => 'position_info',
								'label'      => __( 'Position Info', 'cs' ),
								'desc'       => __( 'mouse up or mouse down of button', 'cs'),
								'type'       => 'select',
								'std'        => '5',
								'options' => array(
									'1' => '1',
									'2' => '2',
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
									'7' => '7',
								)
							),
							array(
								'name'        => 'position_betting',
								'label'      => __( 'Position Betting', 'cs' ),
								'desc'       => __( 'mouse up or mouse down of button', 'cs'),
								'type'       => 'select',
								'std'        => '6',
								'options' => array(
									'1' => '1',
									'2' => '2',
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
									'7' => '7',
								)
							),
							array(
								'name'        => 'position_betyg',
								'label'      => __( 'Position Betyg', 'cs' ),
								'desc'       => __( 'mouse up or mouse down of button', 'cs'),
								'type'       => 'select',
								'std'        => '7',
								'options' => array(
									'1' => '1',
									'2' => '2',
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
									'7' => '7',
								)
							)
						),
					),
				)
			);
		}
		public function casino_register_settings(){
			$this->init_casino_setting();
			foreach ( $this->settings as $section ) {
				foreach ( $section[1] as $option ) {
					if ( isset( $option['std'] ) )
						add_option( $option['name'], $option['std'] );
					register_setting( $this->settings_group, $option['name'] );
				}
			}
		}
		public function sub_menu_page_init() {
			add_submenu_page( 'edit.php?post_type=casino', esc_html__( 'Settings', 'cs' ), esc_html__( 'Settings', 'cs' ), 'manage_options', 'casino-settings', array( $this, 'casino_settings_render' ));
		}
		public function casino_settings_render() { 
		$fonts = $this->get_fonts();
		$list_icon = $this->getFontIcon();
		?>
        <div class="wrap casino-settings-wrap">
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
								case "select-icon" :
									?>
									<div class="dropdown select_font">
										<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >
										   <input id="setting-<?php echo $option['name']; ?>" class="icon-name-selected" type="text" name="<?php echo $option['name']; ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo implode( ' ', $attributes ); ?> <?php echo $placeholder; ?>/>
										   <span class="caret"></span>
										  </button>
										<ul class="list_icon dropdown-menu icon-dropdown">
										<?php
											foreach( $list_icon as $icon ){
											?>
											<li class="option" data-value='<?php echo esc_attr($icon);?>'><i style="font-family:'FontAwesome'" class="fa <?php echo esc_html($icon);?>"></i> <?php echo esc_html($icon);?></li>
											<?php }?>
										</ul>
										<input id="setting-<?php echo $option['name']; ?>" class="<?php echo $option['name']; ?>a" type="hidden" name="<?php echo $option['name']; ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo implode( ' ', $attributes ); ?> <?php echo $placeholder; ?> />
									</div>
									<?php
                                    if ( $option['desc'] ) {
                                        echo ' <p class="description">' . $option['desc'] . '</p>';
                                    }
                                break;
								case "select-font" :
									?><select name="<?php echo $option['name'];?>" id="setting-<?php echo $option['name'];?>" class="select-choosen" >
										<?php foreach ($fonts as $font ):?>
										<option value="<?php echo esc_attr($font->family);?>" data_variants='<?php echo json_encode($font->variants);?>' data_subsets='<?php echo json_encode($font->subsets);?>' <?php selected($font->family,$value)?>><?php echo esc_attr($font->family);?></option>
										<?php endforeach;?>
									</select>
									<?php
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
                                    do_action( 'casino_admin_field_' . $option['type'], $option, $attributes, $value, $placeholder );
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
		public function get_fonts($amount = 300){
			global $wp_filesystem;
			$fontFile = get_option('googleFonts');
			$fonttime = get_option('font_time');
			//Total time the file will be cached in seconds, set to a week
			$cachetime = 86400 * 7 + current_time('timestamp') ;
			if( $fontFile != false && $cachetime < $fonttime)
			{	
				$content = json_decode($fontFile);
			} else {
				update_option('font_time',current_time('timestamp'));
				$googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyCOYt9j4gB6udRh420WRKttoGoN38pzI7w';
				$fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );
				update_option('googleFonts',$fontContent['body']);
				$content = json_decode($fontContent['body']);
			}
			if($amount == 'all')
			{
				return $content->items;
			} else {
				return array_slice($content->items, 0, $amount);
			}
		}
		function casino_map_icons($name='icon',$heading_name = 'Icon') {
			return array(
				array(
					'type' => 'dropdown',
					'heading' => esc_attr( $heading_name.' library'),
					'value' => array(
						esc_html__( 'None', 'cs' ) => 'none',
						esc_html__( 'Font Awesome', 'cs' ) => 'fontawesome',
						
					),
					'std' => 'none',
					'admin_label' => true,
					'param_name' => $name.'_type',
					'description' => esc_html__( 'Select icon library.', 'cs' ),
					'integrated_shortcode_field' => $name.'_'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_attr( $heading_name ),
					'param_name' => $name.'_fontawesome',
					'value' => 'fa fa-adjust',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'fontawesome',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => $name.'_type',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'cs' ),
					'integrated_shortcode_field' => $name.'_'
				),
			);
		}
		function load_wp_media_files(){
			wp_enqueue_media();
		}
	}
}
Casino_Setting_Admin::instance();