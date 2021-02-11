jQuery(document).ready(function ($) {
  //On Change parameters update URL string
  //On Load, read url parameters

  $("#startDate").val(moment().format('YYYY-MM-DD'))
  $("#endDate").val(moment().add(1, 'M').format('YYYY-MM-DD'))
  $("#minLength").val('1');
  $("#maxLength").val('14');

  var url_string = window.location.href; //window.location.href
  var url = new URL(url_string);
  var startDate = url.searchParams.get("startDate");
  var endDate = url.searchParams.get("endDate");



  //Length Slider
  $("#range-slider").ionRangeSlider({
    skin: "round",
    type: "double",
    min: 1,
    max: 14,
    from: preselectMinLength,
    to: preselectMaxLength,
    postfix: " Day",
    max_postfix: "+",
    onFinish: function () {
      var low = $("#range-slider").data("from");
      var high = $("#range-slider").data("to");
      $("#minLength").val(low);
      $("#maxLength").val(high);
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
  $('#destination-select').on('change', function () {
    $('#search-form').submit();
  });


  //Location 
  $('#location-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Any",

  });
  $('#location-select').on('change', function () {
    $('#search-form').submit();
  });

  //Experience 
  $('#experience-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Any",

  });
  $('#experience-select').on('change', function () {
    $('#search-form').submit();
  });


  //Travel Type 
  $('#travel-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Any",

  });
  $('#travel-select').on('change', function () {
    $('#search-form').submit();
  });

  //Date Range Picker
  $(function () {

    if (startDate == null) {
      startDate = moment().format('YYYY-MM-DD');
    }
    if (endDate == null) {
      endDate = moment().add(1, 'M').format('YYYY-MM-DD');
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




  //RELOAD RESULTS ------------------------------------------
  reloadResults(); //first time page loads
  $('#search-form').submit(function () {
    $('body, html, .search-results').animate({ scrollTop: 0 }, "fast");
    reloadResults();
    return false;
  });

  //SEARCH FUNCTION
  function reloadResults() {

    const params = new URLSearchParams(location.search);
    if (startDate != null) {
      params.set('startDate', startDate);
      params.set('endDate', endDate);

      window.history.replaceState({}, '', `${location.pathname}?${params}`);
    }


    // var url_string = window.location.href; //window.location.href
    // var url = new URL(url_string);
    // var search_params = url.searchParams;
    // console.log(search_params);
    // // new value of "id" is set to "101"
    // search_params.set('startDate', '101');

    // // change the search property of the main url
    // url.search = search_params.toString();

    // // the new url string
    // var new_url = url.toString();

    // // output : http://demourl.com/path?id=101&topic=main
    // console.log(new_url);
    // window.history.pushState('search', new_url);

    var searchForm = $('#search-form'); //get form
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(), // form data
      type: searchForm.attr('method'), // POST
      beforeSend: function () {
        $('#response').html('<div class="search-results__grid__loading"><div class="lds-dual-ring"></div></div>'); //loading spinner
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
              $("#pageNumber").val(pageGoTo);

              // back button
            } else if ($(this).hasClass('search-results__grid__pagination__pages-group__button--back-button')) {
              var pageGoTo = (+pageNumberDisplay - 1);
              $("#pageNumber").val(pageGoTo);

              //all button
            } else if ($(this).hasClass('search-results__grid__pagination__pages-group__button--all-button')) {
              $("#pageNumber").val('all');

              //page button
            } else {
              var pageNumber = $(this).val();
              $("#pageNumber").val(pageNumber);
            }

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


