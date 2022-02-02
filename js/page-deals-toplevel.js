
jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;

    var $body = $('body');




    $('#main-slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        initialSlide: 0,
    
        arrows: true,
        dots: false,
        prevArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--left product-related__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--right product-related__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [

          {
            breakpoint: 1500,
            settings: {
              slidesToShow: 3,
            }
          },
          {
            breakpoint: 1000,
            settings: {
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 800,
            settings: {
              slidesToShow: 1,
              arrows: false,
              centerMode: true,
            }
          }
        ]
    });





});
