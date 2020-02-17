/**
 * initColorPicker
*/
;(function($) {
   'use strict'
	var initAnimation = function(){
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			jQuery('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').waypoint(function () {
				jQuery(this).addClass('wpb_start_animation');
			}, {offset: '85%'});
		}
	};
	var initScrollActive = function(){
		var $steps = $('.right-content ul li');
		if($steps.length > 0){
			steps__init();
		}
		function steps__init(){
			$steps.each(function(){
				var $el = $(this);
				$el.waypoint({
					handler: function(direction) {
						$steps.filter('.active').removeClass("active");
						if(direction == "down"){
							$el.addClass("active");
						}else{
							$el.prev().addClass("active");
						}
					 },
					 offset: '50%'
				});
			});
		}
	};
    $(function(){
		initAnimation();
		initScrollActive();
    });
})(jQuery);