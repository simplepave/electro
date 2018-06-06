$(function(){});
    $(window).load(function(){
      $('.slider_product').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
		slideshow: false,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
});