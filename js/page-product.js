jQuery(document).ready(function ($) {



  const downCta = document.querySelector('#down-arrow-button');
  downCta.addEventListener('click', () => {
      var target = $('#overview').offset().top - 125;
      $('html, body').animate({ scrollTop: target }, 500);
      console.log('boom');
  });



  //Side Info Tabs - Overview / Inclusions / Exclusions
  const tabArray = [...document.querySelectorAll('.product-itinerary-slide__top__info__tabs__item')];
  tabArray.forEach(item => {
    item.addEventListener('click', () => {
      let itineraryTab = item.getAttribute("itinerary-tab");
      let tabType = item.getAttribute("tab-type");

      //content panes
      let tabPanes = [...document.querySelectorAll('.product-itinerary-slide__top__info__content[itinerary-tab="' + itineraryTab + '"]')];
      tabPanes.forEach((x) => {
        x.classList.remove('current');
      });

      tabPanes.forEach((x) => {
        if (x.getAttribute('tab-type') == tabType) {
          x.classList.add('current')
        }
      });

      //tabs nav
      let tabNavs = [...document.querySelectorAll('.product-itinerary-slide__top__info__tabs__item[itinerary-tab="' + itineraryTab + '"]')];
      tabNavs.forEach((x) => {
        x.classList.remove('current');
      });

      tabNavs.forEach((x) => {
        if (x.getAttribute('tab-type') == tabType) {
          x.classList.add('current')
        }
      });

    });
  })

  //Main Itinerery
  $('#itineraries-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    draggable: false,
    swipe: false,
    swipeToSlide: false,
    centerMode: true,
    adaptiveHeight: true,

  });
  $('#itineraries-slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '#itineraries-slider',
    dots: false,
    //centerMode: true,
    focusOnSelect: true,
    arrows: true,
    prevArrow: '<button class="product-itineraries__nav__slider__btn product-itineraries__nav__slider__btn--left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
    nextArrow: '<button class="product-itineraries__nav__slider__btn product-itineraries__nav__slider__btn--right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,

        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 1,

        }
      }
    ]
  });



  //Days slider
  $('.product-itinerary-slide__bottom__days').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true,
    fade: true,
    focusOnSelect: true,
    arrows: true,
    dots: true,
    swipe: true,
    prevArrow: '<button class="product-itinerary-slide__bottom__days__btn product-itinerary-slide__bottom__days__btn--left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
    nextArrow: '<button class="product-itinerary-slide__bottom__days__btn product-itinerary-slide__bottom__days__btn--right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',

    customPaging: function (slider, i) {
      var thumb = $(slider.$slides[i]).data();
      return '<a class="dot">' + (i + 1) + '</a>';
    },
  })
    .on('afterChange', function (event, slick, currentSlide, nextSlide) {
      $('#itineraries-slider').slick("setOption", '', '', true);
    });







  // Read More
  $("#readmore-button").click(function (e) {
    // record if our text is expanded
    var isExpanded = $(e.target).parent().hasClass("expand");

    //close all open paragraphs
    $(".product-overview__content.expand").removeClass("expand");
    $("#readmore-button").parent().removeClass("expand");

    // if target wasn't expand, then expand it
    if (!isExpanded) {
      $('.product-overview__content').addClass("expand");
      $(e.target).parent().addClass("expand");
      $(e.target).text("Read Less");
    } else {
      $(e.target).text("Read More");

    }
  });


  //Hotels Slider (must initialize before tab nav functions for position init)
  $('#hotels-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    prevArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--left product-cabins__hotels__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--right product-cabins__hotels__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 3,
          arrows: true,

        }
      },
      {
        breakpoint: 750,
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



  // //Anchor behavior
  // //on load
  // var identifier = window.location.hash;
  // if ($(identifier).length) {
  //   changeTabs(identifier);
  // }

  // //fires when anchor changed
  // window.addEventListener('hashchange', function () {
  //   var identifier = window.location.hash;
  //   if ($(identifier).length) {
  //     changeTabs(identifier);
  //   } else {
  //     changeTabs('#overview');

  //   }
  // })

  //Navigation Events - change anchor
  $('.product-hero__top__content__tab-list__item__link, .goto-cabins, .goto-itineraries, .goto-prices, .goto-dates').click(function (event) {
    event.preventDefault();
    var tab_id = $(this).attr('href');
    window.location.hash = tab_id;

  })


  //Change Tabs Function
  function changeTabs(identifier) {
    tab_id = identifier.substring(1); //remove hash

    $('.product-hero__top__content__tab-list__item').removeClass('current');
    $('.product-content__page.tab-content').removeClass('current');

    $(".tab-" + tab_id).addClass('current'); //apply to both original / clone (sticky) -- class is same name as data-tab id
    $("#" + tab_id).addClass('current'); //apply to tab content

    //tab jump marks and offsets
    var offset = 0;


    //must initialize position of hotels slider on cabin tab select
    if (tab_id == "cabins") {
      $('#hotels-slider').slick('setPosition');
    }

    //responsive @ 1000
    if ($(window).width() > 1000) {
      offset = 120;
      if (tab_id == "itineraries") {
        offset = 180
      }
    } else if ($(window).width() < 600) {
      offset = 105;
      if (tab_id == "itineraries") {
        offset = 155
      }
    }
    else {
      offset = 90;
      if (tab_id == "itineraries") {
        offset = 140
      }
    }

    //if the sticky nav is visible
    var elementExists = document.getElementById("page-nav");
    if (elementExists != null) {
      console.log('yes')
      $([document.documentElement, document.body]).animate({
        scrollTop: $("#sentinal-" + tab_id).offset().top - offset
      }, 300);
    } else {

    }
  }



  //Date and Price Grid Time Config
  //display Itinerary Side Info for current year only
  $('.date-grid').hide();
  $('.date-grid__' + currentYear).show();

  $('.price-grid').hide();
  $('.price-grid__' + currentYear).show();



  // //Image Lightboxes
  // $("a#map-lightbox").fancybox(
  //   {
  //     'overlayShow': true,
  //     'transitionIn': 'elastic',
  //     'transitionOut': 'elastic'
  //   }
  // );


  //Itineraries --------------------------------
  //Price / Availability
  $('.itinerary-year-select').select2({
    width: '100%',
    minimumResultsForSearch: -1
  });

  //Itinerary Year Select on Side Details - Show Hide Date / Price Grids for selected year
  $('.itinerary-year-select').on('change', function () {
    var year = $(this).val();
    var tab_id = $(this).attr('data-tab');

    $('.date-grid[data-tab="' + tab_id + '"]').hide();
    $('.date-grid__' + year + '[data-tab="' + tab_id + '"]').show();

    $('.price-grid[data-tab="' + tab_id + '"]').hide();
    $('.price-grid__' + year + '[data-tab="' + tab_id + '"]').show();

  });


  //D2D - Expand Day
  $(".product-itineraries__itinerary__d2d__days__day__button, .product-itineraries__itinerary__d2d__days__day__header").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);

    $this.parent().toggleClass('product-itineraries__itinerary__d2d__days__day--active') //day

    $this.parent().find('.product-itineraries__itinerary__d2d__days__day__image-content').slideToggle(350);
    $this.parent().find('.product-itineraries__itinerary__d2d__days__day__content').slideToggle(350);
    $this.parent().find('.product-itineraries__itinerary__d2d__days__day__snippet').toggle(175);

    if (!$this.parent().hasClass('product-itineraries__itinerary__d2d__days__day--active')) {
      //closing -- scroll to top of element
      let dayHeader = $this.parent();
      $('html, body').animate({
        scrollTop: $(dayHeader).offset().top - 180 //#DIV_ID is an example. Use the id of your destination on the page
      }, 'fast');

    }

  });

  //Inclusions / Exclusions
  $('.view-exclusions').click(function () {

    var tab_id = $(this).val();

    var exclusions = $('#exclusions-list[data-tab="' + tab_id + '"]');
    var inclusions = $('#inclusions-list[data-tab="' + tab_id + '"]');
    exclusions.removeClass('inclusions-area__itinerary-inclusions--hidden');
    inclusions.addClass('inclusions-area__itinerary-inclusions--hidden');

    $('#InclusionsTitle[data-tab="' + tab_id + '"]').text("What's Excluded");

  })

  $('.view-inclusions').click(function () {
    var tab_id = $(this).val();

    var inclusions = $('#inclusions-list[data-tab="' + tab_id + '"]');
    var exclusions = $('#exclusions-list[data-tab="' + tab_id + '"]');

    inclusions.removeClass('inclusions-area__itinerary-inclusions--hidden');
    exclusions.addClass('inclusions-area__itinerary-inclusions--hidden');
    $('#InclusionsTitle[data-tab="' + tab_id + '"]').text("What's Included");

  })

  //Dates --------------------------------------
  //Controls
  //departure-expand

  $('#dates-year-select').select2({
    placeholder: "Select Year",
    minimumResultsForSearch: -1,
    dropdownAutoWidth: true,
    width: 'auto',
  });
  $('#dates-month-select').select2({
    placeholder: "Select Month",
    dropdownAutoWidth: true,
    width: 'auto',

    minimumResultsForSearch: -1
  });
  $('#dates-itinerary-select').select2({
    placeholder: "Select Itinerary",
    dropdownAutoWidth: true,
    width: 'auto',
    minimumResultsForSearch: -1,
    //theme: 'material'
  });

  //selection controls
  $('#dates-itinerary-select').on('change', function () {
    var itineraryId = $(this).val();
    $('#search-form').submit();
  });

  $('#dates-month-select').on('change', function () {
    var monthNumber = $(this).val();
    var year = $('#dates-year-select').val();
    if (year == '') { //if year not selected yet
      var d = new Date();
      var currentMonth = (d.getMonth()) + 1;
      if (monthNumber < currentMonth) { // if selected month is before this month -- select the following year
        $('#dates-year-select').val(d.getFullYear() + 1).trigger("change");
      } else { // otherwise select current year
        $('#dates-year-select').val(d.getFullYear()).trigger("change");
      }
    }
    $('#search-form').submit();
  });

  $('#dates-year-select').on('change', function () {
    var year = $(this).val();
    $('#search-form').submit();
  });


  //SEARCH SUBMIT
  reloadResults(); //first time page loads
  $('#search-form').submit(function () {
    reloadResults();
    return false;
  });

  //SEARCH FUNCTION
  function reloadResults() {
    var searchForm = $('#search-form'); //get form
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(), // form data
      type: searchForm.attr('method'), // POST
      beforeSend: function () {
        $('#response').html('<div class="product-dates__search-area__results__loading"><div class="lds-dual-ring"></div></div>'); //loading spinner
      },
      success: function (data) {
        $('#response').html(data); // insert data

        //Product Navigation
        $('.results-goto-itineraries').click(function () {
          var tab_id = $(this).attr('href');
          window.location.hash = tab_id;


          var subTabId = $(this).attr('data-tab');

          $('.product-intro__nav__list__item').removeClass('current');
          $('.product-itineraries__itinerary.tab-content').removeClass('current');

          $("#" + subTabId + "-nav").addClass('current'); //add current class to both nav tab and content
          $("#" + subTabId).addClass('current');
        })
        //End Product Nav

        //expand item detail
        $(".departure-expand").on("click", function (e) {
          e.preventDefault();
          let $this = $(this);
          $this.parent().parent().next().slideToggle(350); //bottom div
          $this.parent().parent().parent().toggleClass('product-dates__search-area__results__itinerary-group__departures__departure--active') //departure
        });

      }
    });
    //return false;
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


  //Page Nav -- Sticky 
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

          $(newNav).addClass('product-hero__top__content__sticky-wrapper--active');
          $('#header').append(newNav);
        }

        var elementExists = document.getElementById("page-nav-title"); //clone / append title
        if (elementExists == null) {
          var newTitle = $(subnavTitle).clone(true);
          newTitle.attr('id', 'page-nav-title')
          $(newTitle).addClass('product-hero__top__content__title-group__title--sticky'); //create common style
          $('#page-nav').append(newTitle);
        }
      }
    }
  }

  //SCROLLING
  //Navigation Jump 
  $('#template-nav-title, .page-nav__collapse__list__item__link').click(function (event) {
    event.preventDefault();
    $('.page-nav__collapse').removeClass('page-nav__collapse--active');
    $('.page-nav__button').removeClass('page-nav__button--active');

    var tab_id = $(this).attr('href');
    window.location.hash = tab_id;


  })
  //End Product Nav







  //Areas Slider (must select class for chained sliders)
  $('.product-areas__slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    fade: false,
    centerMode: true,
    asNavFor: '.product-areas__slider-nav',
    focusOnSelect: true,
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

        }
      }
    ]
  });
  $('.product-areas__slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.product-areas__slider',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    variableWidth: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,

        }
      }
    ]
  });

  //Reviews Slider
  $('#reviews-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    arrows: true,
    lazyLoad: 'ondemand',
    prevArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--left reviews-slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--right reviews-slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 600,
        settings: {

        }
      }
    ]
  });

  var relatedCount = 4;
  var slidesToShow = 4;
  if (relatedCount > 3) {
    slidesToShow = 4;
  } else if (relatedCount > 1) {
    slidesToShow = 2;
  } else {
    slidesToShow = 1;
  }






  //Related Products Slider
  $('#related-slider').slick({
    infinite: true,
    slidesToShow: slidesToShow,
    slidesToScroll: 1,
    initialSlide: 0,
    lazyLoad: 'ondemand',
    arrows: true,
    dots: false,
    prevArrow: '<button class="btn-circle btn-dark btn-circle--left related-slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-dark btn-circle--right related-slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 1460,
        settings: {
          slidesToShow: (slidesToShow < 3) ? slidesToShow : 3,
          slidesToScroll: (slidesToShow < 3) ? slidesToShow : 3,
          infinite: true,
        }
      },
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: (slidesToShow < 2) ? slidesToShow : 2,
          slidesToScroll: (slidesToShow < 2) ? slidesToShow : 2
        }
      },
      {
        breakpoint: 680,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,

        }
      }
    ]
  });

  //Product Gallery
  $('#product-gallery').on('init', function (event, slick) {
    //$(this).find('.slick-slide[data-slick-index="' + 2 + '"]').addClass('product-slick-enlarge');
  }).slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    lazyLoad: 'ondemand',
    initialSlide: 0,
    //variableWidth: true,
    focusOnSelect: true,
    arrows: true,
    prevArrow: '<button class="btn-circle btn-circle--small btn-circle--noborder btn-circle--left product-hero__gallery__slick__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-circle--noborder btn-circle--right product-hero__gallery__slick__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 1375,
        settings: {
          slidesToShow: 2,


        }
      }
    ],
  })


  //Magnific Images
  //Gallery
  $('#product-gallery').magnificPopup({
    delegate: '.slick-slide:not(.slick-cloned) .product-hero__gallery__slick__item a', 
    type: 'image',
    navigateByImgClick: true, 
    gallery:{
      enabled:true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after 
    }
  });

  $('#gallery-expand-button').on('click', function () {
		
		var gallery = $('#product-gallery');
    
		$(gallery).magnificPopup({
      delegate: '.slick-slide:not(.slick-cloned) .product-hero__gallery__slick__item a', 
			type:'image',
			gallery: {
        enabled:true,
        navigateByImgClick: true,
        preload: [0,1] // Will preload 0 - before current, and 1 after 
			}
		}).magnificPopup('open');
 });

 
