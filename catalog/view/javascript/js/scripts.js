$(document).ready(function(){

	$('.icon-menu').click(function(event){
		$(this).toggleClass('active');
		$(this).next('div.nav_block').toggleClass('active');
	});

	$('.nav_block ul li a').on('click', function(){
		$('div.icon-menu').removeClass('active');
		$('div.nav_block').removeClass('active');
	});

	$(".popup").magnificPopup({type:"inline"});

	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#gotop').fadeIn();
				} else {
			$('#gotop').fadeOut();
				}
		});
		$('#gotop').click(function() {
			$('body,html').animate({scrollTop:0},800);
	});

	$('ul.tabs').delegate('li:not(.current)', 'click', function() {
		$(this).addClass('current').siblings().removeClass('current')
			.parents('div.tabs_block').find('div.box').hide().eq($(this).index()).fadeIn(150);
	})

});

$(function(){
	$('input[placeholder], textarea[placeholder]').placeholder();
});