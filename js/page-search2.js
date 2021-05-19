
jQuery(document).ready(function ($) {


    //FORM ----------------
  //form variables
  const formDates = document.querySelector('#formDates');
  const formTravelStyles = document.querySelector('#formTravelStyles');
  const formDestinations = document.querySelector('#formDestinations');
  const formExperiences = document.querySelector('#formExperiences');
  const formMaxLength = document.querySelector('#formMaxLength');
  const formMinLength = document.querySelector('#formMinLength');

  var preselectMinLength = 1;
  var preselectMaxLength = 15;
  //Length Slider

  let rangeFrom = 1;
  let rangeTo = 15;

  $("#range-slider").ionRangeSlider({
    skin: "round",
    type: "double",
    min: 1,
    max: 15,
    from: preselectMinLength,
    to: preselectMaxLength,
    postfix: " Day",
    max_postfix: "+",
    onFinish: function () {
      var low = $("#range-slider").data("from");
      var high = $("#range-slider").data("to");
      formMinLength.value = low;
      formMaxLength.value = high;

      reloadResults();
    },
  });

  // Show More -- Departure List
  $("#departure-show-more").click(function (e) {
    $("#departure-filter-list").toggleClass("expanded");
    var isExpanded = $("#departure-filter-list").hasClass("expanded");
    if (isExpanded == true) {
      $('#departure-show-more').html("Show Less");
    } else {
      $('#departure-show-more').html("Show More");
    }
  });

  //intro expand/hide
  $(".search-intro__title").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.search-intro__text').slideToggle(350);
    $this.toggleClass('search-intro__title--collapsed');
  });

  //filters expand/hide
  $(".filter__heading").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.filter__content').slideToggle(350);
    $this.parent().find('.filter__heading').toggleClass('closed');
  });







  //Departure Date selections
  let departureString = "";
  let departureSelectionArray = [];
  const departureDatesArray = [...document.querySelectorAll('.departure-checkbox')];
  departureDatesArray.forEach(item => {
    item.addEventListener('click', () => {
      departureSelectionArray = [];
      departureString = "";
      let count = 0;
      departureDatesArray.forEach(checkbox => {
        const itemMonth = checkbox.getAttribute("month");
        const itemYear = checkbox.getAttribute("year");


        if (checkbox.checked) {

          var itemValue = itemYear + "-" + itemMonth + "-01";
          departureSelectionArray.push(itemValue);
          if (count > 0) {
            departureString += ":";
          }
          departureString += itemYear + "-" + itemMonth;
          count++;
        }

      })

      formDates.value = departureString;

      reloadResults();
    });
  })


  //Travel Style selections
  let travelStylesString = "";
  let travelStylesSelectionArray = [];
  const travelStylesArray = [...document.querySelectorAll('.travel-style-checkbox')];
  travelStylesArray.forEach(item => {
    item.addEventListener('click', () => {
      travelStylesSelectionArray = [];
      travelStylesString = "";
      let count = 0;
      travelStylesArray.forEach(checkbox => {
        const itemValue = checkbox.value;

        if (checkbox.checked) {

          travelStylesSelectionArray.push(itemValue);

          if (count > 0) {
            travelStylesString += ":";
          }
          travelStylesString += itemValue;
          count++;
        }

      })

      formTravelStyles.value = travelStylesString;

      reloadResults();
    });
  })

  //Destination selections
  let destinationsString = "";
  let destinationsSelectionArray = [];
  const destinationsArray = [...document.querySelectorAll('.destination-checkbox')];
  destinationsArray.forEach(item => {
    item.addEventListener('click', () => {
      destinationsSelectionArray = [];
      destinationsString = "";
      let count = 0;
      destinationsArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {
          destinationsSelectionArray.push(itemValue);
          if (count > 0) {
            destinationsString += ":";
          }
          destinationsString += itemValue;
          count++;
        }

      })

      formDestinations.value = destinationsString;
      reloadResults();
    });
  })

  //Experiences selections
  let experiencesString = "";
  let experiencesSelectionArray = [];
  const experiencesArray = [...document.querySelectorAll('.experience-checkbox')];
  experiencesArray.forEach(item => {
    item.addEventListener('click', () => {
      experiencesSelectionArray = [];
      experiencesString = "";
      let count = 0;
      experiencesArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {

          experiencesSelectionArray.push(itemValue);

          if (count > 0) {
            experiencesString += ":";
          }
          experiencesString += itemValue;
          count++;
        }

      })
      formExperiences.value = experiencesString;
      reloadResults();
    });
  })





  $('#search-form').submit(function () {

    reloadResults();
    return false;
  });

  //SEARCH FUNCTION
  function reloadResults() {
    console.log('reload');

    
    var searchForm = $('#search-form'); //get form
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(), // form data
      type: searchForm.attr('method'), // POST
      beforeSend: function () {
        //$('#response').html('<div class="search-results__grid__loading"><div class="lds-dual-ring"></div></div>'); //loading spinner

        //search-results__grid
        
        $('#response').addClass('loading');


        $( "#response" ).append('<div class="lds-dual-ring"></div>');

        $('#response-count').html('Searching...');
      },
      success: function (data) {

        $('#response').removeClass('loading');
        $( ".lds-dual-ring" ).remove();

        $('#response').html(data); // insert data

       


        

      }
    });
  }



});


