jQuery(document).ready(function ($) {

    //on load
    var identifier = window.location.hash;
    if ($(identifier).length) {
        changePosition(identifier);
    }

    //PAGE NAV
    var navbar = document.querySelector('#template-nav');
    var subnavTitle = document.querySelector('#template-nav-title');
    var offsetY = navbar.offsetTop;


    //On Scroll Listener
    window.onscroll = function () { scrollCheck() };
    function scrollCheck() {

        var templateNavVisible = Utils.isElementInView($('#template-nav'), false);

        if (templateNavVisible) {
            $('#page-nav').remove();
            $('.page-nav__collapse').removeClass('page-nav__collapse--active');
            $('.page-nav__button').removeClass('page-nav__button--active');

        } else { //if template nav is out of view

            //and if burger menu isnt active
            if ($(".burger-menu").hasClass('burger-menu--active') != true) {

                //Page Nav
                var pageNavExists = document.getElementById("page-nav"); //and not already there
                if (pageNavExists == null) {
                    var newNav = $(navbar).clone(true); //clone the nav and append it to header (pass true to clone events also)
                    newNav.attr('id', 'page-nav'); //give it the id page-nav (cloned from template nav)

                    $(newNav).addClass('active'); //fix
                    $('#header').append(newNav);
                }


            }
        }

        isSelected($(window).scrollTop());
    }

    //On Scroll -- Apply current to nav links
    var sections = $('.page-nav-template');
    function isSelected(scrolledTo) {
        var threshold = 200;
        var i;

        for (i = 0; i < sections.length; i++) {
            var section = $(sections[i]);
            var target = getTargetTop(section);

            if (scrolledTo > target - threshold && scrolledTo < target + threshold) {
                var sectionHref = $(section).attr('href');
                var active = $('a[href="' + sectionHref + '"]');

                $('.page-nav-template').removeClass("current");
                if (active != null) {
                    active.addClass("current");
                }
            }
        };
    }

    //Get top distance
    function getTargetTop(elem) {
        var id = elem.attr("href");
        return $(id).offset().top;
    }

    // On Click - Nav Links, href change position
    $('.page-nav-template, .page-nav__collapse__list__item__link, #template-nav-title,  #down-arrow-button').click(function (event) {
        var id = $(this).attr('href');
        changePosition(id)
        event.preventDefault();
    })

    // Animate Change Position
    function changePosition(id) {

        $('.page-nav__collapse').removeClass('page-nav__collapse--active'); //if mobile open - close menu / button
        $('.page-nav__button').removeClass('page-nav__button--active');

        var target = $(id).offset().top;
        target = target - 160;

        $('html, body').animate({ scrollTop: target }, 500);
        window.location.hash = id;
    }





    //Burger
    //Burger Menu -- click
    $(".page-nav__button").on("click", function () {

        $('.page-nav__button').toggleClass('page-nav__button--active');
        $('.page-nav__collapse').toggleClass('page-nav__collapse--active');

    });

    //Burger Menu -- resize window -- remove collapse menu over 1000
    $(window).resize(function () {
        if ($(window).width() > 600) {
            $('.page-nav__collapse').removeClass('page-nav__collapse--active');
            $('.page-nav__button').removeClass('page-nav__button--active');

        }
    });


});

