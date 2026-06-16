$('.main-slider-carousel').owlCarousel({
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  loop: true,
  margin: 0,
  nav: false,
  autoplay: false,
  autoplayTimeout: 9000,
  //autoHeight: true,
  smartSpeed: 500,
  //autoplay: 6000,
  navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>'],
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    800: {
      items: 1
    },
    1024: {
      items: 1
    },
    1200: {
      items: 1
    }
  }
});
// banner-carousel
if ($('.banner-carousel').length) {
  $('.banner-carousel').owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    active: true,
    smartSpeed: 1000,
    autoplay: true,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      800: {
        items: 1
      },
      1024: {
        items: 1
      }
    }
  });
}

$('#related-products').owlCarousel({
  loop: false,
  margin: 30,
 /* stagePadding: 50,*/
  dots: true,
  navigation: false,
  autoplay: true,
  autoplaySpeed: 1000,
  /* slideTransition: 'linear',
   autoplayTimeout: 6000,
   autoplaySpeed: 6000,
   autoplayHoverPause: true,*/
  navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
  responsiveClass: true,
  responsive: {
    0: {
      items: 2,
      margin: 10
    },
    500: {
      items: 2,
      margin: 10
    },
    768: {
      items: 2,
      margin: 10
    },
    1000: {
      items: 4
    }
  },
});

$('#applications').owlCarousel({
  loop: true,
  margin: 10,
  stagePadding: 100,
  dots: true,
  navigation: false,
  autoplay: true,
  autoplaySpeed: 600,
  /* slideTransition: 'linear',
   autoplayTimeout: 6000,
   autoplaySpeed: 6000,
   autoplayHoverPause: true,*/
  navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
  responsiveClass: true,
  responsive: {
    0: {
      items: 2,
      stagePadding: 10
    },
    500: {
      items: 2,
      stagePadding: 10
    },
    768: {
      items: 2,
      stagePadding: 10
    },
    1000: {
      items: 3
    }
  },
});

$('#event').owlCarousel({
  loop: false,
  margin: 10,
  stagePadding: 100,
  dots: true,
  navigation: false,
  autoplay: false,
  autoplaySpeed: 600,
  /* slideTransition: 'linear',
   autoplayTimeout: 6000,
   autoplaySpeed: 6000,
   autoplayHoverPause: true,*/
  navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
  responsiveClass: true,
  responsive: {
    0: {
      items: 2,
      stagePadding: 10
    },
    500: {
      items: 2,
      stagePadding: 10
    },
    768: {
      items: 2,
      stagePadding: 10
    },
    1000: {
      items: 3
    }
  },
});

$('#event-one').owlCarousel({
  loop: false,
  margin: 10,
  stagePadding: 100,
  dots: true,
  navigation: false,
  autoplay: true,
  autoplaySpeed: 600,
  /* slideTransition: 'linear',
   autoplayTimeout: 6000,
   autoplaySpeed: 6000,
   autoplayHoverPause: true,*/
  navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
  responsiveClass: true,
  responsive: {
    0: {
      items: 2,
      stagePadding: 10
    },
    500: {
      items: 2,
      stagePadding: 10
    },
    768: {
      items: 2,
      stagePadding: 10
    },
    1000: {
      items: 3
    }
  },
});


/*swiper slider*/
/*var swiperAnimation = new SwiperAnimation();

var swiper = new Swiper(".swiper-container", {
  direction: "horizontal",
  effect: "slide",
  observer: true,
  margin: 30,
  spaceBetween: 10,
  observeParents: true,
  centeredSlides: true,
      roundLengths: true,
      mousewheel: false,
      grabCursor: true,
  autoplay: true,
  autoplaySpeed: 500,
  loop: true,
  breakpoints: {
        1920: {
          slidesPerView: 4
        },
        992: {
          slidesPerView: 2
        },
        320: {
           slidesPerView: 2
        }
      },
  keyboard: {
    enabled: true,
    onlyInViewport: true
  },
  scrollbar: {
    el: ".swiper-scrollbar",
    hide: false,
    draggable: true
  },

});*/

/*var $swiperSelector = $('.swiper-container');

$swiperSelector.each(function(index) {
    var $this = $(this);
    $this.addClass('swiper-slider-' + index);
    
    var dragSize = $this.data('drag-size') ? $this.data('drag-size') : 0;
    var freeMode = $this.data('free-mode') ? $this.data('free-mode') : false;
    var loop = $this.data('loop') ? $this.data('loop') : true;
    var slidesDesktop = $this.data('slides-desktop') ? $this.data('slides-desktop') : 3;
    var slidesTablet = $this.data('slides-tablet') ? $this.data('slides-tablet') : 2;
    var slidesMobile = $this.data('slides-mobile') ? $this.data('slides-mobile') : 2;
    var spaceBetween = $this.data('space-between') ? $this.data('space-between'): 10;

    var swiper = new Swiper('.swiper-slider-' + index, {
      direction: 'horizontal',
      slidesPerView: 'auto',
      initialSlide: 2,
      autoplay:true,
      speed: 1000,
      spaceBetween: 32,
      loop: true,
      centeredSlides: true,
      roundLengths: true,
      mousewheel: false,
      grabCursor: true,
      freeMode: freeMode,
      spaceBetween: spaceBetween,
      breakpoints: {
        1920: {
          slidesPerView: slidesDesktop
        },
        992: {
          slidesPerView: slidesTablet
        },
        320: {
           slidesPerView: slidesMobile
        }
      },
      keyboard: {
    enabled: true,
    onlyInViewport: true
  },
  scrollbar: {
    el: ".swiper-scrollbar",
    hide: false,
    draggable: true
  },
   });
});*/
/*new Swiper('.swiper-container', {
  direction: 'horizontal',
  slidesPerView: 'auto',
  initialSlide: 2,
  speed: 1000,
  spaceBetween: 32,
  loop: true,
  centeredSlides: true,
  roundLengths: true,
  mousewheel: true,
  grabCursor: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true },
  scrollbar: {
        el: '.swiper-scrollbar',
        draggable: true,
        dragSize: dragSize
      }
  });*/
/*-----------------------------------
   Back to Top
   -----------------------------------*/
var btn = $('#button');

$(window).scroll(function () {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function (e) {
  e.preventDefault();
  $('html, body').animate({
    scrollTop: 0
  }, '300');
});


$(document).ready(function () {
  let scroll_link = $('.scroll');

  //smooth scrolling -----------------------
  scroll_link.click(function (e) {
    e.preventDefault();
    let url = $('body').find($(this).attr('href')).offset().top - 60;
    $('html, body').animate({
      scrollTop: url
    }, 700);
    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');
    return false;
  });
});

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


/*plus minus input*/
$(document).ready(function () {
  $('.minus').click(function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $('.plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
});

$(window).on('load', function () {
  setTimeout(function () { // allowing 3 secs to fade out loader
    $('.page-loader').fadeOut('slow');
  }, 500);
});

// accordion
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

// sticky
$(window).on('scroll', function () {
  var scroll = $(window).scrollTop();
  if (scroll < 200) {
    $("#header-sticky").removeClass("sticky-menu");
  } else {
    $("#header-sticky").addClass("sticky-menu");
  }
});

AOS.init({
  duration: 1000,
  once: true,
  disable: 'mobile'
});