
jQuery(document).ready(function ($) {


    //Burger
    //Burger Menu -- click
    $(".page-nav__button").on("click", function () {

        $('.page-nav__button').toggleClass('page-nav__button--active');
        $('.page-nav__collapse').toggleClass('page-nav__collapse--active');

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

                var elementExists = document.getElementById("page-nav"); //and not already there
                if (elementExists == null) {
                    var newNav = $(navbar).clone(true); //clone the nav and append it to header (pass true to clone events also)
                    newNav.attr('id', 'page-nav');

                    $(newNav).addClass('destination-hero__content__page-nav__sticky-wrapper--active');
                    $('#header').append(newNav);
                }

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
    $('.destination-hero__content__page-nav__list__item__link, #template-nav-title, .page-nav__collapse__list__item, #down-arrow-button').click(function (event) {
        var id = $(this).attr('href');
        var target = $(id).offset().top;
        $('.page-nav__collapse').removeClass('page-nav__collapse--active');
        $('.page-nav__button').removeClass('page-nav__button--active');

        console.log(id);

        if (id != "#tours") {
            target = target - 200;
        } else {
            target = target - 80;

        }

        $('html, body').animate({ scrollTop: target }, 500);
        event.preventDefault();

    })
    //End Product Nav




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
    $('#destination-hero__bg').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        centerMode: false,
        draggable: false,
        fade: true,
        arrows: false
    });

    //destination-hero-content
    $('#destination-hero__content').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        asNavFor: '#destination-hero__bg',
        centerMode: false,
        arrows: false,
        draggable: false,
        fade: true,
        responsive: [
            {
                // breakpoint: 1000,
                // settings: {
                //     arrows: true,
                //     prevArrow: '<button class="btn-circle btn-white btn-circle--left destination-intro__tours__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="img/sprite.svg#icon-arrow-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="img/sprite.svg#icon-arrow-left"></use></svg></button>',
                //     nextArrow: '<button class="btn-circle btn-white btn-circle--right destination-intro__tours__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="img/sprite.svg#icon-arrow-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="img/sprite.svg#icon-arrow-right"></use></svg></button>',
                   
                // }
            }
        ]
    });


    //destination-hero__nav - slider config based on number of sub location slides
    navSlidesToShow = 1;
    if (destinationCount == 3) {
        navSlidesToShow = 2;
    } else if (destinationCount > 3) {
        navSlidesToShow = 3;
    }

    //destination-hero__nav
    $('#destination-hero__nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        centerMode: true,
        centerPadding: 0,
        focusOnSelect: true,
        arrows: true,
        asNavFor: '#destination-hero__content, #destination-hero__bg',
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 1,

                }
            }
        ]

    });




    $('#destination-intro__tours__slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        centerMode: false,
        prevArrow: '<button class="btn-circle btn-white btn-circle--left destination-intro__tours__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="img/sprite.svg#icon-arrow-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="img/sprite.svg#icon-arrow-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-white btn-circle--right destination-intro__tours__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="img/sprite.svg#icon-arrow-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="img/sprite.svg#icon-arrow-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    prevArrow: '<button class="btn-circle btn-circle--small btn-circle--solid btn-circle--left destination-intro__tours__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="img/sprite.svg#icon-arrow-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="img/sprite.svg#icon-arrow-left"></use></svg></button>',
                    nextArrow: '<button class="btn-circle btn-circle--small btn-circle--solid btn-circle--right destination-intro__tours__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="img/sprite.svg#icon-arrow-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="img/sprite.svg#icon-arrow-right"></use></svg></button>',

                }
            }
        ]
    });




    $('.destination-hero__play__button').on('click', function () {
        $('#destination-video')[0].play();
    })

    $('.video-popup__close').on('click', function () {
        $('#destination-video')[0].pause();
    })


});
