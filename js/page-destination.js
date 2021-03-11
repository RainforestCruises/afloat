
jQuery(document).ready(function ($) {

    //Anchor behavior
    //on load
    var identifier = window.location.hash;
    if ($(identifier).length) {
        changePosition(identifier);
    }


    //Burger
    //Burger Menu -- click
    $(".page-nav__button").on("click", function () {
        //within #pagenav
        $('.page-nav__button').first().toggleClass('page-nav__button--active');
        $('.page-nav__collapse').first().toggleClass('page-nav__collapse--active');

    });

    //Burger Menu -- resize window -- remove collapse menu over 1000
    $(window).resize(function () {
        if ($(window).width() > 1000) {
            $('.page-nav__collapse').removeClass('page-nav__collapse--active');
            $('.page-nav__button').removeClass('page-nav__button--active');

        }

    });


    //Page Nav -- Sticky (CAN COMBINE as UTIL)
    var navbar = document.querySelector('#template-nav');
    var subnavTitle = document.querySelector('#template-nav-title');

    var offsetY = navbar.offsetTop;

    window.onscroll = function () { myFunction() };
    function myFunction() {

        var isElementInView = Utils.isElementInView($('#template-nav'), false);

        if (isElementInView) {
            $('#page-nav').remove();
            $('.page-nav__collapse').removeClass('page-nav__collapse--active');
            $('.page-nav__button').removeClass('page-nav__button--active');

        } else { //if template nav is out of view


            //and if burger menu isnt active
            if ($(".burger-menu").hasClass('burger-menu--active') != true) {

                //Page Nav
                var elementExists = document.getElementById("page-nav"); //and not already there
                if (elementExists == null) {
                    var newNav = $(navbar).clone(true); //clone the nav and append it to header (pass true to clone events also)
                    newNav.attr('id', 'page-nav');

                    $(newNav).addClass('destination-hero__content__page-nav__sticky-wrapper--active');
                    $('#header').append(newNav);
                }

                //Title
                var elementExists = document.getElementById("page-nav-title"); //clone / append title
                if (elementExists == null) {
                    var newTitle = $(subnavTitle).clone(true);
                    newTitle.attr('id', 'page-nav-title')
                    $(newTitle).addClass('destination-hero__content__page-nav__title--sticky'); //create common style
                    $('#page-nav').append(newTitle);
                }
            }



        }
    }



    //SCROLLING
    //Navigation Jump -- add url #anchor modification
    $('.destination-hero__content__page-nav__list__item__link, .page-nav__collapse__list__item__link, #template-nav-title,  #down-arrow-button').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();

    })
    //End Product Nav
    function changePosition(id) {
        var target = $(id).offset().top;
        $('.page-nav__collapse').removeClass('page-nav__collapse--active');
        $('.page-nav__button').removeClass('page-nav__button--active');

        if (id != "#tours") {
            target = target - 140;
        } else {
            target = target - 80;
        }

        $('html, body').animate({ scrollTop: target }, 500);

        window.location.hash = id;
    }



    //SINGLE PAGE NAV
    //class behavior
    $(window).scroll(function () {
        isSelected($(window).scrollTop())
    });

    var sections = $('.destination-hero__content__page-nav__list__item__link');

    function isSelected(scrolledTo) {
        var threshold = 200;
        var i;

        for (i = 0; i < sections.length; i++) {
            var section = $(sections[i]);
            var target = getTargetTop(section);

            if (scrolledTo > target - threshold && scrolledTo < target + threshold) {
                var sectionHref = $(section).attr('href');
                var active = $('a[href="' + sectionHref + '"]');

                $('.destination-hero__content__page-nav__list__item__link').removeClass("current");
                active.addClass("current");
            }
        };
    }


    function getTargetTop(elem) {
        var id = elem.attr("href");
        var offset = 60;

        return $(id).offset().top - offset;
    }
    //END SINGLE PAGE NAV






    //SLIDERS
    $('#destination-hero__bg-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        centerMode: false,
        draggable: false,
        fade: true,
        arrows: false,
  
        speed: 800
    });

    //$('#destination-hero__bg-slider').slick('slickGoTo', 1);
    



    //location slider
    counter = new Odometer({
        el: document.querySelector("#odometer"),
        minIntegerLen: 2,
        duration: 200,
        value: 1
    });


    //--
    $('#destination-hero__content__location__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        asNavFor: '#destination-hero__bg-slider',
        centerMode: false,
        arrows: true,
        draggable: false,
        fade: true,
        
        prevArrow: '<button class="btn-circle btn-circle--small btn-white btn-circle--left destination-hero__content__location__slider__arrow-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-circle--small btn-white btn-circle--right destination-hero__content__location__slider__arrow-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    }).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        var num = (nextSlide + 1);
        setTimeout(function () {
            counter.update(num);
        }, 0);
    });



    //progress
    var time = 2;
    var $bar,
        $slick,
        isPause,
        tick,
        percentTime;

    $slick = $('.destination-hero__content__location__slider');
    $bar = $('.destination-hero__content__location__progress__bar .progress');

   
    

    function startProgressbar() {
        resetProgressbar();
        percentTime = 0;
        isPause = false;
        tick = setInterval(interval, 45); //dictates speed
    }

    function interval() {
        if (isPause === false) {
            percentTime += 1 / (time + 0.1);
            $bar.css({
                width: percentTime + "%"
            });
            if (percentTime >= 100) {
                $slick.slick('slickNext');
                startProgressbar();
            }
        }
    }

    function resetProgressbar() {
        $bar.css({
            width: 0 + '%'
        });
        clearTimeout(tick);
    }

    startProgressbar();
    $('.destination-hero__content__location__slider .slick-arrow').click(function () {

        startProgressbar();
    });
    //end progress



    $('#main-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        centerMode: true,
        prevArrow: '<button class="btn-circle btn-white btn-circle--left btn-circle--large destination-main__packages__best-selling__slider__btn-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-white btn-circle--right btn-circle--large destination-main__packages__best-selling__slider__btn-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 700,
                settings: {
                    arrows: false,
                }
            },
        ]
    });




    $('#secondary-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        prevArrow: '<button class="btn-circle btn-dark btn-circle--left related-slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-dark btn-circle--right related-slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                }
            },

        ]
    });


    $('#testimonials-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: true,
        prevArrow: '<button class="btn-circle btn-dark btn-circle--left destination-testimonials__slider-container__slider__arrow-left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-dark btn-circle--right destination-testimonials__slider-container__slider__arrow-right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',

    });

    //faq expand/hide
    $(".destination-faq__grid-container__faq__question").on("click", function (e) {
        e.preventDefault();
        let $this = $(this);
        $this.parent().find('.destination-faq__grid-container__faq__answer').slideToggle(350);
        $this.parent().find('.plus-minus-toggle').toggleClass('plus-collapsed');
        $this.parent().find('.destination-faq__grid-container__faq__question').toggleClass('destination-faq__grid-container__faq__question--active');

    });


});
