jQuery(document).ready(function ($) {
  $('#destination-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Select Destination",

  });

  $('#result-sort').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Select",
  });

  //selection controls
  $('#destination-select').on('change', function () {
    var destinationId = $(this).val();
    console.log(destinationId);
    $('#search-form').submit();
  });

  //result-sort
  $('#result-sort').on('change', function () {

    $('#search-form').submit();
  });

  $(function () {
    $('input[name="departure-dates"]').daterangepicker({
      startDate: moment(),
      endDate: moment().add(1, 'M'),
      locale: {
        format: 'MMM DD, YYYY'
      }
    });
  });


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
        $('#response').html('<div class="search-results__grid__loading"><div class="lds-dual-ring"></div></div>'); //loading spinner
      },
      success: function (data) {
        $('#response').html(data); // insert data
      }
    });
    //return false;
  }


});


