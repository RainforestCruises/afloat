
jQuery(document).ready(function ($) {

  //Sorting
  $('#result-sort').select2({
    width: 'auto',
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,
   
  });
  $('#result-sort').on('change', function () {
    
  });
  
  $('#result-sort').val('popularity').change();

  //FORM ----------------
  //form variables
  const formDates = document.querySelector('#formDates');
  const formTravelStyles = document.querySelector('#formTravelStyles');
  const formDestinations = document.querySelector('#formDestinations');
  const formExperiences = document.querySelector('#formExperiences');
  const formMinLength = document.querySelector('#formMinLength');
  const formMaxLength = document.querySelector('#formMaxLength');



  //Expand Lists --------------------------------------------
  // Departure List -- Show More Dates
  $("#departure-show-more").click(function () {
    toggleDeparturesExpanded();
  });

  const toggleDeparturesExpanded = () => {
    $("#departure-filter-list").toggleClass("expanded");
    var isExpanded = $("#departure-filter-list").hasClass("expanded");
    if (isExpanded == true) {
      $('#departure-show-more').html("Show Less");
    } else {
      $('#departure-show-more').html("Show More");
    }
  }

  //expand if hidden checkbox is selected upon page load
  const departureDatesExpandedArray = [...document.querySelectorAll('.checkbox-expand-group')];
  let hasExpanded = false;
  departureDatesExpandedArray.forEach(item => {
    if (item.checked == true) {
      hasExpanded = true;
    }
  })
  if (hasExpanded == true) {
    toggleDeparturesExpanded();
  }


  //Intro Snippet
  $(".search-intro__title").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.search-intro__text').slideToggle(350);
    $this.toggleClass('search-intro__title--collapsed');
  });

  //Search Filters expand/hide
  $(".filter__heading").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.filter__content').slideToggle(350);
    $this.parent().find('.filter__heading').toggleClass('closed');
  });



  //Search Filter Selections ------------------------------------
  //Departure Date selections
  let departuresString = formDates.value;
  const departureDatesArray = [...document.querySelectorAll('.departure-checkbox')];
  departureDatesArray.forEach(item => {
    item.addEventListener('click', () => {
      departuresString = "";
      let count = 0;
      departureDatesArray.forEach(checkbox => {
        const itemValue = checkbox.value;

        if (checkbox.checked) {

          if (count > 0) {
            departuresString += ";";
          }
          departuresString += itemValue;
          count++;
        }
      })

      formDates.value = departuresString;
      reloadResults();

    });
  })

  //Travel Style selections
  let travelStylesString = formTravelStyles.value;
  const travelStylesArray = [...document.querySelectorAll('.travel-style-checkbox')];
  travelStylesArray.forEach(item => {
    item.addEventListener('click', () => {

      //if charterCruises = selected --> make unselected
      if (item.value != 'charter_cruises') {
        const charterCheckbox = document.getElementById('charterCheckbox');
        charterCheckbox.checked = false;
      } else {
        //if this is charterCruises (and not selected) --> unselect all the other checkboxes
        if (item.checked == true) {
          travelStylesArray.forEach(checkboxItem => {
            checkboxItem.checked = false;
          });
          charterCheckbox.checked = true;
        }
      }

      travelStylesString = "";
      let count = 0;
      travelStylesArray.forEach(checkbox => {
        const itemValue = checkbox.value;
        if (checkbox.checked) {
          if (count > 0) {
            travelStylesString += ";";
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
  let destinationsString = formDestinations.value;
  const destinationsArray = [...document.querySelectorAll('.destination-checkbox')];
  destinationsArray.forEach(item => {
    item.addEventListener('click', () => {
      destinationsString = "";
      let count = 0;
      destinationsArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {
          if (count > 0) {
            destinationsString += ";";
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
  let experiencesString = formExperiences.value;
  const experiencesArray = [...document.querySelectorAll('.experience-checkbox')];
  experiencesArray.forEach(item => {
    item.addEventListener('click', () => {
      experiencesString = "";
      let count = 0;
      experiencesArray.forEach(checkbox => {
        const itemValue = parseInt(checkbox.value);

        if (checkbox.checked) {

          if (count > 0) {
            experiencesString += ";";
          }
          experiencesString += itemValue;
          count++;
        }

      })
      formExperiences.value = experiencesString;
      reloadResults();
    });
  })

  //Length Slider
  $("#range-slider").ionRangeSlider({
    skin: "round",
    type: "double",
    min: 1, //default
    max: 21, //default
    from: formMinLength.value,
    to: formMaxLength.value,
    postfix: " Day",
    max_postfix: "+",
    onFinish: function () {

      formMinLength.value = $("#range-slider").data("from");
      formMaxLength.value = $("#range-slider").data("to");

      reloadResults();
    },
  });



  //RELOAD RESULTS
  function reloadResults() {

    //set url params
    const params = new URLSearchParams(location.search);

    if (departuresString != null) {
      params.set('departures', departuresString);
    }

    if (travelStylesString != null) {
      params.set('travel_style', travelStylesString);
    }

    if (destinationsString != null) {
      params.set('destinations', destinationsString);
    }

    if (experiencesString != null) {
      params.set('experiences', experiencesString);
    }

    if (formMinLength.value != null) {
      params.set('length_min', formMinLength.value);
    }

    if (formMinLength.value != null) {
      params.set('length_max', formMaxLength.value);
    }



    window.history.replaceState({}, '', `${location.pathname}?${params}`);


    //ajax call / submit form
    var searchForm = $('#search-form');
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(),
      type: searchForm.attr('method'),
      beforeSend: function () {
        $('#response').addClass('loading'); //indicate loading
        $("#response").append('<div class="lds-dual-ring"></div>');
        $('#response-count').html('Searching...');
      },
      success: function (data) {
        $('#response').removeClass('loading');
        $(".lds-dual-ring").remove();
        $('#response').html(data); //return the markup -- content-primary-search-results.php


        var resultCount = $('#totalResultsDisplay').attr('value');

        var resultCountDisplay = ""
        if(resultCount == 1){
          resultCountDisplay = "Found " + resultCount + " result"
        } else {
          resultCountDisplay = "Found " + resultCount + " results"
        }
        $('#response-count').html(resultCountDisplay);

      }
    });
  }

});


