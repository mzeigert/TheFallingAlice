(function($){
	$('.menu-item-has-children>a').addClass('tap-title').on('tap', function(e){
		e.preventDefault();
		var subMenu = $(this).siblings();
		if(subMenu.hasClass('visible')){
			window.location.href = $(this).attr('href');
		}
	});

	/*Mobile*/
	/*Toggles Menu*/
	$('.menu-button').on('tap', function(){
		$('.nav-content').toggleClass('visible');
		$('html').toggleClass('menu-visible');
	});
	/*Toggles Tap-Boxes*/
	$('.tap-title').on('tap', function () {
		$(this).siblings().toggleClass('visible');
	});
	/*/Mobile*/

	$('.menu-item-has-children').hover(function(){
		$(this).children('.sub-menu').addClass('visible');
	}, function(){
		$(this).children('.sub-menu').removeClass('visible');
	});

	/*Scroll-function for on-page-navigation*/
	$('[data-char]').on('touchstart click', function () {
		var target = $('[data-firstchar=' + $(this).attr('data-char') + ']');
		$('body').scrollTop(target.offset().top - 148);
	});
})(jQuery);
