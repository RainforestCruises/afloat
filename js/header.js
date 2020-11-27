
jQuery(document).ready(function ($) {
  //HEADER --------------
  //Header Main -- Scroll
  const nav = document.querySelector('#header');
  const topOfNav = 60; //change to 0 for absolute top of page

  function fixNav() {
    if (window.scrollY >= topOfNav) {
      $('.header__main').addClass('header__main--small-nav header__main--opaque-nav');
    } else {
      //if mega not active
      if ($('.nav-mega').hasClass('nav-mega--active') != true) {

        $('.header__main').removeClass('header__main--small-nav ');

        if ($('.burger-menu').hasClass('burger-menu--active') != true) {
          if (!$("body").hasClass("page-template-template-search")) {
            $('.header__main').removeClass('header__main--opaque-nav');

          }
        }
      }
    }
  }
  window.addEventListener('scroll', fixNav);

  //Header Main -- Hover
  if (!$("body").hasClass("page-template-template-search")) {
    $('.header__main').hover(
      function () { $('.header__main').addClass('header__main--opaque-nav'); },
      function () {

        //if not small and mega active
        if ($('.header__main').hasClass('header__main--small-nav') != true) {

          if ($('.burger-menu').hasClass('burger-menu--active') != true) {
            if ($('.nav-mega').hasClass('nav-mega--active') != true) {
              $('.header__main').removeClass('header__main--opaque-nav');
            }
          }
        }
      }
    )

  } else {
    $('.header__main').addClass('header__main--opaque-nav');
  }





  //MEGA
  //--hover behavior
  $('.nav-mega').hover(
    function () { },
    function () {

      //if no active burger
      if ($(".burger-menu").hasClass('burger-menu--active') != true) {

        //if product-nav then dont do (sticky wrapper)
        var elementExists = document.getElementById("page-nav");
        if (elementExists == null) {
          $('.nav-mega').removeClass('nav-mega--active');
        }

        //if not header small -- remove opaque from header__main
        if ($('.header__main').hasClass('header__main--small-nav') != true) {
          $('.header__main').removeClass('header__main--opaque-nav');
        }
      }
    }
  )

  //main link -expand mega
  $('#mega--destinations').hover(
    function () {
      //$('.nav-mega').addClass('nav-mega--active'); 
    },
  );



  //Burger Menu

  //Burger Menu -- click
  $(".burger-menu ").on("click", function () {

    $(".burger-menu").toggleClass('burger-menu--active');
    $('.header__collapse').toggleClass('header__collapse--active');

    //hide while burger active
    if ($(".header__collapse").hasClass('header__collapse--active') == true) {
      $('#page-nav').hide();
    } else {
      $('#page-nav').show();
    }
  });

  //Burger Menu -- resize window
  $(window).resize(function () {
    if ($(window).width() > 1000) {
      $('.header__collapse').removeClass('header__collapse--active');
      $(".burger-menu").removeClass('burger-menu--active');
    }
    if ($(window).width() <= 1000) {
      $('.nav-mega').removeClass('nav-mega--active');
    }
  });



  //Collapse Menu

  //Collapse Menu -- accordion behavior
  //--main
  var acc = document.getElementsByClassName("header__collapse__accordion--main");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {

      //see if currently open
      var open = false;
      if ($(this).next().css('display') == 'block') {
        open = true;
      }

      //hide all others
      var x = 0
      $(acc).each(function () {
        $(acc[x]).removeClass('header__collapse__accordion--active');
        var panel = $(acc[x]).next();
        $(panel).css('display', 'none');
        x = x + 1;
      })

      //display / hide current one
      if (open == true) {
        $(this).removeClass("header__collapse__accordion--active");
        var panelCurrent = $(this).next();
        $(panelCurrent).css('display', 'none');
      } else {
        $(this).addClass("header__collapse__accordion--active");
        var panelCurrent = $(this).next();
        $(panelCurrent).css('display', 'block');
      }

    });
  }


  //Collapse Menu -- accordion behavior
  //--destinations
  var accDestinations = document.getElementsByClassName("header__collapse__accordion--destinations");
  var i;

  for (i = 0; i < accDestinations.length; i++) {
    accDestinations[i].addEventListener("click", function () {

      //see if currently open
      var open = false;
      if ($(this).next().css('display') == 'block') {
        open = true;
      }

      //hide all others
      var x = 0
      $(accDestinations).each(function () {
        $(accDestinations[x]).removeClass('header__collapse__accordion--active');
        var panel = $(accDestinations[x]).next();
        $(panel).css('display', 'none');
        x = x + 1;
      })

      //display / hide current one
      if (open == true) {
        $(this).removeClass("header__collapse__accordion--active");
        var panelCurrent = $(this).next();
        $(panelCurrent).css('display', 'none');
      } else {
        $(this).addClass("header__collapse__accordion--active");
        var panelCurrent = $(this).next();
        $(panelCurrent).css('display', 'block');
      }

    });
  }
  //end collapse


  //Page Nav-- Hover
  $('#template-nav').hover(
    function () { },
    function () {
      if ($(".burger-menu").hasClass('burger-menu--active') != true) {
        $('.nav-mega').removeClass('nav-mega--active');
      }
    }
  );

});

