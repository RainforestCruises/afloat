jQuery(document).ready(function ($) {


    //SLIDERS
    $('#intro-testimonials').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 4000
    });

    $('#intro-testimonials').on("click", function () {
        $('#intro-testimonials').slick("slickNext");
    });


    $('#destinations-slider').slick({
        rows: 2,
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        prevArrow: '<button class="btn-circle btn-dark btn-circle--left home-destinations__destinations-area__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-dark btn-circle--right home-destinations__destinations-area__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rows: 1,
                    arrows: false,
                    centerMode: true
                }
            },

        ]
    });


     //SLIDERS
     $('#featured-cruises').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        //dots: true,
        arrows: true,
        prevArrow: '<button class="btn-icon-move btn-icon-move--left home-featured__content-area__btn--left"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
        nextArrow: '<button class="btn-icon-move btn-icon-move--right home-featured__content-area__btn--right"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    centerMode: true,
                    fade: false,
                    arrows: false
                }
            },
         
 

        ]
    });

     //SLIDERS
     $('#featured-bucket').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        //dots: true,
        arrows: true,
        prevArrow: '<button class="btn-icon-move btn-icon-move--left home-featured__content-area__btn--left"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
        nextArrow: '<button class="btn-icon-move btn-icon-move--right home-featured__content-area__btn--right"><svg class="btn-icon-move--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg><svg class="btn-icon-move--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    centerMode: true,
                    fade: false,
                    arrows: false
                }
            },

        ]
    });

});