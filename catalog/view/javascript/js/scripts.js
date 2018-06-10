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

	$('a[href="#plus"]').click(function () {
		var inp = $(this).parent('span').find('input');
		inp.val(parseInt(inp.val())+1);
		return false;
	});
	$('a[href="#minus"]').click(function () {
		var inp = $(this).parent('span').find('input');
		if(inp.val()>1) inp.val(parseInt(inp.val())-1);
		return false;
	});

	$('ul.tabs').delegate('li:not(.current)', 'click', function() {
		$(this).addClass('current').siblings().removeClass('current')
			.parents('div.tabs_block').find('div.box').hide().eq($(this).index()).fadeIn(150);
	})

	$('.buy').on('click', function(){
		$('div.basket_wrapp').toggleClass("active");
		return false;
	});

});

$(function(){
	$('input[placeholder], textarea[placeholder]').placeholder();
});