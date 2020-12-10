jQuery(document).ready(function ($) {
  //On Change parameters update URL string
  //On Load, read url parameters

  $("#startDate").val(moment().format('YYYY-MM-DD'))
  $("#endDate").val(moment().add(1, 'M').format('YYYY-MM-DD'))
  $("#minLength").val('1');
  $("#maxLength").val('14');


  //Length Slider
  $("#range-slider").ionRangeSlider({
    skin: "round",
    type: "double",
    min: 1,
    max: 14,
    from: 1,
    to: 14,
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
    placeholder: "Select Destination",

  });
  $('#destination-select').on('change', function () {
    $('#search-form').submit();
  });


  //Travel Type 
  $('#travel-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Select Travel Type",

  });
  $('#travel-select').on('change', function () {
    $('#search-form').submit();
  });

  //Date Range Picker
  $(function () {
    $('input[name="departure-dates"]').daterangepicker({
      ignoreReadonly: true,
      focusOnShow: false,
      startDate: moment(),
      endDate: moment().add(1, 'M'),
      locale: {
        format: 'MMM DD, YYYY'
      }
    }, function (start, end) {
      $("#startDate").val(start.format('YYYY-MM-DD'))
      $("#endDate").val(end.format('YYYY-MM-DD'))
      reloadResults();


    });
  });


  //RELOAD RESULTS ------------------------------------------
  reloadResults(); //first time page loads
  $('#search-form').submit(function () {
    reloadResults();
    return false;
  });

  //SEARCH FUNCTION
  function reloadResults() {
    var searchForm = $('#search-form'); //get form
    console.log(searchForm);
    $.ajax({
      url: searchForm.attr('action'),
      data: searchForm.serialize(), // form data
      type: searchForm.attr('method'), // POST
      beforeSend: function () {
        $('#response').html('<div class="search-results__grid__loading"><div class="lds-dual-ring"></div></div>'); //loading spinner
      },
      success: function (data) {
        $('#response').html(data); // insert data
      }
    });
    //return false;
  }



  //intro expand/hide
  $(".search-page__intro__title").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    $this.parent().find('.search-page__intro__text').slideToggle(350);
  });






//closing jquery tag
});


