
jQuery(document).ready(function ($) {

  



  
    $('#region-slider-1').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        centerMode: true,
        prevArrow: '<button class="btn-circle btn-white btn-circle--left btn-circle--large experience-region__slider-area__slider__btn-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-white btn-circle--right btn-circle--large experience-region__slider-area__slider__btn-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 700,
                settings: {
                    arrows: false,
                }
            },
        ]
    });

    $('#region-slider-2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        centerMode: true,
        prevArrow: '<button class="btn-circle btn-white btn-circle--left btn-circle--large experience-region__slider-area__slider__btn-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-white btn-circle--right btn-circle--large experience-region__slider-area__slider__btn-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 700,
                settings: {
                    arrows: false,
                }
            },
        ]
    });


});