//Itinerary Map
$('#itinerary-map-image').magnificPopup({
  type: 'image',
});
//deckplan
$('#deckplan-image').magnificPopup({
  type: 'image',
});



  //Tabs Nav Itinerary (3/4/5 day...)
  $('.product-itineraries__nav__list li').click(function () {
    var tab_id = $(this).attr('data-tab');


    $('.product-itineraries__nav__list__item').removeClass('current');
    $('.product-itineraries__itinerary.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#" + tab_id).addClass('current');
  })

  //Itinerary Page Arrows
  $('.product-itineraries__itinerary__map__btn').click(function () {
    var tab_id = $(this).attr('data-tab');
    console.log(tab_id)
    $('.product-itineraries__itinerary.tab-content').removeClass('current');
    $(".product-itineraries__nav__item").removeClass('current');
    $("#" + tab_id + "-nav").addClass('current');
    $("#" + tab_id).addClass('current');
  })


  //Inex Tabs (all itineraries)
  var inexTabList = document.querySelectorAll(".product-itineraries__itinerary__inclusions__tabs__list li");
  inexTabList.forEach(function (tab) {
    tab.addEventListener('click', function () {
      var tab_name = $(this).attr('name');

      $('.product-itineraries__itinerary__inclusions__tabs__item').removeClass('current');
      $('.product-itineraries__itinerary__inclusions__tab-pane.tab-content').removeClass('current');

      var tabs = $('[name="' + tab_name + '"]'); //find all tabs (must be matching tab content class name)
      tabs.addClass('current');
      $("." + tab_name).addClass('current');
    });
  });




  const items = document.querySelectorAll(".accordion button");

  function toggleAccordion() {
    const itemToggle = this.getAttribute('aria-expanded');

    for (i = 0; i < items.length; i++) {
      items[i].setAttribute('aria-expanded', 'false');
    }

    if (itemToggle == 'false') {
      this.setAttribute('aria-expanded', 'true');
    }
  }

  items.forEach(item => item.addEventListener('click', toggleAccordion));





});
