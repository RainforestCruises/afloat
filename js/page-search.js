jQuery(document).ready(function ($) {
  //On Change parameters update URL string
  //On Load, read url parameters

  
  $("#startDate").val(moment().format('YYYY-MM-DD')) //first time page loads
  $("#endDate").val(moment().add(1, 'Y').format('YYYY-MM-DD'))


  var url_string = window.location.href; //window.location.href
  var url = new URL(url_string);


  //filter parameters
  //--preselections from search template (sidebar)
  var travelType = url.searchParams.get("travelType"); //travel type
  if (travelType != null) {
    preselectTravelType = travelType;
  }

  var experienceType = url.searchParams.get("experienceType"); //experience
  if (experienceType != null) {
    preselectExperience = experienceType;
  }

  var preselectDestination = null; //no preselect available
  var travelDestination = url.searchParams.get("travelDestination"); //destination
  if (travelDestination != null) {
    preselectDestination = travelDestination;
  }

  var travelLocation = url.searchParams.get("travelLocation"); //location
  if (travelLocation != null) {
    preselectLocation = travelLocation;
  }

  var minLength = url.searchParams.get("minLength");
  if (minLength != null) {
    preselectMinLength = minLength;
  }
  var maxLength = url.searchParams.get("maxLength");
  if (maxLength != null) {
    preselectMaxLength = maxLength;
  }

  

  var startDate = url.searchParams.get("startDate");
  var endDate = url.searchParams.get("endDate");



  //page number
  var resultsPage = url.searchParams.get("resultsPage");
  if (resultsPage) {
    $('#initialPage').val(resultsPage); //hidden field in search criteria sidebar -- set on page load
  }


  //Length Slider
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
    
      minLength = low;
      maxLength = high;

      resetPage();
      reloadResults();
    },
  });


  //Sorting
  $('#result-sort').select2({
    width: 'auto',
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,
    placeholder: "Sort By",
  });
  $('#result-sort').on('change', function () {
    $('#search-form').submit();
  });

  //Destination 
  $('#destination-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Any",
  });
  $('#destination-select').val(preselectDestination).change();
  $('#destination-select').on('change', function () {
    travelDestination = $(this).val();
    resetPage();
    $('#search-form').submit();
  });


  //Location 
  $('#location-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Any",
  });
  $('#location-select').val(preselectLocation).change();
  $('#location-select').on('change', function () {
    travelLocation = $(this).val();
    resetPage();
    $('#search-form').submit();
  });

  //Experience 
  $('#experience-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Any",
  });
  $('#experience-select').val(preselectExperience).change();
  $('#experience-select').on('change', function () {
    experienceType = $(this).val();
    resetPage();
    $('#search-form').submit();
  });


  //Travel Type 
  $('#travel-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Any",
  });
  $('#travel-select').val(preselectTravelType).change();
  $('#travel-select').on('change', function () {
    travelType = $(this).val();
    resetPage();
    $('#search-form').submit();
  });

  //Date Range Picker
  $(function () {
    resetPage();

    if (startDate == null) {
      startDate = moment().format('YYYY-MM-DD');
    }
    if (endDate == null) {
      endDate = moment().add(1, 'Y').format('YYYY-MM-DD');
    }

    $('input[name="departure-dates"]').daterangepicker({
      ignoreReadonly: true,
      focusOnShow: false,
      startDate: moment(startDate), //set from url
      endDate: moment(endDate),
      //endDate: moment().add(1, 'M'),
      locale: {
        format: 'MMM DD, YYYY'
      }
    }, function (start, end) {
      $("#startDate").val(start.format('YYYY-MM-DD'))
      $("#endDate").val(end.format('YYYY-MM-DD'))

      startDate = start.format('YYYY-MM-DD');
      endDate = end.format('YYYY-MM-DD')

      reloadResults();
    });
  });

  //Set back to page 1 results
  function resetPage() {
    resultsPage = 1; //reset page
    $('#initialPage').val(1);
  }


  //RELOAD RESULTS ------------------------------------------
  reloadResults(); //first time page loads
  $('#search-form').submit(function () {

    reloadResults();
    return false;
  });

  //SEARCH FUNCTION
  function reloadResults() {
    console.log('reload');

    $('body, html, .search-results').animate({ scrollTop: 0 }, "fast");
    const params = new URLSearchParams(location.search);
    if (startDate != null) {
      params.set('startDate', startDate);
      params.set('endDate', endDate);
    }

    if (travelType != null) {
      params.set('travelType', travelType);
    }

    if (travelLocation != null) {
      params.set('travelLocation', travelLocation);
    }

    if (experienceType != null) {
      params.set('experienceType', experienceType);
    }

    if (travelDestination != null) {
      params.set('travelDestination', travelDestination);
    }

    if (resultsPage != null) {
      params.set('resultsPage', resultsPage);
    }

    if (minLength != null) {
      params.set('minLength', minLength);
    }
    if (maxLength != null) {
      params.set('maxLength', maxLength);
    }


    window.history.replaceState({}, '', `${location.pathname}?${params}`);


    $("#minLength").val($("#range-slider").data("from"));
    $("#maxLength").val($("#range-slider").data("to"));
   

    var searchForm = $('#search-form'); //get form
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(), // form data
      type: searchForm.attr('method'), // POST
      beforeSend: function () {
        $('#response').html('<div class="search-results__grid__loading"><div class="lds-dual-ring"></div></div>'); //loading spinner
        $('#response-count').html('Searching...');
      },
      success: function (data) {



        $('#response').html(data); // insert data

        var pageNumberDisplay = $('#pageNumberDisplay').attr('value');
        var totalResultsDisplay = $('#totalResultsDisplay').attr('value');
        var resultString = 'Found ' + totalResultsDisplay + ' results';

        if (pageNumberDisplay != 1 && pageNumberDisplay != 'all') {
          resultString += ' (Page ' + pageNumberDisplay + ')'
        }

        if (pageNumberDisplay == 'all') {
          resultString += ' (Showing All)'
        }

        $('#response-count').html(resultString);


        //expand item detail
        $(".search-results__grid__pagination__pages-group__button").on("click", function (e) {
          e.preventDefault();

          // !current page
          if (!$(this).hasClass('btn-circle--current') && !$(this).hasClass('btn-circle--disabled')) {

            // next button
            if ($(this).hasClass('search-results__grid__pagination__pages-group__button--next-button')) {
              var pageGoTo = (+pageNumberDisplay + 1);
              $("#initialPage").val(pageGoTo);

              // back button
            } else if ($(this).hasClass('search-results__grid__pagination__pages-group__button--back-button')) {
              var pageGoTo = (+pageNumberDisplay - 1);
              $("#initialPage").val(pageGoTo);

              //all button
            } else if ($(this).hasClass('search-results__grid__pagination__pages-group__button--all-button')) {
              $("#initialPage").val('all');

              //page button
            } else {
              var pageNumber = $(this).val();
              $("#initialPage").val(pageNumber);
            }
            resultsPage = $("#initialPage").val();

            $('#search-form').submit();

          }

        });

      }
    });
  }



  //intro expand/hide
  $(".search-intro__title").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.search-intro__text').slideToggle(350);
    $this.toggleClass('search-intro__title--collapsed');

  });





  //closing jquery tag
});


