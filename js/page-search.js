jQuery(document).ready(function ($) {
  $('#destination-select').select2({
    width: '100%',
    minimumResultsForSearch: -1,
    placeholder: "Select Destination",

  });

  $('#result-sort').select2({
    width: 'auto',
    dropdownAutoWidth: true,
    minimumResultsForSearch: -1,
    placeholder: "Sort",
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
    }), function (start, end) {

    };
  });


  $(function() {
    $('input[name="departure-dates"]').daterangepicker({
      startDate: moment(),
      endDate: moment().add(1, 'M'),
      locale: {
        format: 'MMM DD, YYYY'
      }
    }, function(start, end) {
      $("#startDate").val(start.format('YYYY-MM-DD'))
      $("#endDate").val(end.format('YYYY-MM-DD'))
      reloadResults();
      

    });
  });
  $("#startDate").val(moment().format('YYYY-MM-DD'))
  $("#endDate").val(moment().add(1, 'M').format('YYYY-MM-DD'))


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


});


