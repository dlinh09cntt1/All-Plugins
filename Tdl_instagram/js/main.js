;(function($) {
   'use strict'
	var initInstagram = function(){
		$( '.tdl-loadmore' ).on( 'click','a', function( e ) {
			 /** Prevent Default Behaviour */
			 e.preventDefault();
			 /** Get data-page */
			 var _this = $(this);
			 var data = {
				 'action': 'tdl_instagram_ok',
				 'args': _this.data('args'),
				 'paged':_this.data('paged')
			};
			 /** Ajax Call */
			 $.ajax({
				 cache: false,
				 timeout: 8000,
				 url: svl_array_ajaxp.admin_ajax,
				 type: 'POST',
				 data: data,
				 beforeSend: function() {
				 $( '.loading_ajaxp' ).css( 'display','block' );
				 },
				 success: function( data, textStatus, jqXHR ){
					 console.log(data);
				 	_this.closest('.tdl-loadmore').prev('.tdl-instagram').html( data );
				 },
				 error: function( jqXHR, textStatus, errorThrown ){
					 console.log( 'The following error occured: ' + textStatus, errorThrown );
				 },
				 complete: function( jqXHR, textStatus ){
				 }
			 });
		 });
	}
    // Dom Ready
    $(function(){
		initInstagram();
    });
})(jQuery);