(function ($) {
    "use strict";



  
    //wow js
    var wow = new WOW({
        animateClass: 'animated',
        offset: 100,
        mobile: false,
        duration: 1000,
    });
    wow.init();

  


    //scorl animation js
    var $single_portfolio_img = $('.overlay_effect');
    var $window = $(window);

    function scroll_addclass() {
        var window_height = $(window).height() - 200;
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        $.each($single_portfolio_img, function () {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('is_show');
            }
        });
    }

    $window.on('scroll resize', scroll_addclass);
    $window.trigger('scroll');


}(jQuery));