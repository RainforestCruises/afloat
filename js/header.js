
jQuery(document).ready(function ($) {


  //phone-mobile
  const phoneMobile = document.getElementById('phone-mobile');
  const phoneMobileExpand = document.getElementById('phone-mobile-expand');

  phoneMobile.addEventListener('click', evt => {
    phoneMobileExpand.classList.toggle('active');
  });


  var opaqueNavAlways = false;
  if ($("body").hasClass("page-template-template-generic") || $("body").hasClass("page-template-template-about") || $("body").hasClass("page-template-template-contact") || $("body").hasClass("page-template-template-search") || $("body").hasClass("single-rfc_travel_guides") || $("body").hasClass("page-template-template-travel-guide")) {
    opaqueNavAlways = true;
    $('.header__main').addClass('active');
  }



  //HEADER --------------
  //Header Main -- Scroll
  const nav = document.querySelector('#header');
  const topOfNav = 60; //change to 0 for absolute top of page

  function fixNav() {

    var megaActive = $('.nav-mega').hasClass('active');

    //small nav
    if (window.scrollY == 0) {
      $('.header__main').removeClass('small-nav');
    } else {
      $('.header__main').addClass('small-nav');
    }


    //active (non-transparent)
    if (!opaqueNavAlways && !megaActive) {
      if (window.scrollY > 300) {
        $('.header__main').addClass('active');
      } else {
        $('.header__main').removeClass('active');
      }

    }

  }
  window.addEventListener('scroll', fixNav);

  //Header Main -- Hover
  //Make navbar white on hover - add class: active

  $('.header__main').hover(
    function () {
      if (opaqueNavAlways == false) {
        $('.header__main').addClass('active');
      }
    },
    function () {

      var mobileExpanded = $('.burger-menu').hasClass('burger-menu--active');
      var pageNavActive = $('.nav-secondary').hasClass('active');
      var megaActive = $('.nav-mega').hasClass('active');

      var scrolledDown = false;
      if (window.scrollY > 300) {
        scrolledDown = true;
      }

      if (!mobileExpanded && !opaqueNavAlways && !pageNavActive && !scrolledDown && !megaActive) {
        $('.header__main').removeClass('active');
      }

    }
  )




  //remove mega when mouse out of window
  $(document).mouseleave(function () {
    $('.nav-mega').removeClass('active');
    $('.nav-secondary').removeClass('mega-hide');
    //$('.nav-secondary').removeClass('mega-hide');
    if (window.scrollY == 0 && !opaqueNavAlways) {
      $('.header__main').removeClass('active');
    }
  });

  //MEGA
  //--hover behavior
  $('.nav-mega').hover(
    function () {//on hover over
      
    },
    function () {//on hover out
      $('.nav-mega').removeClass('active');
      //$('.nav-secondary').removeClass('mega-hide');
      $('.nav-secondary').removeClass('mega-hide');

      if (window.scrollY == 0 && !opaqueNavAlways) {
        $('.header__main').removeClass('active');
      }
    }




  )

  //main link -expand mega
  $('.header__main__nav__list__item__link.mega').hover(
    function () {
      var navelement = this.getAttribute("navelement");
      $('.nav-mega').addClass('active');
      $('.nav-secondary').addClass('mega-hide');

      $('.header__main').addClass('active');

      if (navelement == "Destinations") {
        $('.nav-mega__nav--experiences').hide();
        $('.nav-mega__nav--destinations').show();

        //$('.nav-mega__nav--destinations').fadeIn(200);

      } else if (navelement == "Experiences") {
        $('.nav-mega__nav--destinations').hide();
        $('.nav-mega__nav--experiences').show();
      }
      else {
        $('.nav-mega__nav--destinations').hide();
        $('.nav-mega__nav--experiences').show();
      }
    }, function () {
      var megaActive = $('.nav-mega').hasClass('active');
      if (window.scrollY == 0 && !opaqueNavAlways && !megaActive) {
        $('.header__main').removeClass('active');
      }
    }
  );

  $('.header__main__nav__list__item__link.no-mega').hover(
    function () {
      $('.nav-mega').removeClass('active');
      $('.header__main').addClass('active');
    },
  );



  //Burger Menu

  //Burger Menu -- click
  $(".burger-menu ").on("click", function () {

    $(".burger-menu").toggleClass('burger-menu--active');
    $('.nav-mobile').toggleClass('nav-mobile--active');


    //on open
    if ($(".nav-mobile").hasClass('nav-mobile--active') == true) {

      $('.header__main').addClass('active');
      $('.nav-mobile__content-panel').removeClass('slide-out-left');
      $('.nav-mobile__content-panel').removeClass('slide-center');
      document.body.classList.add('lock-scroll');

      //$('#page-nav').hide();

      //on close
    } else {
      //$('#page-nav').show();
      document.body.classList.remove('lock-scroll');
      if (window.scrollY <= topOfNav) {
        if (opaqueNavAlways == false) {
          $('.header__main').removeClass('header__main--opaque-nav');
        }
      }
      $(".burger-menu").removeClass('burger-menu--active');

    }
  });

  //Toggle Mega / Mobile -- resize window
  $(window).resize(function () {
    if ($(window).width() > 1000) {
      $('.nav-mobile').removeClass('nav-mobile--active');
      $(".burger-menu").removeClass('burger-menu--active');

    }
    if ($(window).width() <= 1000) {
      $('.nav-mega').removeClass('active');
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



  //Hidden Nav

  const searchFilterBar = document.getElementById('search-filter-bar'); //for search template


  var c;
  var currentScrollTop = 0;
  var navbar = $('.header');

  $(window).scroll(function () {

    let preventNavExpand = $('.header').hasClass('preventExpand'); //added and removed with delay from page nav
    let isMega = $('.nav-mega').hasClass('active');

    if (!preventNavExpand && !isMega) {
      var a = $(window).scrollTop();
      var b = navbar.height();

      currentScrollTop = a;

      //CHECK IF MEGA OPEN!!
      if (c < currentScrollTop && a > b + b) {
        navbar.addClass("scrollUp");

        if (searchFilterBar != null) {
          searchFilterBar.classList.add("scrollUp");
        }

      } else if (c > currentScrollTop && !(a <= b)) {
        navbar.removeClass("scrollUp");
        if (searchFilterBar != null) {
          searchFilterBar.classList.remove("scrollUp");
        }
      }
      c = currentScrollTop;
    }



  });


});

