/**
 * initColorPicker
*/
;(function($) {
   'use strict'
    function casino_post(action, data){
		data = {
			'action': 'casino_'+action,
			'data': data
		};
		return $.post(the_ajax_script.ajaxurl, data );
	};
	var initClickSort = function(_element){
		var _wrapper = $(_element);
		if(_wrapper.length === 0) return;
		_wrapper.on('click',function(e){
			var _this = $(this);
			var _table = _this.closest('.wrapper-casino');
			var _sort = _this.hasClass('asc') ? '' : 'asc';
			var _rows = _table.find('tbody >tr');
			if( _rows.length == 0 ) return;
			var _sortby = _this.data('shortby');
			if ( !_sortby) return;
			$(this).addClass('sorted').removeClass('asc').addClass(_sort).siblings(this).removeClass('sorted').removeClass('asc');
			var x, y, i,j;
			for(i = 0;i < (_rows.length - 1); i++){
				for( j = i+1 ; j < (_rows.length ) ; j++){
					var selecter_x = 'tbody >tr:eq('+i+')';
					var selecter_y = 'tbody >tr:eq('+ j +')';
					x = _table.find(selecter_x).find(_sortby).data('sort_value');
					y = _table.find(selecter_y).find(_sortby).data('sort_value');
					if( ((x > y) && (_sort == 'asc')) || ((x < y) && ( _sort != 'asc'))){
						_table.find(selecter_y).remove().insertBefore(_table.find(selecter_x));
					}
				}
			}
		});
	};
	var initMobile = function(){
		var _wrap = $('.wrapper-casino');
		_wrap.on('click','.reponsive_mobile a',function(e){
		   e.preventDefault();
		   var _this = $(this);
		   _this.toggleClass('active');
		   _this.closest('.xl').find('.td_five,.td_six,.td_sevent').slideToggle(function(){
			   if ($(this).is(':visible'))
			   $(this).css('display','inline-block');
		   });
		});
	};
	var initReponsive = function(){
	 if( $(window).width() >= 768) {
			   var td_changed = $('.wrapper-casino .td_four + .td_two');
			   if( td_changed.length != 0) {
					td_changed.each(function(){
						var _this = $(this);
						var insert_back = _this.closest( '.xl').find('.td_one');
						if( insert_back.length == 0) return;
						_this.remove().insertAfter(insert_back);
					});
			   }
		  }else{
			   var td_change = $('.wrapper-casino .td_one + .td_two');
			   if( td_change.length != 0){
				   td_change.each(function(){
						var _this = $(this);
						var insert_to = _this.closest( '.xl').find('.td_four').first();
						if( insert_to.length == 0) return;
						_this.remove().insertAfter(insert_to);
				   });
			   }
		  }
	};
	var initLoadMore = function(){
		var _load_more = $('.all_data');
		_load_more.on('click','.load_more',function(e){
			var _this = $(this);
			if( _this.hasClass('max')) {return;}
			e.preventDefault();
			var data = {};
			data.args = _this.data('args');
			data.atts = _this.data('atts');
			casino_post('ajax_loadmore_shortby_element',data).done(function(data){
				data = $.parseJSON(data);
				var _parent = _this.closest('tfoot');
				if(data.content){
					_parent.prev('tbody').append(data.content);
					initReponsive();
				}
				if(data.args){
					_this.data('args',data.args);
					if(data.max){
						_this.addClass('max');
						_this.empty().append('View Less<i class="fa fa-angle-double-up></i>');
					}
				}
			});
		});
	};
	var initCasinoRemoveItem = function(){
		var _show_less = $('.all_data');
		_show_less.on('click', '.load_more.max', function(e){
			e.preventDefault();
			var _this = $(this);
			var data = {} , i;
			data.args = _this.data('args');
			var number_remove = parseInt(data.args.posts_per_page);
			var pages = parseInt(data.args.paged);
			var _rows = _this.closest('.wrapper-casino').find('tbody tr');
			var _size = _rows.length;
			if( _size) _size = _size -1;
			if( _size >= number_remove){
				for(i= (_size);i>( _size - number_remove); i--){
					if( i >= number_remove ){
						_rows[i].remove();
					}
				}
			}
			_rows = _this.closest('.wrapper-casino').find('tbody tr');
			_size = _rows.length;
			if( _size <= number_remove || !_size){
				_this.removeClass('max');
				_this.empty().append('Load More<i class="fa fa-arrow-circle-right"></i></a>');
				data.args.paged = 1;
				_this.data('args',data.args);
				return;
			}
		});
	}
	var initAddClassColumn = function(){
		var _td_bottom = $('tbody .xl');
		var table_column = 0;
		_td_bottom.each(function(){
			var dem = 0;
			$(this).children('td').each(function(){
				dem++;
				if(dem > table_column){
					table_column = dem;
				}
			})
		})
		$('.wrapper-casino').addClass('columns'+table_column+'');
	};
	var initMouseSection = function(){
		var i,x,j,y;
		var _wrtr = $('.wrapper-casino tbody .xl');
		_wrtr.each(function(){
			var _this = $(this);
			var _table = _this.closest('.wrapper-casino');
			var wrshort = _this.find('td');
			if(wrshort.length === 0) return;
			for(i = 0; i < (wrshort.length -1); i++){
				for(j = i+1; j < wrshort.length; j++){
					var selecter_x = 'td:eq('+ i +')';
					var selecter_y = 'td:eq('+ j +')';
					x = _this.find(selecter_x).data('position_value');
					y = _this.find(selecter_y).data('position_value');
					if(x > y){
						_this.find(selecter_y).remove().insertBefore(_this.find(selecter_x));
					}
				}
			}
		})
	};
	var initMouseHeading = function(){
		var i,x,j,y;
		var _wrtr = $('.wrapper-casino thead .tablesorter-headerRow');
		_wrtr.each(function(){
			var _this = $(this);
			var _table = _this.closest('.wrapper-casino');
			var wrshort = _this.find('th');
			if(wrshort.length === 0) return;
			for(i = 0; i < (wrshort.length -1); i++){
				for(j = i+1; j < wrshort.length; j++){
					var selecter_x = 'th:eq('+ i +')';
					var selecter_y = 'th:eq('+ j +')';
					x = _this.find(selecter_x).data('position_value');
					y = _this.find(selecter_y).data('position_value');
					if(x > y){
						_this.find(selecter_y).remove().insertBefore(_this.find(selecter_x));
					}
				}
			}
		})
	};
    // Dom Ready
    $(function(){
		initMouseHeading();
		initMouseSection();
		initClickSort('.wrapper-casino .easy-table-header');
		initClickSort('.wrapper-casino .wraps a');
		initLoadMore();
		initCasinoRemoveItem();
		initReponsive();
		initAddClassColumn();
		initMobile();
    });
})(jQuery);