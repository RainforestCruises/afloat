jQuery(document).ready(function ($) {


  //Side Info Tabs - Overview / Inclusions / Exclusions
  const tabArray = [...document.querySelectorAll('.product-itinerary-slide__top__side-info__tabs__item')];
  tabArray.forEach(item => {
    item.addEventListener('click', () => {
      let itineraryTab = item.getAttribute("itinerary-tab");
      let tabType = item.getAttribute("tab-type");

      //content panes
      let tabPanes = [...document.querySelectorAll('.product-itinerary-slide__top__side-info__content[itinerary-tab="' + itineraryTab + '"]')];
      tabPanes.forEach((x) => {
        x.classList.remove('current');
      });

      tabPanes.forEach((x) => {
        if (x.getAttribute('tab-type') == tabType) {
          x.classList.add('current')
        }
      });

      //tabs nav
      let tabNavs = [...document.querySelectorAll('.product-itinerary-slide__top__side-info__tabs__item[itinerary-tab="' + itineraryTab + '"]')];
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
  }).on('afterChange', function (event, slick, currentSlide, nextSlide) {
    var counterDiv = $('#itineraries-slider-counter');

    var i = (currentSlide ? currentSlide : 0) + 1;
    counterDiv.text('Itinerary: ' + i + ' / ' + slick.slideCount);
    $('.side-info-panel[tab-type="all"').show();
    $('.side-info-panel[tab-type="dates"').hide();
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
    swipeToSlide: true,
    prevArrow: '<button class="product-itinerary-slide__bottom__days__btn product-itinerary-slide__bottom__days__btn--left"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_left_36px"></use></svg></button>',
    nextArrow: '<button class="product-itinerary-slide__bottom__days__btn product-itinerary-slide__bottom__days__btn--right"><svg><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-ic_chevron_right_36px"></use></svg></button>',
    customPaging: function (slider, i) {
      return '<a class="dot">' + (i + 1) + '</a>';
    },

    responsive: [
      {
        breakpoint: 600,
        settings: {
          dots: false
        }
      }
    ]



  })
    .on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
      $('#itineraries-slider').slick("setOption", '', '', true);
      var currentCounter = $(this).next();

      var i = (currentSlide ? currentSlide : 0) + 1;
      currentCounter.text(i + ' / ' + slick.slideCount);
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
    prevArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--left product-hotels__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--right product-hotels__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 3,


        }
      },
      {
        breakpoint: 800,
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


  //date-grid__item
  const dateGridItems = [...document.querySelectorAll('.date-grid__item')];
  dateGridItems.forEach(item => {
    item.addEventListener('click', () => {
      selectedYear = item.getAttribute("departure-year");
      selectedMonth = item.getAttribute("departure-month");
      itineraryTab = item.getAttribute("itinerary-tab");
      itineraryId = item.getAttribute("itinerary-id");

      var formattedMonth = moment(selectedMonth, 'MM').format('MMMM')
      $('.side-info-panel__top__month').text(formattedMonth + ", " + selectedYear);

      $('.side-info-panel[itinerary-tab="' + itineraryTab + '"][tab-type="all"').hide();
      $('.side-info-panel[itinerary-tab="' + itineraryTab + '"][tab-type="dates"').show();

      $('#form-itinerary').val(itineraryId);
      $('#form-month').val(selectedMonth);
      $('#form-year').val(selectedYear);

      //$('#testfield').val('js-test');

      //console.log('xxx');
      reloadResults();
      // $('#search-form').submit(function (event) {
      //   event.preventDefault();
      //   //reloadResults();
      //   return false;
      // });
    });
  })

  const closeButtons = [...document.querySelectorAll('.side-info-panel__top__close-button')];
  closeButtons.forEach(item => {
    item.addEventListener('click', () => {


      $('.side-info-panel[tab-type="dates"').hide();
      $('.side-info-panel[tab-type="all"').show();

    });
  })




  //Date and Price Grid Time Config
  //display Itinerary Side Info for current year only
  $('.date-grid').hide();
  $('.date-grid__' + currentYear).show();

  $('.price-grid').hide();
  $('.price-grid__' + currentYear).show();


  //Season
  $('.season-select').select2({
    width: '100%',
    minimumResultsForSearch: -1
  });

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
    console.log(year);
    console.log(tab_id);
    $('.date-grid[data-tab="' + tab_id + '"]').hide();
    $('.date-grid__' + year + '[data-tab="' + tab_id + '"]').show();

    $('.price-grid[data-tab="' + tab_id + '"]').hide();
    $('.price-grid__' + year + '[data-tab="' + tab_id + '"]').show();

  });


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
    reloadResults();
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
    reloadResults();
  });

  $('#dates-year-select').on('change', function () {
    var year = $(this).val();
    //$('#search-form').submit();

    reloadResults();

  });


  //SEARCH SUBMIT
  reloadResults(); //first time page loads
  // $('search-form').submit(function () {
  //   reloadResults();
  //   return false;
  // });

  //SEARCH FUNCTION
  function reloadResults() {
    var searchForm = $('#search-form'); //get form
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(), // form data
      type: searchForm.attr('method'), // POST
      beforeSend: function () {
        $('.side-info-panel__departure-grid').html('<div class="product-dates__search-area__results__loading"><div class="lds-dual-ring"></div></div>'); //loading spinner
      },
      success: function (data) {
        console.log('success');
        $('.side-info-panel__departure-grid').html(data); // insert data

        // //Product Navigation
        // $('.results-goto-itineraries').click(function () {
        //   var tab_id = $(this).attr('href');
        //   window.location.hash = tab_id;


        //   var subTabId = $(this).attr('data-tab');

        //   $('.product-intro__nav__list__item').removeClass('current');
        //   $('.product-itineraries__itinerary.tab-content').removeClass('current');

        //   $("#" + subTabId + "-nav").addClass('current'); //add current class to both nav tab and content
        //   $("#" + subTabId).addClass('current');
        // })
        // //End Product Nav

        // //expand item detail
        // $(".departure-expand").on("click", function (e) {
        //   e.preventDefault();
        //   let $this = $(this);
        //   $this.parent().parent().next().slideToggle(350); //bottom div
        //   $this.parent().parent().parent().toggleClass('product-dates__search-area__results__itinerary-group__departures__departure--active') //departure
        // });

      }
    });
    //return false;

  }





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
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: '<button class="btn-circle btn-circle--white btn-circle--noborder btn-circle--small  btn-circle--left product-reviews__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--white btn-circle--noborder btn-circle--small  btn-circle--right product-reviews__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',

    lazyLoad: 'ondemand',
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







  //Related Products Slider
  $('#related-slider').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    initialSlide: 0,
    lazyLoad: 'ondemand',
    arrows: true,
    dots: false,
    prevArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--left product-related__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--right product-related__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          arrows: false,
          centerMode: true,
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
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0, 1] // Will preload 0 - before current, and 1 after 
    }
  });

  $('#gallery-expand-button').on('click', function () {

    var gallery = $('#product-gallery');

    $(gallery).magnificPopup({
      delegate: '.slick-slide:not(.slick-cloned) .product-hero__gallery__slick__item a',
      type: 'image',
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0, 1] // Will preload 0 - before current, and 1 after 
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
