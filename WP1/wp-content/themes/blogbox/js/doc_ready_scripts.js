// initialise plugins
jQuery(document).ready(function($){ 
	//alert('toggle is running');
    $('ul.sf-menu').superfish();
    
	$(window).unload(function(){
		$('ul.sf-menu li.current').hideSuperfishUl();
	});
	
	$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: '../images/feature_slider/loading.gif',
				play: 5000,
				pause: 2500,
				effect: 'fade',
				hoverPause: true
			});
			$('#slides_full').slides({
				preload: true,
				preloadImage: '../images/feature_slider/loading.gif',
				play: 5000,
				pause: 2500,
				effect: 'fade',
				hoverPause: true
			});			
	});
});