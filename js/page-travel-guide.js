jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;



    $('#related-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        prevArrow: '<button class="btn-circle btn-circle--white btn-circle--left travel-guide-related__slider-area__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
        nextArrow: '<button class="btn-circle btn-circle--white btn-circle--right travel-guide-related__slider-area__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    centerMode: true
                }
            },

        ]
    });



    //Newsletter
    const body = document.querySelector('.body');
    const contactForm = document.querySelector('.contact');
    const popup = document.querySelector('.popup');
    const button = document.querySelector('#newsletterButton');

    $('.close-button').on('click', () => {
        $('.popup').removeClass('active');
        body.classList.remove('no-scroll');
    });

    document.addEventListener('click', evt => {


        const isContact = contactForm.contains(evt.target);
        const isButton = button.contains(evt.target);
        const isActive = popup.classList.contains('active');
        if (isActive) {
            if (!isContact && !isButton) {
                $('.popup').toggleClass('active');
                body.removeClass('no-scroll');
            }
        }

    });

    $('#newsletterButton').on('click', () => {
        $('.popup').addClass('active');
        body.classList.add('no-scroll');
    });

    $('.form-general').on('submit', function () {
        $('.contact__wrapper__intro__title').text('Thank You');
        $('.contact__wrapper__intro__introtext').hide();
        console.log('submitted');
    });

});


