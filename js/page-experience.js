
jQuery(document).ready(function ($) {
    const templateUrl = page_vars.templateUrl;






    $('.experience-region__slider-area__slider').slick({
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





    //SCROLLING
    const downArrow = document.querySelector('#down-arrow-button');
    downArrow.addEventListener('click', (event) => {
        var id = downArrow.getAttribute('href');
        var target = $(id).offset().top;

        target = target;
     
        $('html, body').animate({ scrollTop: target }, 500);
        window.location.hash = id;

        event.preventDefault();

    });



    
    //Newsletter
    $('.close-button').on('click', () => {
        $('.popup').removeClass('active');
        body.classList.remove('no-scroll');
    });

    document.addEventListener('click', evt => {
        const contactForm = document.querySelector('.contact');
        const popup = document.querySelector('.popup');
        const button = document.querySelector('#newsletterButton');

        const isContact = contactForm.contains(evt.target);
        const isButton = button.contains(evt.target);
        const isActive = popup.classList.contains('active');
        if (isActive) {
            if (!isContact && !isButton) {
                $('.popup').toggleClass('active');
                body.classList.remove('no-scroll');
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








