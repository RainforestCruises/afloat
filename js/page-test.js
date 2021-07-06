jQuery(document).ready(function ($) {



    // //SLIDERS
    // //hero bg
    // $('#test-hero__bg').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: true,
    //     //centerMode: false,
    //     //draggable: true,
    //     fade: false,
    //     arrows: false,
    //     speed: 0,
    //     lazyLoad: 'ondemand',
    //     waitForAnimate: false,

    // });


    $(document).ready(function () {
        $("#test-hero__bg").owlCarousel(
            {
               
                nav: true,
                items: 1,
                lazyLoad: true,
                navigation: true,
                navigationText: ["", ""],
                slideSpeed: 300,
                paginationSpeed: 400,
                autoPlay: true,
        
                animateOut: 'fadeOut'
            }
        );
    });


});



