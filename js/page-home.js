jQuery(document).ready(function ($) {


    //SLIDERS
    $('#intro-testimonials').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false
    });

    $('#intro-testimonials').on("click", function () {
        $('#intro-testimonials').slick("slickNext");
    });

});