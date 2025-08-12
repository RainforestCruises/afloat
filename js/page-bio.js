jQuery(document).ready(function ($) {
  const templateUrl = page_vars.templateUrl;

  $("#reviews-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    dots: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
  });
});
