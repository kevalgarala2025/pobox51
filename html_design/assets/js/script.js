// Animation JS
$(function() {

    function ckScrollInit(items, trigger) {
        items.each(function() {
            var ckElement = $(this),
                AnimationClass = ckElement.attr('data-animation'),
                AnimationDelay = ckElement.attr('data-animation-delay');

            ckElement.css({
                '-webkit-animation-delay': AnimationDelay,
                '-moz-animation-delay': AnimationDelay,
                'animation-delay': AnimationDelay,
                opacity: 0
            });

            var ckTrigger = (trigger) ? trigger : ckElement;

            ckTrigger.waypoint(function() {
                ckElement.addClass("animated").css("opacity", "1");
                ckElement.addClass('animated').addClass(AnimationClass);
            }, {
                triggerOnce: true,
                offset: '90%'
            });
        });
    }

    ckScrollInit($('.animation'));
    ckScrollInit($('.staggered-animation'), $('.staggered-animation-wrap'));

});

// Header On Scroll Fixed
(function($){
	//on scroll header fixed
	$(window).scroll(function(){
		var scroll = $(window).scrollTop();

	    if (scroll >= 80) {
	        $('header').addClass('nav-fixed');
	    } else {
	        $('header').removeClass('nav-fixed');
	    }
	});
})(jQuery); 



// Select all links with hashes
$('a.page-scroll').on('click', function(event) {
    // On-page links
    if ( location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname ) {
      // Figure out element to scroll to
      var target = $(this.hash),
          speed= $(this).data("speed") || 800;
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - 60
        }, speed);
      }
    }
});


// Slider
$('.timeline').owlCarousel({
     loop: false,
     margin: 30,
     autoHeight: true,
     nav: true,
     navText: ['<i class="ion-ios-arrow-back"></i>', '<i class="ion-ios-arrow-forward"></i>'],
     responsive: {
         0: {
             items: 1,
         },
         380: {
             items: 2,
         },
         767: {
             items: 3,
         },
         1000: {
             items: 4,
         },
         1199: {
             items: 5
         }
     }
 });

//Timer Countdown
$('.tk_countdown_time').each(function() {
    var endTime = $(this).data('time');
    $(this).countdown(endTime, function(tm) {
        $(this).html(tm.strftime('<span class="counter_box"><span class="tk_counter minutes">%M</span></span><span class="counter_box"><span class="tk_counter seconds">%S</span></span>'));
    });
});

$('.extraTwoMinute').on('click', function(){

    alert();
});

