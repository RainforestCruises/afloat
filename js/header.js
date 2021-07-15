
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



  //Variables
  const headerDiv = document.querySelector('.header');
  const headerMain = document.querySelector('.header__main');

  const megaMenu = document.querySelector('.nav-mega');
  const burgerButton = document.querySelector('.burger-menu');
  const navMobile = document.querySelector('.nav-mobile');


  //HEADER --------------

  //Header Main -- Scroll
  window.addEventListener('scroll', fixNav);
  function fixNav() {

    let megaActive = megaMenu.classList.contains('active');

    //small nav
    if (window.scrollY == 0) {
      headerMain.classList.remove('small-nav');
    } else {
      headerMain.classList.add('small-nav');
    }

    //active (non-transparent)
    if (!opaqueNavAlways && !megaActive) {
      if (window.scrollY > 300) {
        headerMain.classList.add('active');
      } else {
        headerMain.classList.remove('active');
      }

    }

  }


  //Header Main -- Hover
  //Make navbar white on hover - add class: active

  $('.header__main').hover(
    function () {
      if (opaqueNavAlways == false) {
        headerMain.classList.add('active');
      }
    },
    function () {

      var mobileExpanded = burgerButton.classList.contains('burger-menu--active');    
      var megaActive = megaMenu.classList.contains('active');
      var pageNavActive = $('.nav-secondary').hasClass('active');

      var scrolledDown = false;
      if (window.scrollY > 300) {
        scrolledDown = true;
      }

      if (!mobileExpanded && !opaqueNavAlways && !pageNavActive && !scrolledDown && !megaActive) {    
        headerMain.classList.remove('active');
      }

    }
  )


  //Mouse Leave - remove mega / active
  $(document).mouseleave(function () {
   
    megaMenu.classList.remove('active');
    $('.nav-secondary').removeClass('mega-hide');

    let menuActive = navMobile.classList.contains('nav-mobile--active');

    if (window.scrollY == 0 && !opaqueNavAlways && !menuActive) {
      headerMain.classList.remove('active');
    }
  });

  //MEGA MENU -------------------------

  //Hover behavior
  $('.nav-mega').hover(
    function () {//on hover over

    },
    function () {//on hover out
      megaMenu.classList.remove('active');
      $('.nav-secondary').removeClass('mega-hide');

      if (window.scrollY == 0 && !opaqueNavAlways) {
        headerMain.classList.remove('active');
      }
    }

  )

  //Header Main Nav Link - Hover - Expand Mega Menu
  $('.header__main__nav__list__item__link.mega').hover(
    function () {
      var navelement = this.getAttribute("navelement");

      megaMenu.classList.add('active');
      headerMain.classList.add('active');
      $('.nav-secondary').addClass('mega-hide');


      if (navelement == "Destinations") {
        $('.nav-mega__nav--experiences').hide();
        $('.nav-mega__nav--destinations').show();


      } else if (navelement == "Experiences") {
        $('.nav-mega__nav--destinations').hide();
        $('.nav-mega__nav--experiences').show();
      }
      else {
        $('.nav-mega__nav--destinations').hide();
        $('.nav-mega__nav--experiences').show();
      }
    }, function () {
      var megaActive = megaMenu.classList.contains('active');
      if (window.scrollY == 0 && !opaqueNavAlways && !megaActive) {
        headerMain.classList.remove('active');
      }
    }
  );

   //Header Main Nav Link - Hover - No Mega Menu
  $('.header__main__nav__list__item__link.no-mega').hover(
    function () {
      megaMenu.classList.remove('active');
      headerMain.classList.add('active');
      $('.nav-secondary').removeClass('mega-hide');
    },
  );



  //MOBILE MENU -----------------------------------------

  //Burger  -- click
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




  //Resize Window - Close menus
  $(window).resize(function () {
    if ($(window).width() > 1000) {
      navMobile.classList.remove('nav-mobile--active');
      burgerButton.classList.remove('burger-menu--active');   
    }
    if ($(window).width() <= 1000) {
      megaMenu.classList.remove('active');
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
  //var navbar = $('.header');

  $(window).scroll(function () {
  
    let preventNavExpand = headerDiv.classList.contains('preventExpand'); //added and removed with delay from page nav

    let megaActive = megaMenu.classList.contains('active');

    if (!preventNavExpand && !megaActive) {
      var a = $(window).scrollTop();
      var b = headerDiv.offsetHeight;

      currentScrollTop = a;

      if (c < currentScrollTop && a > b + b) {
        headerDiv.classList.add("scrollUp");

        if (searchFilterBar != null) {
          searchFilterBar.classList.add("scrollUp");
        }

      } else if (c > currentScrollTop && !(a <= b)) {
        headerDiv.classList.remove("scrollUp");
        if (searchFilterBar != null) {
          searchFilterBar.classList.remove("scrollUp");
        }
      }
      c = currentScrollTop;
    }



  });


});

