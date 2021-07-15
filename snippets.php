<img <?php afloat_responsive_image($sliderImage['id'], 'full-hero-large', array('full-hero-large', 'full-hero-medium', 'full-hero-small', 'full-hero-xsmall')); ?> alt="">

<!-- Preload Fonts -->
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/Metropolis/Metropolis-ExtraLight.ttf' ?>" as="font">
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/Metropolis/Metropolis-Regular.ttf' ?>" as="font">
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/Metropolis/Metropolis-Medium.ttf' ?>" as="font">
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/Metropolis/Metropolis-SemiBold.ttf' ?>" as="font">
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/Metropolis/Metropolis-Bold.ttf' ?>" as="font">
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/Metropolis/Metropolis-Black.ttf' ?>" as="font">

<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/PlayfairDisplay/static/PlayfairDisplay-Regular.ttf' ?>" as="font">
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/PlayfairDisplay/static/PlayfairDisplay-Medium.ttf' ?>" as="font">
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/PlayfairDisplay/static/PlayfairDisplay-SemiBold.ttf' ?>" as="font">
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/PlayfairDisplay/static/PlayfairDisplay-Bold.ttf' ?>" as="font">
<link rel="preload" href="<?php echo get_template_directory_uri() . '/fonts/PlayfairDisplay/static/PlayfairDisplay-ExtraBold.ttf' ?>" as="font">

<link rel="preload" href="<?php echo get_template_directory_uri() . '/vendor/slick/fonts/slick.ttf' ?>" as="font">




<div class="header__main__right__phone-mobile" id="phone-mobile">
    <svg>
        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-phone-call"></use>
    </svg>
    <div class="header__main__right__phone-mobile__expand" id="phone-mobile-expand">
        <div class="header__main__right__phone-mobile__expand__title">
            Get in Touch
        </div>
        <a class="header__main__right__phone-mobile__expand__cta" href="tel:<?php echo get_field('phone_number_numeric', 'options') ?>">Call Now</a>
    </div>
</div>









//MOBILE MENU -----------------------------------------

//Burger -- click
burgerButton.addEventListener('click', evt => {

burgerButton.classList.toggle('burger-menu--active');
navMobile.classList.toggle('nav-mobile--active');

let menuActive = navMobile.classList.contains('nav-mobile--active');
//on open
if (menuActive) {

headerMain.classList.add('active');
$('.nav-mobile__content-panel').removeClass('slide-out-left');
$('.nav-mobile__content-panel').removeClass('slide-center');
document.body.classList.add('lock-scroll');

//on close
} else {

document.body.classList.remove('lock-scroll');

if (window.scrollY == 0) {
if (opaqueNavAlways == false) {
headerMain.classList.remove('active');
}
}

burgerButton.classList.remove('burger-menu--active');

}

});


//New Mobile Menu
const mobileButtons = [...document.querySelectorAll('.nav-mobile__content-panel__button')];
mobileButtons.forEach(item => {
item.addEventListener('click', () => {
let menuLink = item.getAttribute('menuLinkTo');

var topPanel = document.querySelector('.nav-mobile__content-panel--top');
var subPanel = document.querySelector('[menuid="' + menuLink + '"]');

var isBackButton = $(item).hasClass('nav-mobile__content-panel__button--back');
if (isBackButton) {
$(topPanel).removeClass('slide-out-left');
$(item).parent().removeClass('slide-center');
} else {

if (!item.classList.contains("mobile-link")) {
topPanel.classList.add('slide-out-left');
$(subPanel).addClass('slide-center');
} else {
$('.nav-mobile').removeClass('nav-mobile--active');
$(".burger-menu").removeClass('burger-menu--active');
document.body.classList.remove('lock-scroll');
}

}


});
})


//Page Nav-- Hover
$('#template-nav').hover(
function () { },
function () {
if ($(".burger-menu").hasClass('burger-menu--active') != true) {
$('.nav-mega').removeClass('active');
}
}
);