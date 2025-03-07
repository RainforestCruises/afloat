jQuery(document).ready(function ($) {
  //TRAVEL GUIDES / DEALS -- LANDING PAGES

  // quick search regex
  var qsRegex;
  var buttonFilter;
  const templateUrl = page_vars.templateUrl;

  // init Isotope
  var resultsGrid = $("#results").isotope({
    itemSelector: ".guide-item",
    masonry: {
      columnWidth: 40,
      isFitWidth: true,
    },
    filter: function () {
      var $this = $(this);
      var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
      var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
      return searchResult && buttonResult;
    },
  });

  // bind filter button click
  $(".filters-button-group").on("click", "button", function () {
    buttonFilter = $(this).attr("data-filter");
    $("#quicksearch").val("");
    qsRegex = "";
    resultsGrid.isotope();

    //check count
    //console.log($('#results').isotope().filteredItems.count);

    var iso = resultsGrid.data("isotope");
    var filterCount = iso.filteredItems.length;

    if (filterCount > 0) {
      $("#no-results-message").hide();
    } else {
      $("#no-results-message").show();
    }

    $(".filter-button").removeClass("selected");
    $(this).addClass("selected");
  });

  // use value of search field to filter
  var $quicksearch = $("#quicksearch").keyup(
    debounce(function () {
      qsRegex = new RegExp($quicksearch.val(), "gi");
      buttonFilter = "";

      $(".filter-button").removeClass("selected");
      $(".filter-button-all").addClass("selected");

      $("#no-results-message").hide();

      resultsGrid.isotope();
    })
  );

  // debounce so filtering doesn't happen every millisecond
  function debounce(fn, threshold) {
    var timeout;
    return function debounced() {
      if (timeout) {
        clearTimeout(timeout);
      }
      function delayed() {
        fn();
        timeout = null;
      }
      setTimeout(delayed, threshold || 100);
    };
  }

  //Newsletter
  $(".close-button").on("click", () => {
    $(".popup").removeClass("active");
    body.classList.remove("no-scroll");
  });

  document.addEventListener("click", (evt) => {
    const contactForm = document.querySelector(".contact");
    const popup = document.querySelector(".popup");
    const button = document.querySelector("#newsletterButton");

    const isContact = contactForm.contains(evt.target);
    const isButton = button.contains(evt.target);
    const isActive = popup.classList.contains("active");
    if (isActive) {
      if (!isContact && !isButton) {
        $(".popup").toggleClass("active");
        body.classList.remove("no-scroll");
      }
    }
  });

  $("#newsletterButton").on("click", () => {
    $(".popup").addClass("active");
    body.classList.add("no-scroll");
  });

  $(".form-general").on("submit", function () {
    $(".contact__wrapper__intro__title").text("Thank You");
    $(".contact__wrapper__intro__introtext").hide();
  });

  //Related Products Slider
  $("#featured-slider").slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    initialSlide: 0,

    arrows: true,
    dots: false,
    prevArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--left product-related__slider__btn--left"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-left"></use></svg></button>',
    nextArrow: '<button class="btn-circle btn-circle--small btn-dark btn-circle--right product-related__slider__btn--right"><svg class="btn-circle--arrow-main"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg><svg class="btn-circle--arrow-animate"><use xlink:href="' + templateUrl + '/css/img/sprite.svg#icon-chevron-right"></use></svg></button>',
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          arrows: false,
          centerMode: true,
        },
      },
    ],
  });
});
