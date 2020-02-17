/**
 * initColorPicker
*/
;(function($) {
   'use strict'
	function resetIndex(){
		$('#gallery-metabox-list li').each(function(i) {
		   $(this).find('input:hidden').attr('name', 'tdc_gallery_id[' + i + ']');
		});
	};
	function fnSortable() {
		$('#gallery-metabox-list').sortable({
		   opacity: 0.6,
		   stop: function() {
			  resetIndex();
		   }
		});
	};
	var initAddGalleryImage = function(){
		var file_frame;
		$('#estate_box').on('click', 'a.gallery-add', function(e) {
			e.preventDefault();
			if (file_frame) file_frame.close();
				file_frame = wp.media.frames.file_frame = wp.media({
					title: $(this).data('uploader-title'),
					button: {
					text: $(this).data('uploader-button-text'),
				},
				multiple: true
			});
			file_frame.on('select', function(){
				var index = 1;
				var listIndex = $('#gallery-metabox-list li').index($('#gallery-metabox-list li:last')),
				selection = file_frame.state().get('selection');
				selection.map(function(attachment, i) {
					attachment = attachment.toJSON(),
					index = listIndex + (i + 1);
					$('#gallery-metabox-list').append('<li><input type="hidden" name="tdc_gallery_id[' + index + ']" value="' + attachment.id + '"><img class="image-preview" src="' + attachment.sizes.thumbnail.url + '"><a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Đổi hình</a><br><small><a class="remove-image" href="#">Remove image</a></small></li>');
				});
			});
			fnSortable();
			file_frame.open();
		});
	};
	var initChangeImageGallery = function(){
		var file_frame;
		$('#estate_box').on('click', 'a.change-image', function(e) {
			e.preventDefault();
			var that = $(this);
			if (file_frame) file_frame.close();
			file_frame = wp.media.frames.file_frame = wp.media({
				 title: $(this).data('uploader-title'),
				 button: {
				 text: $(this).data('uploader-button-text'),
			},
			multiple: false
			});
			file_frame.on( 'select', function(attachment) {
				 attachment = file_frame.state().get('selection').first().toJSON();
				 that.parent().find('input:hidden').attr('value', attachment.id);
				 that.parent().find('img.image-preview').attr('src', attachment.sizes.thumbnail.url);
			  });
			file_frame.open();
		});
	};
	var initDeleteImageGallery = function(){
		$('#estate_box').on('click', 'a.remove-image', function(e){
			e.preventDefault();
			$(this).parents('li').animate({ opacity: 0 }, 200, function() {
				$(this).remove();
				resetIndex();
			});
		});
	};
	var initGetValueSelect = function(_objselect,_objvalue){
		var _clickobj = $(_objselect),
			_getvalue = $(_objvalue);
		_clickobj.change(function(e){
			e.preventDefault();
			var _this = $(this),
				_activevl = _this.find('option:selected').text();
			_this.closest('.wrap-estate').find(_getvalue).val(_activevl);
		})
	};
	var initUpdateAjax = function(){
		var _clickud = $('#publishing-action');
		_clickud.on('click','.button-primary',function(e){
			var _this = $(this);
			var _huyen = _this.closest('#poststuff').find('#choice_distric').val();
			var _xa = _this.closest('#poststuff').find('#choice_wards').val();
			var data = {
				'action': 'wp_ajax_tdl_ajax_save_estate',
				'tdl_huyen': _huyen,
				'tdl_xa': _xa
			};
			$.ajax({
				cache: false,
				timeout: 8000,
				url: ajax_login_object.admin_ajax,
				type: "POST",
				data:data,
				beforeSend: function() {
					console.log('start');
				},
				success: function( data, textStatus, jqXHR ){
					console.log(data);
					$('#choice_districs').empty().append(data);
				},
				error: function( jqXHR, textStatus, errorThrown ){
					console.log( 'The following error occured: ' + textStatus, errorThrown );
				},
				complete: function( jqXHR, textStatus ){
				}
			});
			$('#choice_districs').empty().append('<option>' + _huyen + '</option>');
		})
	};
    // Dom Ready
    $(function(){
		initAddGalleryImage();
		initChangeImageGallery();
		initDeleteImageGallery();
    });
})(jQuery);