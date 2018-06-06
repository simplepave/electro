$(document).ready(function(){
	
	$('#tabs-hover li a').hover(function(){
var target = $(this).data('target');
console.log(target)

if( !$('#'+target).hasClass('in')){
$('#'+target).addClass('in')
}
$('#'+target).siblings().removeClass('in')
})

if($(window).width() > 767){

setInterval(function(){

 var target = $('.hide-blocks').find('.in');

 var nextItem = $(target).next();
 if(nextItem.length > 0){
  $(target).removeClass('in');
  $(nextItem).addClass('in');

  $('[data-target='+$(nextItem).attr('id')+']').addClass('hover')
  $('[data-target='+$(nextItem).attr('id')+']').parent().siblings().children().removeClass('hover')
 } else {

  $(target).removeClass('in');
  $('.hide-blocks #item-1').addClass('in');

  $('[data-target="item-1"]').addClass('hover')
  $('[data-target='+$(nextItem).attr('id')+']').parent().siblings().children().removeClass('hover')

 }

},5000)

}
	
});