/**
 * initSliderGallery
 * initNextImg
*/
;(function($) {
   'use strict'
   /*Slider*/
	var initCheckActive = function(){
		var _flag = 0;
		var _pos = 0;
		var _i = 0;
		$('.tdl-garelly-slider li').each(function(e){
			_i++;
			var _this = $(this);
			if(_this.children('a').hasClass('active')){
				_flag = 1;
				_pos = _i;
				return false;
			}
		})
		return _pos;
	};
	var initMaxGarellyNa = function(){
		var _max = 0;
		$('.tdl-garelly-slider li').each(function(){
			_max++;
		})
		return _max;
	};
	/*End Slider*/
	var initClickNextPrev = function(){
		var _clicknext = $('.tdl-next');
		var _clickprev = $('.tdl-prev');
		var _navactive = $('.tdl-garelly-slider li a');
		var _vt = initCheckActive();
		var _maxnav = initMaxGarellyNa();
		_clicknext.on('click',function(e){
			e.preventDefault();
			var _this = $(this);
			if(_vt >= 0 && _vt < _maxnav){
				var _curentactive = _this.closest('.tdl-garelly-image').find('.tdl-garelly-slider li a.active');
				var _crimgs = _curentactive.closest('li');
				$('.tdl-garelly-slider li a').removeClass('active');
				var _addNext = _crimgs.next();
					_addNext.children('a').addClass('active');
				var _nextImg = _addNext.find('a').children('img').attr('src');
				_this.closest('.tdl-garelly-image').find('.size-full').attr('src',_nextImg);
				if($('.tdl-garelly-slider li:last-child a').hasClass('active')){
					_this.closest('.tdl-garelly-image').find('.tdl-garelly-slider li:first-child a').addClass('active');
					return false;
				}
			}
		});
		_clickprev.on('click',function(e){
			e.preventDefault();
			var _this = $(this);
			if(_vt >= 0 && _vt < _maxnav){
				var _curentactives = _this.closest('.tdl-garelly-image').find('.tdl-garelly-slider li a.active');
				var _crimgss = _curentactives.closest('li');
				$('.tdl-garelly-slider li a').removeClass('active');
				var _addNexts = _crimgss.prev();
					_addNexts.children('a').addClass('active');
				var _nextImgs = _addNexts.find('a').children('img').attr('src');
				_this.closest('.tdl-garelly-image').find('.size-full').attr('src',_nextImgs);
				if($('.tdl-garelly-slider li:first-child a').hasClass('active')){
					_this.closest('.tdl-garelly-image').find('.tdl-garelly-slider li:last-child a').addClass('active');
					return false;
				}
			}
		});
	};
	var initNextImg = function(){
		var _rdclick = $('.tdl-garelly-slider li');
		_rdclick.on('click','a',function(e){
			e.preventDefault();
			$('.tdl-garelly-slider li a').removeClass('active');
			var _this = $(this);
			_this.addClass('active');
			var _currentImg = _this.closest('.tdl-garelly-image').find('.size-full').attr('src');
			var _below = _this.find('img').attr('src');
			_this.closest('.tdl-garelly-image').find('.size-full').attr('src',_below);
		});
		
	};
	var initChoiceSelect = function(_xa,_xb){
		var _xa = $(_xa);
		var _xb = $(_xb);
		_xa.change(function(){
			var _this = $(this);
			var _child_value = _this.find('option:selected').val();
			_this.closest('.tdl-filter-search').find(_xb).val(_child_value);
		})
	};
	var initShowCity = function(){
		var _select_h = $('#choice_citiess');
		var _data_url = $('.archive-estate').data('url_root');
		var _path = "/wp-content/plugins/tdl_estate/inc/data/city.json";
		var _allrl = _data_url+_path;
		_select_h.change(function(){
			$('#choice_wardss').prop('disabled',true);
			var _this = $(this),
				_ids = _this.find('option:selected').attr('data-idt'),
				_tdl_value = _this.find('option:selected').text(),
				_url = _allrl;
			$.ajax({
			   url:_url,
			   dataType: 'json',
			   success: function(data) {
				  var items =[];
				  var _itemsfrist = [];
				  $.each(data, function(key, val) {
					if(val.ID_City == _ids){
						//var stuff = $('<?php selected($choice_districs, val.Name_City, true )?>');
						items.push('<option data-district="' + val.ID_Wards + '">' + val.Name_City + '</option>'); 
						_itemsfrist.push(val.Name_City);
						//_this.closest('.test_select').find('input[name="k_item_hidden_002"]').val(_itemsfrist[0]);
					}
				  });
				  $('#choice_districs').empty().append(items.join(''));
			   },
			  statusCode: {
				 404: function() {
				   alert('There was a problem with the server.  Try again soon!');
				 }
			   }
			});
		})
	};
	var initShowDars = function(){
		var _select_h = $('#choice_districs');
		var _data_url = $('.archive-estate').data('url_root');
		var _path = "/wp-content/plugins/tdl_estate/inc/data/wards.json";
		var _allrl = _data_url+_path;
		_select_h.change(function(){
			$('#choice_wardss').prop('disabled',false);
			var _this = $(this),
				_ids = _this.find('option:selected').attr('data-district'),
				_tdl_value = _this.find('option:selected').text(),
				_url = _allrl;
			$.ajax({
			   url:_url,
			   dataType: 'json',
			   success: function(data) {
				  var items =[];
				  var _itemsfrist = [];
				  $.each(data, function(key, val) {
					if(val.ID_Wards == _ids){
						//var stuffs = <?php selected($choice_wardss, val.Name_Wards, true ); ?>;
						items.push('<option data-wards="' + val.ID_Wards + '">' + val.Name_Wards + '</option>'); 
						_itemsfrist.push(val.Name_Wards);
						//_this.closest('.test_select').find('input[name="k_item_hidden_002"]').val(_itemsfrist[0]);
					}
				  });
				  $('#choice_wardss').empty().append(items.join(''));
			   },
			  statusCode: {
				 404: function() {
				   alert('There was a problem with the server.  Try again soon!');
				 }
			   }
			});
		})
	};
	var initUiSize = function(){
		var min_size = $('#min_size').val();
		var max_size = $('#max_size').val();
		/*Size*/
		$("#slider-size").slider({
			range: true,
			min: 0,
			max: 500,
			values: [min_size,max_size],
			slide: function(event, ui) {
				var x_size = ui.values[0];
				var y_size = ui.values[1];
				$("#min_size").val(ui.values[0]);
				$("#max_size").val(ui.values[1]);
			}
		});
		$("#min_size").change(function() {
			$("#slider-range-size").slider("values", 0, $(this).val());
		});
		$("#max_size").change(function() {
			$("#slider-range-size").slider("values", 1, $(this).val());
		})
		/*End Size*/
	};
	var initUiPrice = function(){
		var max_price = $('#priceto').val();
		var min_price = $('#pricefrom').val();
		$("#slider-holder").slider({
			range: true,
			min: 0,
			max: 50000000000,
			values: [min_price,max_price],
			slide: function(event, ui) {
				$("#pricefrom").val(ui.values[0]);
				$("#priceto").val(ui.values[1]);
			}
		});
		$("#pricefrom").change(function() {
			$("#slider-range").slider("values", 0, $(this).val());
		});
		$("#priceto").change(function() {
			$("#slider-range").slider("values", 1, $(this).val());
		})
		/*End Price*/
	};
	var initFilterEstate = function(){
		var _click = $('#searchsubmit');
		var post_type = 'estate';
		var posts_per_page = 5;
		_click.on('click',function(e){
			e.preventDefault();
			var _this = $(this);
			/*get DATA send server*/
			var _action = _this.closest('.tdl-filter-search').find('input[name="tdl_action"]').val(),
				_redirect = _this.closest('.tdl-filter-search').find('input[name="tdl_redirects"]').val(),
				_city = _this.closest('.tdl-filter-search').find('input[name="tdl_citiess"]').val(),
				_distric = _this.closest('.tdl-filter-search').find('input[name="tdl_districs"]').val(),
				_wards = _this.closest('.tdl-filter-search').find('input[name="tdl_wardss"]').val(),
				_min_price = _this.closest('.tdl-filter-search').find('input[name="pricefrom"]').val(),
				_max_price = _this.closest('.tdl-filter-search').find('input[name="priceto"]').val(),
				_min_size = _this.closest('.tdl-filter-search').find('input[name="min_size"]').val(),
				_max_size = _this.closest('.tdl-filter-search').find('input[name="max_size"]').val();
			/*Ajax send data to server*/
			$.ajax({
				cache: false,
				timeout: 8000,
				url: tdl_array_ajaxp.admin_ajax,
				type: "POST",
				data: ({ 
					action			:'tdl_price_custom', 
					post_type       : post_type,
					posts_per_page	:	posts_per_page,
					c_action :_action,
					c_redirect : _redirect,
					c_city : _city,
					c_distric : _distric,
					c_wards : _wards,
					c_min_price : _min_price,
					c_max_price : _max_price,
					c_min_size : _min_size,
					c_max_size : _max_size
				}),
				beforeSend: function() {
					$('.archive-estate .content-area' ).addClass('tdl_loading');
				},
				success: function( data, textStatus, jqXHR ){
					$('.archive-estate .content-area' ).removeClass('tdl_loading');
					$( '.archive-estate .content-area' ).empty().html( data );
				},
				error: function( jqXHR, textStatus, errorThrown ){
					console.log( 'The following error occured: ' + textStatus, errorThrown );
				},
				complete: function( jqXHR, textStatus ){
				}
			});	
		})
	};
    // Dom Ready
    $(function(){
		initNextImg();
		initClickNextPrev();
		initChoiceSelect('#tdl_actions','input[name="tdl_action"]');
		initChoiceSelect('#choice_redirects','input[name="tdl_redirects"]');
		initChoiceSelect('#choice_citiess','input[name="tdl_citiess"]');
		initChoiceSelect('#choice_districs','input[name="tdl_districs"]');
		initChoiceSelect('#choice_wardss','input[name="tdl_wardss"]');
		initShowCity();
		initShowDars();
		initUiSize();
		initUiPrice();
		initFilterEstate();
    });
})(jQuery);