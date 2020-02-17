/**
 * initColorPicker
*/
;(function($) {
   'use strict'
	var intChoiceImage = function(){
		$('.checl_logos').each(function(){
			var _this = $(this);
			var _getval = _this.find('#child_logo_url').val();
			if(_getval != ''){
				_this.children('.wpt-cancel').css('display','inline-block');
			}
			_this.on('click','#child_upload_logo_button',function(e){
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
					_this.children('.wpt-cancel').css('display','inline-block');
					_this.find('#child_logo_url').val(image_url);
					_this.find('.hide_show').attr("src",image_url);
				});
				logo_imag.open();
			});
			_this.on('click','.wpt-cancel',function(e){
				_this.find('#child_logo_url').val('');
				_this.find('.hide_show').attr('src','');
				_this.children('.wpt-cancel').css('display','none');
			});
		});
	};
    // Dom Ready
    $(function(){
		intChoiceImage();
    });
})(jQuery);