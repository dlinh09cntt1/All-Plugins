/**
 * initColorPicker
*/
;(function($) {
   'use strict'
    var initColorPicker = function(){
		if ( $().wpColorPicker ){
			$('.color_one_caa,.color_one_texta,.color_two_caa,.color_three_caa,.color_four_caa,.color_four_texta,.color_five_caa,.background_tab_lista,.background_hover_buttona,.background_row_casinoa,.background_cs_evena,.background_cs_odda,.background_border_headinga,.background_border_sectiona,.color_text_mobilea,.background_button_mobilea,.boxshadow_button_mobilea,.background_mobile_hovera,.color_headinga').wpColorPicker();
		}
	};
	var initTabSetting = function(){
		var choice_tab = $('.casino-settings-wrap .nav-tab-wrapper');
		var content_tab = $('.casino-settings-wrap .settings_panel');
		choice_tab.on('click','.nav-tab',function(e){
			e.preventDefault();
			var _this = $(this);
			choice_tab.find('.nav-tab').siblings(_this).removeClass('nav-tab-active');
			_this.addClass('nav-tab-active');
			var tab = _this.attr("href");
			content_tab.not(tab).css("display","none");
			$(tab).fadeIn();
		})
	};
	var initDropdownIcon = function(_geticon){
		var _icons = $('.list_icon');
		var iconname = _geticon;
		if(iconname.length === 0) return;
		if(_icons.length === 0) return;
		_icons.on('click','.option',function(e){
			e.preventDefault();
			var data = {},
			_this = $(this);
			_icons.find('.option').removeClass('active');
			_this.addClass('active');
			data.value = _this.data('value');
			_this.closest('.dropdown').find('.icon-name-selected').text(_this.text());
			_this.closest('.select_font').find('input[name="'+iconname+'"]').val(_this.data('value'));
		})
	};
	var initUploadLogo = function(){
		//var _upload = $('#logo_image_url');
		var _all_logo = $('.image_ctl');
		_all_logo.each(function(){
			var _this = $(this);
			_this.on('click','#logo_image_url',function(e){
				e.preventDefault();
				var logo_imag = wp.media({
					title:'Select Logo Image',
					library: {type: 'image'},
					multiple: false,
					button: { text: 'Insert'}
				});
				logo_imag.on('select', function() {
					var logo_selection = logo_imag.state().get('selection').first();
					var image_url = logo_selection.toJSON().url;
					_this.children('#logo_containers').val(image_url);
				});
				logo_imag.open();
			})
		});
	};
	var initDeleteLogo = function(){
		var _remove = $('.remove_logo');
		var all_remove = $('.image_ctl');
		all_remove.each(function(e){
			//_remove.hide();
			var _this = $(this);
			_this.children('.remove_logo').hide();
			if(_this.children('#logo_containers').val() !=''){
				//_remove.show();
				_this.children('.remove_logo').show();
				_this.children('.remove_logo').on('click',function(e){
					e.preventDefault();
					var _thiss = $(this);
					_thiss.prev('#logo_containers').attr('value', '');
					_thiss.hide();
				})
			}
		});
	};
    // Dom Ready
    $(function(){
		initColorPicker();
		initTabSetting();
		initDropdownIcon('casino_icon_loadmore');
		initDropdownIcon('casino_icon_button');
		initDropdownIcon('casino_icon_spin');
		initDropdownIcon('casino_icon_bonus');
		initUploadLogo();
		initDeleteLogo();
    });
})(jQuery);